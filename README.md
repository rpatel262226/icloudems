
## How to install Laravel Project Bucket Manage

- php version require >=8.0.28
- git clone from git
- Go to the folder application using cd command on your cmd or terminal
- Run <strong>composer install</strong> on your cmd or terminal
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, - - username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run <strong>php artisan key:generate</strong>
- Run <strong>php artisan migrate</strong>



## Please set below value in php.ini
- upload_max_filesize=1000M
- memory_limit=2000M
- max_execution_time=0

## Create procedure in database (you have to copy code from below file )
- go to routing menu in database of phpmyadmin 
- create new routing  with name : <strong>csvImpTodb</strong>
- procedure code copy from - procedure.txt and paste there
- then save. procedure now created (<strong>csvImpTodb</strong>) in your db.please check
  

## Run project (got to project directory in terminal and hit below command)
- <strong>php artisan serve</strong>
- open url in browser : http://127.0.0.1:8000/
