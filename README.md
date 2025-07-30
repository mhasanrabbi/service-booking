
  

# Laravel API v1 – Booking and Service System

A RESTful API built with Laravel for managing user registration, authentication, services, and bookings. Admins can view all bookings, and users can register, log in, view services, and make bookings.


## 🚀 Features

  

- User Registration and Login (Sanctum-based token auth)

- CRUD operations for Services (authorized)

- Booking system for users

- Admin route for viewing all bookings

- RESTful API structure with versioning (`/api/v1`)

- Feature tests for Login and Registration using phpUnit

  

---

  

## 📂 Folder Structure Highlights

  

-  `routes/v1/api.php` – API v1 route definitions

-  `app/Http/Controllers/Api/v1` – Controllers

-  `tests/Feature`, `tests/Unit` – Test suites

-  `phpunit.xml` – Test config file

  
  

## 📘 API Documentation

  

Access the full API reference via Postman:

  

[![View API Docs](https://img.shields.io/badge/Postman-View%20API%20Docs-orange?logo=postman)](https://documenter.getpostman.com/view/14027624/2sB3B7QaJ1#54a0fd2e-28a1-4632-9548-d74903755b5b)

  
  

## ⚙️ Getting Started

  

Follow these steps to set up the project locally after cloning:

  

### 1. Clone the Repository
```bash
git  clone  https://github.com/mhasanrabbi/service-booking.git
cd  service-booking
```

### 2. Install Dependencies
```bash
composer  install
```

### 3. Set Up Environment

Copy the example `.env` file and configure your database:
```bash
cp  .env.example  .env
php  artisan  key:generate
```
Edit `.env` to match your database and app URL:

```bash
DB_DATABASE=your_db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```
  
### 4. Run Migrations
```bash
php  artisan  migrate
```

### 5. Serve the App
```bash
php  artisan  serve
```
The  app  will  be  accessible  at:
`http://localhost:8000`

API  routes  will be at:
`http://localhost:8000/api/v1`

## 🔐 Authentication
Use the following endpoints to register or log in:
-  `POST /api/v1/register`

-  `POST /api/v1/login`

These return a token. Use it in headers like:
````Authorization: Bearer your_token_here````

## 🧪 Running Tests

  
This project uses PHPUnit with a preconfigured `phpunit.xml`.

Copy the example.env file and create a .env.test and configure your database:
```bash 
cp .env.example .env.test
```

Edit .env.test to match your database and app URL:
```bash
DB_DATABASE=your_test_db_name
DB_USERNAME=your_test_db_username
DB_PASSWORD=your_test_db_password
```
Run all tests:
````bash
php  artisan  test
````

  

## 📬 API Test Endpoint
Use the following to check if the API is working:
````bash
GET  /api/v1/test
````
