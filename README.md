User-Friendly Application and API

Title: User and Car Management

This repository houses a user-friendly application coupled with a comprehensive API for user registration, login, and car model management. Users can seamlessly register, log in, create car models, update, edit, or delete cars, and manage their own user accounts through an intuitive interface. The API is designed to be tested using Postman while the application provides a user-friendly frontend for these features.

Application Features

User Registration and Login

User-friendly registration and login interfaces.

Car Model Management

User-friendly car model creation, editing, and deletion.
User-friendly listing and viewing of car models.
User-friendly interface for car model updates.

User Management

User-friendly user profile creation and editing (admin features).
User-friendly user account deletion (admin features).
User-friendly user listing and viewing (admin features).

API Endpoints

User Registration

POST /api/register - Register a new user.

User Login

POST /api/login - Log in to your account and obtain a Sanctum token for authentication.
Car Models

GET /api/products - Retrieve a list of all car models (accessible to everyone).

GET /api/products/{id} or GET /api/products?id=2 - Retrieve a specific car model by its ID or parameter (accessible to everyone).

POST /api/products - Create a new car model (accessible for logged-in users).

PUT /api/products/{id} - Update an existing car model (accessible for logged-in users).

DELETE /api/products/{id} - Delete a car model by its ID (accessible for logged-in users).

User Management

GET /api/users - Retrieve a list of all users (accessible only for logged-in users).

POST /api/users - Create a new user (accessible only for administrators).

PUT /api/users/{id} - Edit user information (accessible for the user or administrators).

DELETE /api/users/{id} - Delete a user account (accessible only for administrators).

Testing with Postman
To test the API using Postman, follow the instructions provided in the API section of this README. For the user-friendly application, explore the features through the intuitive interface.

Note
Make sure to include the authentication token (received upon login) in the headers of requests that require authentication. You can set the Authorization header with the token as Bearer YOUR_TOKEN.

This API is designed for educational and testing purposes. Please use it responsibly and ensure proper security measures are in place when deploying it in a production environment.
