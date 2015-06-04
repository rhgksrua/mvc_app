<?php

/*
 *
 * Database
 *
 */

class Model {

    public $dbh = null;

    public function __construct($db) {
        $this->dbh = $db;
    }

    /*
     *
     *  Testing basic functionality
     *
     */
    public function test() 
    {
        $stmt = $this->dbh->prepare("SELECT first_name FROM users where last_name='Ullman'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($result);
        print("\n");

    }

    public function prepare($statments) 
    {

    }

    /**
     * Executes statements
     *
     * @param array $options options
     */
    public function execute($options) 
    {

        return;
    }

}


// END
