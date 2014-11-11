MVC in PHP

Basic implementation of MVC for PHP


How it works

.htaccess redirects all request to /index.php




Model

models need to extend Model class.

Controller needs to call connectDB() and loadModel(string $model)

loadModel($model) Parameters

model
-Name of you model php file i.e. HomeModel.php

$this->model contains model instance.

call method on $this->model.

i.e. $this->model->method();
