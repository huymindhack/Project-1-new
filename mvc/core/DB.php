<?php

class DB{

    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "user_account";

    function connect(){
        $this->con = mysqli_connect($this->servername, $this->username, $this->password);
        if (!$this->con) {
            die("Could not connect to database");
        }

        return $this->con;
    }

}

?>