# Laravel To-Do App

A simple task management application built with Laravel.
The application allows you to:

- Add new tasks

- Delete tasks

- Assign tasks to different groups

- Mark tasks as completed

You can test the application using the following link:

**[Live Demo](http://130.162.219.194:8081/)**

Login credentials:

- **Email**: `test@test.com`
- **Password**: `test1234`

---

## How to Run Locally?

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/szymongalaska/to-do-app.git
cd to-do-app
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

Install JavaScript dependencies using NPM:

```bash
npm install
npm run dev
```

### 3. Configure the `.env` File

Create a `.env` file based on the provided example:

```bash
cp .env.example .env
```

Fill in the `.env` file with the required configuration, such as database connection details.



### 4. Generate Application Key

Generate the application key to secure your app:

```bash
php artisan key:generate
```

### 5. Run Database Migrations

Run migrations to set up the database tables:

```bash
php artisan migrate
```

### 5. Start the Application

Start the development server:

```bash
php artisan serve
```

The application will be available at: `http://127.0.0.1:8000`

---

## System Requirements

- PHP >= 8.1
- Composer
- Node.js and npm
- A database (e.g., MySQL, PostgreSQL, or SQLite)

---

## Support and Contact

If you have any questions or issues, feel free to reach out!

