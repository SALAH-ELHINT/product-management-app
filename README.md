# Product Management App

Product Management App is a web application built using Laravel, Tailwind CSS, Vue.js, Laravel Jetstream, Nertia.js, and PHPUnit. It allows users to store and manage their products with features for user authentication, CRUD operations on products, searching, filtering, and more.

## Table of Contents

- [Product Management App](#product-management-app)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
  - [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Technologies Used](#technologies-used)
    - [Screenshots](#screenshots)

## Features

- User authentication and authorization.
- Add, edit, and delete products with details like name, description, size, and type.
- List products with search and pagination functionality.
- Basic validation to ensure required product fields are filled.
- Filter products based on specific criteria (e.g., name, type).

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- **PHP**: Ensure you have PHP installed on your system.
- **Composer**: Install Composer, a PHP package manager.
- **Node.js and NPM**: Install Node.js and NPM to manage JavaScript dependencies.
- **MySQL**: Set up a MySQL database for the application.

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/SALAH-ELHINT/product-management-app.git
   ```

2. Navigate to the project directory:

   ```bash
   cd product-management-app
   ```

3. Install the project dependencies:

   ```bash
    composer install
    npm install && npm run dev
    ```

4. Create a copy of the `.env.example` file and rename it to `.env`:
   
   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
    php artisan key:generate
    ```

6. Update the `.env` file with your database credentials:
   
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```

7. Run the database migrations and seed the database with products:
    
    ```bash
    php artisan migrate --seed
    ```

8.  Start the application:
    
    ```bash
    php artisan serve
    ```

9.  Visit the application at `http://localhost:8000`.
    
### Usage

- Register a new user account or log in with the default credentials:
  - **Email**: `
  - **Password**: ``
  - **Role**: `admin`
  - **Role**: `user`
  
- Add, edit, and delete products.
- Filter products by name, type, and size.
- Search for products by name.
- View product details.
- Log out of the application.
- Log in with a different user account.

### Technologies Used
- Laravel: PHP web application framework.
- Tailwind CSS: Utility-first CSS framework.
- Vue.js: JavaScript framework for building user interfaces.
- Laravel Jetstream: Provides pre-built authentication scaffolding.
- Nertia.js: A package for building server-rendered Vue.js applications.
- PHPUnit: PHP testing framework for unit testing.
- MySQL: Relational database management system.
- Git: Version control system.
- GitHub: Hosting service for Git repositories.


### Screenshots

![Home Page](https://cdn.discordapp.com/attachments/950852158117511208/1153234156805959720/Screenshot_2023-09-18_063440.png)

![About Me](https://cdn.discordapp.com/attachments/950852158117511208/1153234157091160064/Screenshot_2023-09-18_063504.png)

![Login](https://cdn.discordapp.com/attachments/950852158117511208/1153234157326049300/Screenshot_2023-09-18_063530.png)

![Register](https://cdn.discordapp.com/attachments/950852158117511208/1153234157573517373/Screenshot_2023-09-18_063549.png)

![Products](https://cdn.discordapp.com/attachments/950852158117511208/1153234157825163294/Screenshot_2023-09-18_063706.png)

![Add Product](https://cdn.discordapp.com/attachments/950852158117511208/1153234158127161344/Screenshot_2023-09-18_063801.png)

![Edit Product](https://cdn.discordapp.com/attachments/950852158117511208/1153234158387212358/Screenshot_2023-09-18_063821.png)

![Delete Product](https://cdn.discordapp.com/attachments/950852158117511208/1153234158613692496/Screenshot_2023-09-18_063852.png)

