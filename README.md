# Quota Management System

**Welcome to the Quota Management System**, a Laravel-based web application for managing quotas for different sports, genders, and categories.

## Project Overview

The Quota Management System is a web application that allows administrators to manage quotas for various sports, genders, and categories. It provides an intuitive user interface to set and update quotas based on different parameters.

## Features

- **State Quota List:** The first tab provides an overview of all state-wise quotas that have been created. Here, you can easily view and track the quotas set for different states.

- **Overall Quota List:** The second tab displays the list of overall quotas that have been defined. This gives you an overview of the quotas established for various combinations of sports, gender, and categories.

- **Create Overall Quota:** In the third tab, you can create an overall quota for specific sports, gender, and category combinations. Once the data is created, you'll be automatically redirected to the next tab for creating state quotas.

- **Create State Quota:** The fourth tab enables you to create state quotas for specific sports, gender, and category combinations. State quotas can only be created if there is an available overall quota for the chosen combination. Additionally, the values for state quotas will be validated against the corresponding overall quota for that combination.

## Getting Started

1. **Clone the repository:**

   ```bash
   git clone https://github.com/mariappan16/quota-system.git
   cd quota-management-system

2. **Install Dependencies:**

   ```bash
   composer install
   npm install

3. **Configure Environment:**

- Create a copy of the .env.example file and name it .env. Configure your database connection and other environment variables as needed.

4. **Generate Application Key:**

    ```bash
    php artisan key:generate

5. **Run Migrations and Seeders:**

   ```bash
    php artisan migrate --seed

6. **Run the Development Server:**

   ```bash
    php artisan serve

- The application should now be accessible at http://127.0.0.1:8000.
