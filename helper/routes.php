<?php

// Routes to your websites

Router::get('/controller/', 'home');

Router::get('/', 'home');
Router::get('/home', 'home');

Router::get('/hangman', 'hangman');

Router::post('/hangman', 'hangman@solve');


