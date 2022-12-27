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

### Fake data
The admin user is created by default and its information can be changed in the file todosettings and index `default_admin`. 
To create a default admin user after entering your information, 
you must set the `create_default_admin` value to true so that the admin user will be created with your information using the seeder command.

default admin example 
```json
'default_admin' => [
    'first_name'  => 'Super',
    'last_name'   => 'Admin',
    'gender'      => 'male',
    'type'        => 'admin',
    'avatar'      => 'admin.png',
    'phone'       => '98 3030',
    'email'       => 'amirhosein.sahra@gmail.com',
    'password'    =>'123456789',
]
```

Also, if you need fake data, you can set the value of each of them to true in todosettings
```json
'create_default_admin' => true,
'create_fake_member' => true,
'create_fake_category' => true,
'create_fake_task' => true,
```
You can also set the amount of fake data for each one
```json
'number_fake_data' => [
    'user' => 19,
    'tasks' => 100,
    'category' => 10,
],
```
Now for insert fake data
```bash
php artisan db:seed
```
### Other settings file items

Determine the number of views of each model on the page
```json
'paginate' => [
    'user' => 10,
    'tasks' => 10,
    'category' => 10,
],
```

Determining the address and directory of users' avatars
```json
'path' => [
    'avatar' => 'images/avatars/',
],
```
Determine the maximum and minimum time for the task.
For example, if the max value is equal to 30 minutes,
the task created by the user cannot be less than this 
value from now until the task is executed.
```json
'time_permit' => [
    'min' => 30, // minutes
    'max' => '1 years',
],
```

### Final steps
```bash
php artisan serv
```

## Who to work?
Now the project has been implemented and the request can be sent with the defined endpoints


## License
[MIT license](https://opensource.org/licenses/MIT).
