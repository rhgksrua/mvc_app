
_This is a work in progress_

# PHP Framework


## Simple PHP Framework

### Getting Started

There are no dependencies.

Run `git clone https://github.com/rhgksrua/mvc_app.git`.

(OPTIONAL) Run `composer install`. `vendor/autoload.php` will be included if exists.

`RewriteEngine On` and `AllowOverride all` might be required in vhost settings for proper routing (for `.htaccess`).

#### Creating a basic website
---

##### Create a new file in `/controller` directory

i.e. `/App/Controller/Home.php`
Example of `Home.php`
```php
<?php

// namespace is required
namespace Hankmvc\Controller;

use \Hankmvc\App\Controller\Controller as Controller;

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

##### Set your routes in `App/routes.php`

** routes in `routes.php` must have a controller attached.  routes without a controller will results in a PHP Fatal error.

*Only GET and POST methods are implemented*

ex.

```php
$this->get('/home', 'Home');
```
`Home.php` is the controller. `.php` extension is not required.
`index` is the default method that invokes if none given.
Your own method can be set by
```php
$this->get('/home', 'Home@show');
```
`show` method is required in Home controller.

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

Add a new file to `App/View/templates`

i.e.

`App/View/templates/home.php`

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

Variables `$hello` and `$foo` are available in the `home.php` template.

**
#### Using Model class
A PDO instance is loaded in to `Model.php` as `$db`.  Refer to PHP PDO class for connecting and querying the database. 

Database configuration can be set in `App/config/config.php`.

In your model, an instance of PDO is available as `$this->dbh`.

[PHP PDO link](http://php.net/manual/en/book.pdo.php)

#### Config file

Configuration file is in `config/config.php`.  Curerntly stores username and password for MySql.

## TODO

