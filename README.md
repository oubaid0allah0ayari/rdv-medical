# RDV Medical - Medical Appointment Management System

A modern web application for managing medical appointments, patient records, and doctor schedules.

## Features

- 👨‍⚕️ **Doctor Management** - Manage doctor profiles, specialties, and availability hours
- 👥 **Patient Management** - Maintain comprehensive patient records and medical history
- 📅 **Appointment Scheduling** - Book, reschedule, and manage medical appointments
- 💬 **Messaging System** - Direct communication between doctors and patients
- 📝 **Medical Records** - Organize and access patient medical notes and documents
- 🔐 **Authentication** - Secure user authentication and authorization

## Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL/MariaDB
- **Build Tool**: Vite
- **Package Manager**: Composer & npm

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL 8.0+ or MariaDB 10.6+
- Git

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/oubaid0allah0ayari/rdv-medical.git
cd rdv-medical
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Update your `.env` file with database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rdv_medical
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Build Frontend Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
npm run dev
```

Access the application at `http://localhost:8000`

## Project Structure

```
rdv-medical/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Patient.php
│   │   ├── Medecin.php
│   │   ├── RendezVous.php
│   │   ├── Message.php
│   │   └── Remarque.php
│   └── Providers/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   ├── api.php
│   └── auth.php
└── config/
```

## Database Models

- **User** - System users (patients, doctors, admins)
- **Patient** - Patient information and medical history
- **Medecin** - Doctor profiles and specialties
- **RendezVous** - Appointment records
- **Message** - Patient-doctor communications
- **Remarque** - Medical notes and observations

## Usage

### For Doctors
- Create and manage your professional profile
- Set available consultation hours
- View and manage appointments
- Communicate with patients
- Add medical notes to patient records

### For Patients
- Create medical profile
- Book appointments with available doctors
- Message doctors
- View appointment history
- Access medical records

## API Routes

Key API endpoints are defined in `routes/api.php`:
- `POST /api/appointments` - Create appointment
- `GET /api/appointments` - List appointments
- `PUT /api/appointments/{id}` - Update appointment
- `DELETE /api/appointments/{id}` - Cancel appointment
- `GET /api/messages` - Fetch messages
- `POST /api/messages` - Send message

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email support@rdvmedical.com or open an issue on GitHub.

---

**Last Updated**: May 6, 2026
