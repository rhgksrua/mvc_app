<?php

/*
 * Connects to db.
 * 
 * @param PDO 
 */
class Model {

    public $dbh = null;

    // Holds sql statements
    private $statements = [];

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

    /**
     * Add prepared statements to be executed
     *
     * @param string sql statements
     */
    public function prepare($statments) 
    {
        array_push($this->statements, $statements);
    }

    /**
     * Executes statements
     *
     * @param array $options options
     * @return query
     */
    public function execute($options) 
    {


        return false;
    }

}


// END
