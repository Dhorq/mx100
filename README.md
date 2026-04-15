# MX100

## Tech Stack
- Laravel 12
- Sanctum
- PostgreSQL

## Roles
| Role | Description |
|------|-------------|
| employer | Post job, get application |
| freelancer | Get job, apply job|

## API Endpoints
Base URL: http://localhost:8000/api

### Authentication
| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | /register | - | Register |
| POST | /login | - | Login |
| POST | /logout | Bearer | Logout |

#### Register
POST /api/register
{
    "name": "...",
    "email": "...",
    "password": "...",
    "role": "employer" // "freelancer"
}

#### Login
POST /api/login
{
    "email": "...",
    "password": "..."
}

### Jobs (Bearer Token required)
| Method | Endpoint | Role | Description |
|--------|----------|------|-------------|
| POST | /jobs | employer | Create job |
| PUT | /jobs/{id} | employer | Update job |
| GET | /my-jobs | employer | Get jobs |
| GET | /jobs/{id}/applicants | employer | Get applications |
| GET | /jobs | freelancer | Get jobs published |
| POST | /jobs/{id}/apply | freelancer | Apply (form-data: cv file) |

## Setup
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
