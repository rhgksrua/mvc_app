<?php

namespace Hankmvc\App\Core\DB;

class DB {
    public $instance = null;
    
    public function __construct(PDO $pdoInstance) {
        if ($instance === null) {
            $instance = $pdoInstance;
        } else {
            $instance = $pdoInstance;
        }
    }
    
    public function getInstance() {
        return $this->instance;
    }
}