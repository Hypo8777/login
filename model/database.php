<?php


abstract class DatabaseConnection
{
    private     $hostname = "localhost";
    private     $dbUser  = "root";
    protected   $dbPass  = "";
    private     $dbName  = "login_db";

    public function connect()
    {
        $hostname = $this->hostname;
        $dbUser = $this->dbUser;
        $dbPass = $this->dbPass;
        $dbName = $this->dbName;
        try {
            $dsn = 'mysql:host=' . $hostname . ';dbname=' . $dbName;
            $pdo = new PDO($dsn, $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
            // echo  "Connected!";
        } catch (PDOException $ex) {
            die('ERROR : ' . $ex->getMessage() . "<br>");
        }
    }
}
