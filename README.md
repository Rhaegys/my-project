# Description
User can use this app to create his own set of financial assets to monitor price of those assets and overall price of his set of assets.

# Environment:

.env - DATABASE_URL=mysql://root:admin@127.0.0.1:3306/db_symfony
MySQL - server_version: '8.0.16'
PHP 7.2
Server - Symfony Local Server
Bootstrap for CSS

# How to start:
Make sure that:
* PHP 7.2 is the current version of PHP used
* MySQL Server 8 is installed (I used Community version https://dev.mysql.com/downloads/mysql/) and configured for .env file
* Composer and GIT are installed

# Repository
git clone https://github.com/Rhaegys/my-project.git

# Time estimates

* 1hr - getting started, environment setup, first project setup
* 1hr - Set up SQL +
* 1.5hrs - Set up user registration and authentificaton + no serialization
* 1.5hr - Research API requests for data
* https://www.worldtradingdata.com/documentation#introduction
* https://www.alphavantage.co/documentation/#midprice
* There are two APIs, none of the ones from specification were working so i found these 2
* 1hr - Research context (instruments and all that)
* 3hrs - Store data in SQL for users (including fixes later)
* 3hrs - Process data for presentation (including fixes later)
* 3hrs - Set up tables and views (including fixes later)
* 5hrs - Troubleshooting while constructing (API differences, overall difficulties, spent 1hr fixing 1 unnoticed line)
* 2hrs - Bootstrap 
* 3hrs - Fixing Application logic
* 1hr - Testing of the app
* 3hrs - Fixing errors and bugs
* 0.5hrs - Testing of the app

All in all time estimates are pretty vague - can't remember all of them, only the first 5 entries are entirely correct

