MVC in PHP

Basic implementation of MVC for PHP


How it works

.htaccess redirects all request to /public/index.php
/public folder is where all web accessible files are stored.

App Class.

All requests except folders and files in /public are send to /public/index.php

New instance of App is created.

App class is in helper/mvc\_app.php file.
App contains Router class, which handles all the routes in routes.php.

If an requested URI does not exist, 404 message is shown.



Router Class.

Router Class is in helper/routing.php file.

static public $sites is an array that holds all the URIs in routes.php.
When Router Class is created, it gets the request URI and matches URIs from routes.php.
If matching URI is found, controller class and method is stored.

Example routes:

Controller methods can be set with @.

Router::get('/homepage', 'homepage');

www.example.com/homepage will open homepage with method of index.
(index is the default method)

Router::get('/homepage', 'homepage@foobar');

www.example.com/homepage will open homepage with method of foobar.

Router::post('/homepage', 'homepage@postsomething');

If request method is post, postsomething method will be called.

Currently only get and post is implemented.





Model

models need to extend Model class.

Controllers need to extend Controller class to connect to DB(PDO).

Controller needs to call connectDB() and loadModel(string $model)

loadModel($model) Parameters

model
-Name of you model php file i.e. HomeModel.php

$this->model contains model instance.

call method on $this->model.

i.e. $this->model->method();


View Class.

View class handles rendering.  

Template engine is not implemented yet.
