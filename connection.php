<?php
class DBConnection{

    public $username = 'juan';
    public $password = '1234';

    public function connect(){
        $username =  $this->username;
        $password = $this->password;

        $conn = new PDO("mysql:host=localhost;dbname=bankaccount",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!$conn){
            echo 'error al conectar con el banco';
        }

        return $conn;
    }

}


?>