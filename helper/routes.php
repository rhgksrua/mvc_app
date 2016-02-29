<?php
/**
 * Url mapping
 *
 * $this-get({url}, {Controller@method});
 * If method is not specified, it defaults to 'index'
 * The last URI overwrites any previously set URIs
 */
$this->get('/', 'HomeController@index');
$this->get('/test', 'HomeController@test');

// EOF
