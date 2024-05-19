# Practical Task in Laravel 11

## Overview
This project is a practical task implemented using Laravel 11. It includes features such as role-based authentication, an admin panel for managing users and quizzes, and a quiz-taking interface for users. The following instructions and notes will guide you through setting up and running the project.

## Features

1. Role Management:

- Admin
- User
- Both roles can be logged in simultaneously in different tabs on the same browser without affecting each other's session.

2. Admin Panel:

- Authentication using Laravel Breeze.
- Bootstrap-based interface.
- Create, read, update, and delete (CRUD) operations for questions.
- Create quizzes and manage answers with server-side and client-side validation.
- Manage user list with search and sort functionalities.
- Set a timer for each question (e.g., 60 seconds).

3. User Interface:

- Login and take quizzes created by the admin.
- Each question has a time limit enforced by the admin.
- Automatic transition to the next question if the timer expires.
- No option to go back to previous questions.
- Timer persistence across page refreshes.
- Display of results after the quiz.

## Installation

Follow these steps to set up and run the project locally:

1. PHP = 8.2
2. Clone the repository: `git clone <repository-url>`
3. Navigate to the project directory: `cd <project-directory>`
4. Install dependencies: `composer install`
5. Create a copy of the `.env.example` file and rename it to `.env`: `cp .env.example .env`
6. Generate an application key: `php artisan key:generate`
7. Configure your `.env` file with necessary details like database credentials.
8. Run migrations: `php artisan migrate`
9. Run migrations: `php artisan db:seed`
10. Start the development server: `php artisan serve`

## Usage

1. Access the admin panel via http://your-app-url/admin/login. credentials: (lakshit@yopmail.com | 123456789)
2. Access the user panel via http://your-app-url/login. credentials: (admin@yopmail.com | 123456789)

## Additional Information

This README provides a detailed guide to setting up and using the Laravel 11 practical task project with Laravel Breeze for authentication scaffolding. Follow the instructions carefully to ensure a smooth development and testing experience.

## License

This project is licensed under the [MIT License](LICENSE).
