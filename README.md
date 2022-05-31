## Setup and configure the Back End (requirements and steps)

- PHP >= 8.1.4
- Have Composer installed
- Have MySQL installed
- Create a database for the project
- Open a console in the directory of where the backend code is located: ./scopicTestBE
- In the console write the command: composer install
- After running the processes, you have to configure the .env file that is located within the ./scopicTestBE directory.
    - Change the name of the database DB_DATABASE for the one you created, and change the username and password, DB_USERNAME, DB_PASSWORD
- In the console write the command: php artisan migrate --seed
- After running the previous command, write a new command: php artisan serve
- Take into account that after using the previous command we have configured a virtual server that uses by default this URL: http://127.0.0.1:8000 if you use another type of virtual host, then you have to change the URL in the front end code.
- Do not close this console
- open a new console tab and add this command on the project { php artisan queue:work } in order to run the queue, this command is for listen the events from auto bids
- also, open a new console and run this command { php artisan schedule:work }, this command check the expiration bid and add the winning user for a bid item
- Important !! Please not close any terminal, we should have 3 terminal running on total
