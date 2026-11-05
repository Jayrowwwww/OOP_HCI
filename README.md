# Open Library

A Laravel 9 library discovery app based on the supplied Figma reference. It uses sample catalog content and SQLite for member accounts.

## Run locally

Requirements: PHP 8.0+ and Composer. SQLite must be enabled in PHP (`pdo_sqlite`).

```powershell
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

Open the local URL printed by Artisan. The default configuration stores the SQLite database in `database/database.sqlite`.

## Pages

- `/` — discovery home with search, featured collections, and popular resources
- `/catalog` — searchable catalog with category filters
- `/register` — create a member account with a name, email, and password
- `/login` — sign in to an existing account

Registration signs the new member in automatically. Sign out from the button in the top bar. Passwords are hashed by Laravel; login attempts are rate limited.
