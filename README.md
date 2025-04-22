# Startup Monitor

A Laravel-based dashboard for monitoring Startup India progress. This application helps track startups, investors, milestones, and financial information.

## Features

- Modern glass UI design
- Real-time dashboard with statistics
- Startup tracking and management
- Investor tracking and management
- Milestone tracking
- Financial calculations and tracking
- Interactive charts and graphs

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- XAMPP (recommended)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd startup-monitor
```

2. Install dependencies:
```bash
composer install
```

3. Create a copy of .env file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=startup_monitor
DB_USERNAME=root
DB_PASSWORD=
```

6. Create the database:
```bash
php artisan migrate
```

7. Seed the database with sample data:
```bash
php artisan db:seed
```

## Running the Application

1. Start your XAMPP server (Apache and MySQL)

2. Run the Laravel development server:
```bash
php artisan serve
```

3. Visit http://localhost:8000 in your browser

## Database Setup

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named 'startup_monitor'
3. The migrations and seeders will automatically set up the required tables

## Project Structure

- `app/Models/` - Contains all the models (Startup, Investor, Milestone, Financial)
- `app/Http/Controllers/` - Contains all the controllers
- `resources/views/` - Contains all the blade templates
- `database/migrations/` - Contains database migrations
- `database/seeders/` - Contains database seeders

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request
