<?php
/**
 * Url mapping
 *
 * $this-get({url}, {Controller@method});
 * If method is not specified, it defaults to 'index'
 * The last URI overwrites any previously set URIs
 */
$this->get('/testpage', 'TestPage');
$this->get('/controller', 'hangman');
$this->get('/', 'home@index');
$this->get('/home', 'home');
$this->get('/hangman', 'hangman');
$this->post('/hangman', 'hangman@solve');

// EOF
