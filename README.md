# Quota Management System

**Welcome to the Quota Management System**, a Laravel-based web application for managing quotas for different sports, genders, and categories.

## Project Overview

The Quota Management System is a web application that allows administrators to manage quotas for various sports, genders, and categories. It provides an intuitive user interface to set and update quotas based on different parameters.

## Features

- Create and manage quotas for sports, genders, and categories.
- Dynamically load categories based on selected sport and gender.
- Enter and validate quota values for different states.
- Perform client-side and server-side validation for quota values.
- Display overall quota information retrieved from the server.
- Submit quota data to the server and receive success/error messages.

## Getting Started

1. **Clone the repository:**

   ```bash
   git clone <repository-url>
   cd quota-management-system

2.**Install Dependencies:**

    ```bash
   composer install
   npm install

3.**Configure Environment:**
- Create a copy of the .env.example file and name it .env. Configure your database connection and other environment variables as needed.

4.**Generate Application Key:**

    ```bash
    php artisan key:generate

5.**Run Migrations and Seeders:**

   ```bash
    php artisan migrate --seed

6.**Run the Development Server:**

   ```bash
    php artisan serve

- The application should now be accessible at http://127.0.0.1:8000.
