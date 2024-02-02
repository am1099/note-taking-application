# note-taking-application

# Using sail

Share the GitHub repository URL and provide instructions for running the project:

-   Clone the repository
-   Navigate to the project directory: cd your-project-name
-   Build Docker containers: ./vendor/bin/sail up
-   Install Node.js dependencies: ./vendor/bin/sail npm install
-   Compile assets: ./vendor/bin/sail npm run dev
    You should be able to access the Laravel application locally at http://localhost.

# Using Xampp

Step 1: Go to https://www.apachefriends.org/index.html and install 'XAMPP' and start the "setup_xampp.bat" and beginning the installation.

Step 2: upon successful installation, open XAMPP, navigate and click on 'Start' for 'Apache' and 'MySQL'.

Step 3: Clone the repository

Step 4: Open Xampp window and click on 'admin' where it refrences 'MySQL' (should be the second line, next to 'Start/Stop' button), which should take you to the phpmyadmin page or you should be able to by typing in 'http://127.0.0.1/phpmyadmin/' in your browser.

Step 5: Once you are in phpmyadmin, Click on the 'New' button to create a database and add the name of the database to the .env file against DB_DATABASE.

Step 6: Install composer for the project and the node js dependencies with 'npm install'

Step 7: cd onto my project folder and run this command in terminal 'php artisan migrate' then 'php artisan db:seed --class=DatabaseSeeder' to run the seeder.

Step 8: for php unit testing please run the following command 'php artisan test'

Step 9: run 'php artisan serve' to run the website. Then run 'npm run watch'.
