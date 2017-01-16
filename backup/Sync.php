<?php
require_once('Database.php');

class Sync {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    private function get_data() {
        
    }
}

new Sync();