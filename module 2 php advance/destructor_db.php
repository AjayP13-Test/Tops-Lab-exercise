<?php
class Database {
    public function __construct() {
        echo "Database connection established<br>";
    }
    public function __destruct() {
        echo "Database connection closed";
    }
}

$db = new Database();
?>
