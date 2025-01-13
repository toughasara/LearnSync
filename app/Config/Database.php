<?php
namespace App\Config;
require __DIR__."../../goauto
";

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database{

    private $conn;

    public function connection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        try {
            $this->conn = new PDO("mysql:host=".$_ENV["LOCALHOST"].";dbname=".$_ENV["DATABASE"],$_ENV["USER"],$_ENV["USER_PASSWORD"]);
            echo 'connect';
            return $this->conn;
        } catch (PDOException $th) {
            die("connection faild".$th->getMessage());
        }
    }

}



?>