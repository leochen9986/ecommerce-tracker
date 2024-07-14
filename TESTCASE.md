# Test Cases

This document outlines the test cases for the `ecommerce-tracker` project.

## Table of Contents

- [Authentication](#authentication)
  - [Register](#register)
  - [Login](#login)
- [Products](#products)
  - [Create Product](#create-product)
  - [List Products](#list-products)
- [Purchases](#purchases)
  - [Create Purchase](#create-purchase)
  - [List Purchases](#list-purchases)
- [Sales](#sales)
  - [Create Sale](#create-sale)
  - [List Sales](#list-sales)

## Authentication

### Register

- **Test Case 1: Successful Registration**
  - **Description:** Registers a new user.
  - **Request:**
    ```json
    {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```
  - **Expected Response:**
    - Status Code: 201
    - Body:
      ```json
      {
        "token": "your_jwt_token_here"
      }
      ```

- **Test Case 2: Registration with Existing Email**
  - **Description:** Attempts to register a user with an already registered email.
  - **Request:**
    ```json
    {
      "name": "Jane Doe",
      "email": "john@example.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```
  - **Expected Response:**
    - Status Code: 422
    - Body:
      ```json
      {
        "errors": {
          "email": ["The email has already been taken."]
        }
      }
      ```

### Login

- **Test Case 1: Successful Login**
  - **Description:** Authenticates a user and returns a JWT token.
  - **Request:**
    ```json
    {
      "email": "john@example.com",
      "password": "password"
    }
    ```
  - **Expected Response:**
    - Status Code: 200
    - Body:
      ```json
      {
        "token": "your_jwt_token_here"
      }
      ```

- **Test Case 2: Unsuccessful Login**
  - **Description:** Attempts to authenticate a user with incorrect credentials.
  - **Request:**
    ```json
    {
      "email": "john@example.com",
      "password": "wrongpassword"
    }
    ```
  - **Expected Response:**
    - Status Code: 401
    - Body:
      ```json
      {
        "error": "Unauthorized"
      }
      ```

## Products

### Create Product

- **Test Case 1: Successful Product Creation**
  - **Description:** Creates a new product.
  - **Request:**
    ```json
    {
      "name": "Product Name",
      "price": 100.00,
      "quantity": 10
    }
    ```
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 201
    - Body:
      ```json
      {
        "id": 1,
        "name": "Product Name",
        "price": 100.00,
        "quantity": 10,
        "created_at": "2024-07-15T00:00:00.000000Z",
        "updated_at": "2024-07-15T00:00:00.000000Z"
      }
      ```

### List Products

- **Test Case 1: List All Products**
  - **Description:** Retrieves a list of all products.
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 200
    - Body:
      ```json
      [
        {
          "id": 1,
          "name": "Product Name",
          "price": 100.00,
          "quantity": 10,
          "created_at": "2024-07-15T00:00:00.000000Z",
          "updated_at": "2024-07-15T00:00:00.000000Z"
        }
      ]
      ```

## Purchases

### Create Purchase

- **Test Case 1: Successful Purchase Creation**
  - **Description:** Records a new purchase transaction.
  - **Request:**
    ```json
    {
      "product_id": 1,
      "quantity": 10,
      "cost_per_unit": 15.50,
      "transaction_date": "2024-07-15"
    }
    ```
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 201
    - Body:
      ```json
      {
        "id": 1,
        "product_id": 1,
        "quantity": 10,
        "cost_per_unit": 15.50,
        "transaction_date": "2024-07-15",
        "created_at": "2024-07-15T00:00:00.000000Z",
        "updated_at": "2024-07-15T00:00:00.000000Z"
      }
      ```

### List Purchases

- **Test Case 1: List All Purchases**
  - **Description:** Retrieves a list of all purchase transactions.
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 200
    - Body:
      ```json
      [
        {
          "id": 1,
          "product_id": 1,
          "quantity": 10,
          "cost_per_unit": 15.50,
          "transaction_date": "2024-07-15",
          "created_at": "2024-07-15T00:00:00.000000Z",
          "updated_at": "2024-07-15T00:00:00.000000Z"
        }
      ]
      ```

## Sales

### Create Sale

- **Test Case 1: Successful Sale Creation**
  - **Description:** Records a new sale transaction, checking product quantity and updating product details.
  - **Request:**
    ```json
    {
      "product_id": 1,
      "quantity": 5,
      "sale_price": 20.00,
      "transaction_date": "2024-07-15"
    }
    ```
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 201
    - Body:
      ```json
      {
        "id": 1,
        "product_id": 1,
        "quantity": 5,
        "sale_price": 20.00,
        "cost_per_unit": 15.50,
        "transaction_date": "2024-07-15",
        "created_at": "2024-07-15T00:00:00.000000Z",
        "updated_at": "2024-07-15T00:00:00.000000Z"
      }
      ```

- **Test Case 2: Insufficient Product Quantity**
  - **Description:** Attempts to record a sale transaction with insufficient product quantity.
  - **Request:**
    ```json
    {
      "product_id": 1,
      "quantity": 1000,
      "sale_price": 20.00,
      "transaction_date": "2024-07-15"
    }
    ```
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 400
    - Body:
      ```json
      {
        "error": "Insufficient product quantity"
      }
      ```

### List Sales

- **Test Case 1: List All Sales**
  - **Description:** Retrieves a list of all sale transactions with costing information.
  - **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token_here"
    }
    ```
  - **Expected Response:**
    - Status Code: 200
    - Body:
      ```json
      [
        {
          "id": 1,
          "product_id": 1,
          "quantity": 5,
          "sale_price": 20.00,
          "cost_per_unit": 15.50,
          "transaction_date": "2024-07-15",
          "created_at": "2024-07-15T00:00:00.000000Z",
          "updated_at": "2024-07-15T00:00:00.000000Z",
          "product": {
            "id": 1,
            "name": "Product Name",
            "price": 100.00,
            "quantity": 5,
            "created_at": "2024-07-15T00:00:00.000000Z",
            "updated_at": "2024-07-15T00:00:00.000000Z"
          }
        }
      ]
      ```

## Summary

1. **Authentication**: Test cases for user registration and login.
2. **Products**: Test cases for creating and listing products.
3. **Purchases**: Test cases for creating and listing purchase transactions.
4. **Sales**: Test cases for creating and listing sale transactions, including validation for sufficient product quantity.

This `TEST_CASES.md` document provides detailed information on test cases for each API endpoint in your `ecommerce-tracker` project. Let me know if you need any more details or further assistance!
