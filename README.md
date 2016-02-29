
_This is a work in progress_

# MVC in PHP


## Basic implementation of MVC for PHP

### Getting Started

There are no dependencies.

run `git clone https://github.com/rhgksrua/mvc_app.git`.

run `composer install`. Although there are no dependencies, createing `vendor/autoload.php` allows adding dependencies throught Composer.

`RewriteEngine On` and `AllowOverride all` might be required in vhost settings for proper routing (for `.htaccess`).

#### Creating a basic website
---

##### Create a new file in `/controller` directory

i.e. `/controller/Home.php`
Example of `Home.php`
```php
<?php

// namespace is required
namespace Hankmvc\controller;

use \Hankmvc\controller\Controller as Controller;

// Your controllers must extend Controller
class Home extends Controller
{
    public function index()
    {
        ...stuff inside
    }
}
```
***

##### Set your routes in `helper/routes.php`

** routes in `routes.php` must have a controller attached.  routes without a controller will results in a PHP Fatal error.

*Only GET and POST methods are implemented*

ex.

```php
$this->get('/home', 'Home');
```
`Home.php` is where all the logic will reside. `.php` extension is not required.
`index` is the default method invokes if none given.
Your own method can be set by
```php
$this->get('/home', 'Home@show');
```
Home needs a `show` method.

ex.
```php
<?php

class Home extends Controller
{
    public function show()
    {
        ...stuff inside
    }
}
```
***
##### Next, a template needs to be created.

Add a new file to `/view/templates`

i.e.

`/view/tempaltes/home.php`

***
##### Inside `Home` controller, template needs to be rendered.
```php
class Home extends Controller
{
    public function show()
    {
        return $this->view->render('home');
    }
}
```
`render()` method takes name of the template as the parameter.
An optional second parameter can be added to pass variables to the template.

ex.
```php
class Home extends Controller
{
    public function show()
    {
        $arrayOfText = [
            'hello' => 'world',
            'foo' => 'bar'
        ];
        return $this->view->render('home', $arrayOfText);
    }
}
```

Variables `$hello` and `$foo` is available in the `home.php` template.

**
#### Using Model class
A PDO instance is loaded in to `Model.php` as `$db`.  Refer to PHP PDO class for connecting and querying the database. 

In your controller, an instance of PDO is available as `$this->model`.

[PHP PDO link](http://php.net/manual/en/book.pdo.php)

#### Config file

Configuration file is in `/helper/config.php`.  Curerntly stores username and password for MySql.

## TODO

* Refactor app and router
