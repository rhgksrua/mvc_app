<?php

/*
 *
 * Url mapping
 * 
 */

Router::get('/testpage', 'TestPage');

Router::get('/controller', 'hangman');

Router::get('/', 'home');
Router::get('/home', 'home');

Router::get('/hangman', 'hangman');
Router::post('/hangman', 'hangman@solve');

Router::put('/error', 'home');
