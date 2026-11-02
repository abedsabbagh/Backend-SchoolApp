
# SchoolApp — PHP Backend

A PHP/MySQL backend prototype developed for a university student portal application.

## Technologies
- PHP
- MySQL and PDO
- Composer
- Firebase PHP-JWT

## Features
- Student login endpoint
- Password-hash verification
- JWT token generation and verification helpers
- Modules for schedules and grades
- Assignment-related backend modules

## Project Structure
- `auth/` — Login endpoint
- `schedule/` — Schedule-related functionality
- `marks/` — Student marks
- `assignments/` — Assignment-related functionality
- `utils/` — Database, JWT and response utilities

## Installation
1. Install PHP, MySQL, and Composer.
2. Clone the repository.
3. Run `composer install`.
4. Configure the database locally.
5. Configure the JWT signing secret securely.

Note: Additional database setup may be required.

## Current Status
Academic prototype. End-to-end Android integration
and production readiness have not been verified.

## Security
Do not deploy without reviewing authentication,
authorization, credential management and error handling.

## Android Application
[SchoolApp Android Repository](https://github.com/abedsabbagh/SchoolApp)
