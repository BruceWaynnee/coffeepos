
# Coffee POS System 

Coffee POS System 

### Installation

-  ```git clone ```

- cd to the app directory and copy from .env.example

-  ```cp .env.example .env```

- change the the .env content (admin, database )

-  ```composer install```

-  ```php artisan key:generate```

-  ```php artisan migrate:fresh```

-  ```php artisan db:seed```

- To create symlink folder on linux

-  ```php artisan storage:link```

- On windows cmd run on project directory

-  ```mklink /D "public\storage" "..\storage\app\public"```

- Done. Go to domain/dashboard to see admin dashboard.
  

### Logins
| Logins  		| Super Admin 									                     |
| -------------|----------------------------------------------------------:|
| Logins  		| Admin 									                           |
| -------------|----------------------------------------------------------:|
| username     | `admin` 					                                    |
| email        | `admin@coffee.com`                                        |
| password 	   | `admin123`                            			            |
| permission   | `all permissions`                                         |
|              |                                                           |
| Logins  	   | Sales Manager 									                  |
| -------------|----------------------------------------------------------:|
| username     | `satya` 					                                    |
| email        | `satya@coffee.com`                                        |
| password 	   | `satya123`                              			         |
| permission   | `limite permissions`                                      |
|              |                                                           |

### Working With Image
 - Package Name (Intervention)
 - Open your composer and run following command to install the package
    -> composer require intervention/image

### Working With Permission
 - Package Name (Permission Spatie)
 - Open your composer and run following command to install the package
    ->  composer require spatie/laravel-permission
    ->  php artisan optimize:clear
 - Documentation: https://spatie.be/docs/laravel-permission/v4/installation-laravel
