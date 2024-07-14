# Ecommerce Tracker

A Laravel project for tracking e-commerce purchases and sales, including JWT authentication, product management, and transaction recording.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Seeding](#database-seeding)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL
- Laravel 

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/leochen9986/ecommerce-tracker
   cd ecommerce-tracker
   ```


2. **Install dependencies:**

   ```bash
    composer install
    npm install
    npm run dev
   ```

3. **Copy the .env.example file to .env and update environment variables:**

   ```bash
    cp .env.example .env
   ```

4. **Generate the application key:**

   ```bash
    php artisan key:generate
   ```

5. **Generate the JWT secret:**

   ```bash
    php artisan jwt:secret
   ```

## Configuration
1. **Update the .env file with your database configuration:**
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ecommerce_tracker
    DB_USERNAME=root
    DB_PASSWORD=password
   ```

2. **Run the migrations:**
   ```bash
    php artisan migrate
   ```

## Database Seeding
1. **Seed the database with initial data:**
   ```bash
    php artisan db:seed
   ```

## Usage
1. **Start the development server:**
   ```bash
    php artisan serve
   ```

2. **Your application should now be running at:**
   ```bash
    http://127.0.0.1:8000
   ```


## API Endpoints

### Authentication

#### Register

- **URL:** `POST /api/register`
- **Body:**
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
  }
   ```

- **Description**: Registers a new user.


#### Login

- **URL:** `POST /api/login`
- **Body:**
  ```json
    {
    "email": "john@example.com",
    "password": "password"
    }
   ```
- **Description**: Authenticates a user and returns a JWT token.


#### Products
##### Create Product
- **URL:** `POST /api/products`
- **Body:**
  ```json
    {
    "name": "Product Name",
    "price": 100.00,
    "quantity": 10
    }
   ```
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**: Creates a new product.


##### List  Product
- **URL:** `GET  /api/products`
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**: Retrieves a list of all products.


#### Purchases
##### Create Purchase
- **URL:** `POST /api/purchases`
- **Body:**
  ```json
    {
    "product_id": 1,
    "quantity": 10,
    "cost_per_unit": 15.50,
    "transaction_date": "2024-07-15"
    }
   ```
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**: Records a new purchase transaction and updates the product's average cost and quantity.


##### List  Purchases
- **URL:** `GET  /api/purchases`
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**:  Retrieves a list of all purchase transactions.

#### Sales
##### Create Sales
- **URL:** `POST /api/sales`
- **Body:**
  ```json
    {
    "product_id": 1,
    "quantity": 5,
    "sale_price": 20.00,
    "transaction_date": "2024-07-15"
    }
   ```
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**: Records a new sale transaction, checks product quantity, and updates product quantity. Uses product's price as cost per unit if no purchase records exist.

##### List  Sales
- **URL:** `GET  /api/sales`
- **Headers**:   
```json
{
  "Authorization": "Bearer your_jwt_token_here"
}
   ```
- **Description**:  Retrieves a list of all sale transactions with costing information.


### Summary

1. **Authentication**: Register and login endpoints to handle user authentication.
2. **Products**: Endpoints to create and list products.
3. **Purchases**: Endpoints to create and list purchase transactions, updating the product's average cost and quantity.
4. **Sales**: Endpoints to create and list sale transactions, checking product quantity and updating product details.

This markdown guide provides detailed information on how to use each API endpoint in your `ecommerce-tracker` project. Let me know if you need any more details or further assistance!