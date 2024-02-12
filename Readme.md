1. Execute command cp .env.test .env
2. Execute command docker-compose up --build

Description route:

User:

POST /registration - registration user.
body {
"phone": "phone number",
"password": "pass"
}

POST /authorization- authorization user.
body {
"phone": "phone number",
"password": "pass"
}

PUT /users/{id} - changes user data. 
body {
"name": "name",
"email": "test@mail.ru",
"age": 20,
"sex": 1,
"birthDate": "2001-11-08T17:15:32.517Z",
"phone": "phone number"
}

DELETE /user/{id} - remove user.

GET /users/{id} - read user. 

Order:

POST /api/orders - create order. 
body {
"title": "test",
"description": "test",
"comment": "test",
"deadline": "2024-12-16"
}

GET /api/orders - read all orders for user.
query params for request - page=1 sort=1 (default)

DELETE api/order/{id} - remove order.

PUT api/orders/{id} - changes order data. 
body {
"title": "test",
"description": "test",
"comment": "test",
"deadline": "2024-12-16"
"status": true
}
