<?php

require "../model/database.php";

class Login extends DatabaseConnection
{
    private $username;
    protected $password;
    public function set_login($username, $password)
    {
        $input = [
            $this->username = $username,
            $this->password = $password
        ];
        try {
            $connection = parent::connect();
            $query_login = "SELECT username, `password` FROM users WHERE username = ? AND `password` = ?";
            $_login = $connection->prepare($query_login);
            $_login->execute($input);
            if ($_login->rowCount() !== 0) {
                echo json_encode(
                    [
                        'status_response' => 1,
                        'msg' => "User Logged In Succesfully!",
                        'redirect' => 'main.html'
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'status_response' => 0,
                        'msg' => "Incorrect Username or Password, user does not exist!"
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
    $init = new Login;
    $init->set_login($username, $password);
} else {
    echo "No POSTS made";
}
