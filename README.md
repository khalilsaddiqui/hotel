# Hotel Management System API

## Overview

This project is a RESTful API for managing hotels, rooms, and room facilities. It includes the following features:
- CRUD operations for hotels, rooms, and room facilities.
- Authentication using Laravel Sanctum.
- Seed sample data for testing.
- Sorting and searching functionality for hotels.

## Prerequisites

- PHP 7.4 or later
- Composer
- MySQL
- Docker (optional, for containerized setup)
- Postman (optional, for API testing)

## Setup Instructions

### 1. Clone the Repository

git clone https://github.com/khalilsaddiqui/hotel.git
cd hotel-management-system


### 2. Install Dependencies
composer install
### 3. Create and Configure .env File

cp .env.example .env

### 4. Generate Application Key

php artisan key:generate

### 5. Set Up the Database

### 6. Run Migrations and Seeders

php artisan migrate --seed
### 7. Set Up Sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

### 8. Run the Application

php artisan serve

# Docker Setup (Optional)

## 1. Build and Run Docker Containers
   docker-compose up -d
## 2. Run Migrations and Seeders Inside the Docker Container
    docker-compose exec app php artisan migrate --seed
# Postman Collection
  -Import the Postman Collection
  -Download the Postman collection JSON file from the repository: Hotel Management System Postman Collection.
  -Open Postman and click on the Import button.
  -Select the downloaded JSON file to import the collection.
  -Environment Setup
  -Download environment collection JSON file from the repository: Hotel Management System Postman Collection.
  -Open Postman and click on the Import button.
  -Select the downloaded JSON file to import the collection.
# Running Tests
- php artisan test
- note i have write all test cases but need to configure but due to timeline i cant 
# License

 - This project is open-source and available under the MIT License.




