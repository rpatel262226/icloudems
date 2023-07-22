
## How to install Laravel Project Bucket Manage

- php version require >=8.0.28
- git clone from git
- Go to the folder application using cd command on your cmd or terminal
- Run composer install on your cmd or terminal
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, - - username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run php artisan key:generate
- Run php artisan migrate



# Please set below value in php.ini
    - upload_max_filesize=1000M
    - memory_limit=2000M
    - max_execution_time=0

# Create procedure in database (you have to copy code from below file )
    - file name (project root directory)  - procedure.txt
  

# Run project (got to project directory in terminal and hit below command)
- php artisan serve
- open url in browser : http://127.0.0.1:8000/
