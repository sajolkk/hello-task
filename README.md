# Project Description
### Laravel Version 9.19
### Basic Laravel Auth 
### Vite
### Adminlte
### Datatable.net with laravel pagination for company/employee list
### Using mailtrap for mailing
### Using Redis and Queue for mail send 

<br/> <br/>
 
 ## Project Setup for local
 ### 1. Clone GitHub repo for this project locally
 ### 2. Install Composer Dependencies 
    composer install
 ### 3. Install NPM Dependencies 
    npm install
 ### 4. Create a copy of your .env file 
    cp .env.example .env
 ### 5. Generate an app encryption key 
    php artisan key:generate
### 6. Set Database Name, User name and password
### 7. Change queue conneciton to redis
    QUEUE_CONNECTION=redis
### 8. Setup Mailtrap Information for mailing
### 9. Migrate the database
    php artisan migrate
### 10. Seed the database  to create the first user with email "admin@admin.com" and password “password”
    php artisan db:seed
### 11. Run the server
    php artisan server
### 12. Run npm server for vite 
    npm run dev or npm run build

    
