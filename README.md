# Elevator simulator
Configure and get a report of a simulation, train a neural-net with data report, for get the control of elevators actions.

# Important
This file is constantly changing, dedicate 1 min to read.

# Installation
If you want to install this project on a subfolder of server root path like '/var/www/html/folder-name/',:

1. Go to Autoloader.php file and set 'prooject_root_path = "/folder-name/"'
2. Go to RouterManager.php file and set 'request_controllers as = ["/folder-name/" => "index"]'.

This 2 variables provides you to make separeted projects in sub-folders easy, and the rest of clases, methods, and assets (js, css, img, tmp) works automatically.

3. Go to index_controller.php and set 'project_root_path = "/folder-name/"'

4. Go to MySQLiConn.php and change basic data-base configuration.

And nothing more.

# Requirements
This project is based on MVC model, and develops in PHP 7.

# More:

## Adding new pages
If you want to create a new page, for example, called create-model.php:

1. Create file 'create-model_controller.php' and put on controllers folder.
2. Create this two lines on file:
     '$project_root_path = "/"; require $_SERVER["DOCUMENT_ROOT"].$project_root_path."lib/Autoloader.php";'
     or
     '$project_root_path = "/folder_name/"; require $_SERVER["DOCUMENT_ROOT"].$project_root_path."lib/Autoloader.php";'
     if your projects is placed on a subfolder of root server path
3. Go to RouterManager.php file and add new route to 'request_controller' variable:
   '["/create-model/" => "create-model"]'
   or
   '["/folder-name/create-model/" => "create-model"]'
   if your projects is placed on a subfolder of root server path

The model and view names, and require methods and actions used from controller to this files and in this files, its your decision.

## Adding Js and Css to new pages
If you want to add Js and Css on pages, get the name of page, for example, called create-model.php and:
1. Go to /assets/js/ folder, and create crate-model.js file
2. Go to /assets/css/ folder, and create crate-model.css file

## Lib folder
In this folder, you can find clases like FilePathManager, with functions for return complete path for different folders, when you need to call a file or static function, or MysqlTableManager, instantiate passing the name of table in db, and use his functions to get simply, a lot of registers in db returning in a simple array for use directly in the rest of code.
Every method is provided with a description.
