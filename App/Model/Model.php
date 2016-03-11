<?php

namespace Hankmvc\App\Model;

/**
 * Connects to db.
 *
 * Create a method and call method from controller.
 * 
 * NOTE: Currently, Model.php only serves as a container for PDO.
 *       None of the methods are implemented.
 */
class Model {

    public $dbh = null;

    // Holds sql statements
    private $statements = [];

    /**
     * Sets PDO instance
     *
     * @param PDO $db
     */
    public function __construct($db) {
        $this->dbh = $db;
    }

    /**
     * Add prepared statements to be executed
     *
     * @param string sql statements
     * @return array Collection of all sql statements
     */
    public function prepare($statments) 
    {
        array_push($this->statements, $statements);
        return $this->statements;
    }

    /**
     * Executes statements
     *
     * @param array $options options
     * @return query
     */
    public function execute($options) 
    {
        $dbh = null;
        return false;
    }

}


// EOF
