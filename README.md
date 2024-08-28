## About Laravel Salat Time Notifier Project

This project integrates the Salat Time Notifier package with a fresh Laravel installation. It manages Salat times and sends notifications to a Slack channel 10 minutes before each Salat time.:

## Features

- Manage Salat times (Fajr, Dhuhr, Asr, Maghrib, Isha).
- Send notifications to a Slack channel 10 minite before each Salat time.
- Easily integrate into any Laravel project.

## Getting Started

Follow these steps to set up and run the project:

Prerequisites


- PHP >= 8.1.
- Composer
- Laravel Installer (optional)
- Slack Workspace and #salat-times channel


Installation:

1.Clone the Repository

    git clone https://github.com/AbulHossain-Adnan/laravel-salat-notifier.git


2.cd your-repository

3.Install Dependencies

    composer install

4.Set Up Environment

Copy the .env.example file to .env.

    cp .env.example .env

5.Configure the .env file with your Slack webhook URL:

env

    SLACK_WEBHOOK=https://hooks.slack.com/services/your/webhook/url

6.Generate the application key:

bash

    php artisan key:generate

7.Run Migrations

bash

    php artisan migrate

8.Start the Scheduler

To ensure notifications are sent on time, you need to run the Laravel scheduler. Add the following entry to your server's crontab:

bash

* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

Alternatively, you can run the scheduler manually for testing:

bash

    php artisan schedule:work


9.For run Salat time seeder  

    php artisan db:seed --class=welabs\\SalatNotifier\\seeders\\SalatTimeSeeder
    

10.Run the project

base

    php artisan serve


Usage

Add Salat Times
 
Populate the salats table with Salat times.

browse this /salat-times url to manage salat times

    http://127.0.0.1:8000/salat-times

   

Troubleshooting

    Ensure the Slack webhook URL is correctly set in the .env file.
    Verify that the salats table has the correct Salat times.
    make sure your default timezone is Asia/Dhaka on config/app
    Check the Laravel logs for any errors related to the scheduler or notifications.




## Salat Notifier Package Installation on Fresh Laravel



1. cd Your-project-path/fresh-laravel

2. Create a Symbolic Link:

To create a symbolic link from the package directory to your fresh Laravel project, you can use the following command:

    ln -s ~/Desktop/projects/laravel-salat-notifier/package/ ~/Desktop/projects/fresh-laravel/package

3.To Add repository to your fresh laravel project run this command:

       composer config repositories.salat-notifier path ./package/welabs/SalatNotifier

4. Run composer command:

       composer require welabs/salat-notifier

4. Run the migration

       php artisan migrate

    
5. Configure the .env file with your Slack webhook URL:

env

       SLACK_WEBHOOK=https://hooks.slack.com/services/your/webhook/url    


6>Now Run the scheduler manually for testing:

bash

      php artisan schedule:work


9.For Salat time seeder  

      php artisan db:seed --class=welabs\\SalatNotifier\\seeders\\SalatTimeSeeder

    

Contributing

Feel free to fork the repository and submit pull requests. For any issues or feature requests, please open an issue on GitHub.
