<?php

class Hangman {

    private $page_var = null;
    private $name = '';
    private $word = '';
    private $used = '';
    private $error = '';
    private $next_word = '';
    private $regex = '';
    private $words_list = array();

    /*
     *
     * Initial visit
     *
     */
    public function index($page = "hangman") {

        if (isset($_GET['test'])) {
            zzz("get it set", "blank");
        }

        $this->page_var = array(
            'word' => $this->word,
            'used' => $this->used,
            'next' => $this->next_word,
            'matches' => array(),
            'error' => $this->error
        );

        return View::render($page, $this->page_var);

    }

    /*
     *
     * Solves hangman word by word
     *
     */
    public function solve($page = "hangman") {

        if (isset($_GET['test'])) {
            zzz("get it set", "blank");
        }

        // If word is not blank, solve hangman
        if (isset($_POST['word']) && !empty($_POST['word'])) {
            $this->word = $_POST['word'];

            // Check for valid word
            if (!preg_match('/^[a-zA-Z\?]+$/', $this->word)) {
                $this->error = 'Invalid word';

            } else {
                // Solve for missing letter HERE!!!!!
                $length = strlen($this->word);
                $this->next_word = $this->word;

                if (isset($_POST['used']) && !empty($_POST['used'])) {
                    $used = $_POST['used'];
                    $this->regex = "/^(" . str_replace('?', "[^$used]", $this->word) . ")$/im";
                } else {

                    $this->regex = "/^(" . str_replace('?', '[a-z]', $this->word) . ")$/im";
                }

                $this->next_word = str_replace('?', '_', $this->next_word);

                $file_words = file_get_contents('./model/words.txt');
                $words = preg_match_all($this->regex, $file_words, $matches, PREG_SET_ORDER);
                if ($words != FALSE) {
                    foreach ($matches as $word) {
                        $this->words_list[] = $word[0];
                    }
                } else {
                    $this->words_list = array('No matching words');
                }
            }
        } else {
            $this->error = "blank word entered";
        }

        $this->page_var = array(
            'word' => $_POST['word'],
            'used' => $_POST['used'],
            'next' => $this->next_word,
            'matches' => $this->words_list,
            'error' => ''
        );

        // error found
        if ($this->error != '') {
            $this->page_var['error'] = $this->error;
        } 
        
        return View::render($page, $this->page_var);
    }
}

// END
