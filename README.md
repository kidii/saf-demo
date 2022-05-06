## SAF DEMO

You must have Redis installed on your computer to use the application. Then you need to modify some data in the database section in the .env file.

Next steps:
1. Open a terminal, go to the application root path, then run these commands:

2. install all required php dependencies
```
composer install
```

3. install all required node dependencies
```
npm install 
```

4. build the frontend assets
```
npm run build
```

5. create the database tables, and imports some dummy data (optional)
```
php artisan migrate --seed 
```

6. same as above, just without dummy data
```
php artisan migrate
```

7. setup queue worker for sending email
```
php artisan queue:work
```