![Logo](https://clickup.com/blog/wp-content/uploads/2019/01/to-do-list-apps.png)


## Todo list 

This project is a todo list with Laravel framework created with api. You can use this source as a sample code or a real project.

In this project, there are two types of users, admin and member. After registration, the user must confirm his email in order to enter his account.

Each user can create tasks with their own categories. Before reaching the time set for the task, an email will be sent to the user to inform them of the task and its execution time.
Tasks can be edited and the time set for the task should not be less than the value set in the settings.

For easy management, we have created a special project file in the config directory to put the settings in it.

By default, every user is a member type after registration, and only the admin user can be created by default, as the admin user is created by running the seeder command.
We will explain more about this later.

## How to use ?
Follow these steps to get this project live

### Get file
```bash
git clone https://github.com/amirsahra/todo-list-api
cd todo-list-api
composer install
php artisan key:generate
```
### Configure your .env file
Enter the database and table information that you have already created

For example :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```
### Create tables
```bash
php artisan migrate
```

php artisan migrate
```
### Fake data
To use fake data, you can use the created factories.
First, go to file `config/blogsetting.php` and change the `default_admin` with your information
Now :
```bash
php artisan db:seed
```
### Final steps
```bash
php artisan serv
```

## Who to work?
Now the project has been implemented and the request can be sent with the defined endpoints


## License
[MIT license](https://opensource.org/licenses/MIT).
