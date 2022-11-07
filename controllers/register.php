<?php

require "../model/database.php";

class Register extends DatabaseConnection
{
    private $username;
    protected $password;
    public function set_register($username, $password)
    {
        $input = [
            $this->username = $username,
            $this->password = $password
        ];
        try {
            $connection = parent::connect();

            $query_check = "SELECT username FROM users WHERE username = ?";
            $_check = $connection->prepare($query_check);
            $_check->execute([$input[0]]);
            if ($_check->rowCount() !== 0) {
                echo json_encode(
                    [
                        'status_response' => 0,
                        'msg' => "Username Taken!"
                    ]
                );
            } else {
                $query_register = "INSERT INTO users(username, `password`) VALUES(?,?)";
                $_register = $connection->prepare($query_register);
                $_register->execute($input);
                echo json_encode(
                    [
                        'status_response' => 1,
                        'msg' => "User Registration Success!"
                    ]
                );
            }
        } catch (PDOException $th) {
            die('ERROR : ' . $th->getMessage() . "<br>");
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $init = new Register;
    $init->set_register(
        $username,
        $password
    );
} else {
    echo "No POSTS made";
}
