<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Affiche la liste des conversations récentes
     */
    public function index()
    {
        $userId = auth()->id();
        
        // On récupère les identifiants de tous les utilisateurs avec qui on a discuté
        $contactsIds = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->select('sender_id', 'receiver_id')
            ->get()
            ->flatMap(function ($msg) use ($userId) {
                return [$msg->sender_id, $msg->receiver_id];
            })
            ->reject(function ($id) use ($userId) {
                return $id === $userId;
            })
            ->unique();

        $contacts = User::whereIn('id', $contactsIds)->get();

        // Si on est patient, on peut vouloir lister ses médecins pour initier une conversation
        $medecinsDispos = [];
        if (auth()->user()->isPatient()) {
            $medecinsDispos = User::where('role', 'medecin')->get();
        }

        // Si on est médecin, on peut vouloir lister d'autres médecins
        $autresMedecins = [];
        if (auth()->user()->isMedecin()) {
            $autresMedecins = User::where('role', 'medecin')->where('id', '!=', $userId)->get();
        }

        return view('chat.index', compact('contacts', 'medecinsDispos', 'autresMedecins'));
    }

    /**
     * Affiche la conversation avec un utilisateur précis
     */
    public function show($userId)
    {
        $contact = User::findOrFail($userId);
        $myId = auth()->id();

        // Marquer les messages comme lus
        Message::where('sender_id', $userId)
            ->where('receiver_id', $myId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function($query) use ($myId, $userId) {
                $query->where('sender_id', $myId)->where('receiver_id', $userId);
            })
            ->orWhere(function($query) use ($myId, $userId) {
                $query->where('sender_id', $userId)->where('receiver_id', $myId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.show', compact('contact', 'messages'));
    }

    /**
     * Envoie un message
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'content' => 'required|string|max:2000'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
            'content' => $request->content,
        ]);

        return redirect()->route('chat.show', $userId);
    }
}
