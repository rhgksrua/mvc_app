<?php
/**
 *
 * Url mapping
 *
 */
$this->get('/testpage', 'TestPage');
$this->get('/controller', 'hangman');
$this->get('/', 'home');
$this->get('/home', 'home');
$this->get('/hangman', 'hangman');
$this->post('/hangman', 'hangman@solve');

// EOF
