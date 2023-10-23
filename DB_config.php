<?php
class DB_config {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "db_dtr_system";

    public function connect() {
        return new mysqli($this->host, $this->username, $this->password, $this->db_name);
    }
}
?>