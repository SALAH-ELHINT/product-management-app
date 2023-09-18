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

![Home Page](https://user-images.githubusercontent.com/54600664/132135001-0b0a0b0a-0b0a-0b0a-0b0a-0b0a0b0a0b0a.png)

![About Me](https://user-images.githubusercontent.com/54600664/132135001-0b0a0b0a-0b0a-0b0a-0b0a-0b0a0b0a0b0a.png)

![Login](https://user-images.githubusercontent.com/54600664/132134964-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Register](https://user-images.githubusercontent.com/54600664/132134966-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Products](https://user-images.githubusercontent.com/54600664/132134967-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Add Product](https://user-images.githubusercontent.com/54600664/132134968-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Edit Product](https://user-images.githubusercontent.com/54600664/132134969-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Product Details](https://user-images.githubusercontent.com/54600664/132134970-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Filter Products](https://user-images.githubusercontent.com/54600664/132134971-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Search Products](https://user-images.githubusercontent.com/54600664/132134972-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

![Logout](https://user-images.githubusercontent.com/54600664/132134973-9b6b8b0a-3b0a-4b0a-8b0a-0b0a0b0a0b0a.png)

