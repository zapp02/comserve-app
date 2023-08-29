First Time Installation:
1.download and install the dependencies below
    - composer 'just search for composer setup'
    - node.js
    - php

2.after all files installed, run the composer on cmd
    check all the installed files by runnning these command:
    - php -v
    - node -v
    - composer
    - npm -v

3.app used :
    - vscode
    - XAMPP
    - postman (only for api test)

how to build: 
1. download the repo
2. get ".env.example" and adjust it into your environment (or just ask for the .env file)
3. run "php artisan key:generate" and make db with the same name with what is needed
4. import the db file to your phpmyadmin localhost (ecommerce-app.sql, you can get it from main branch) 
5. run "php artisan serve"
