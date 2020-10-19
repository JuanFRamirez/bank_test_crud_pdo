<?php
include_once 'connection.php';
include_once 'query.php';

$name = isset($_POST['name']) ? filter_var($_POST['name'],FILTER_SANITIZE_STRING) : '';
$password = isset($_POST['password']) ? ($_POST['password']) : '';
$userid = isset($_POST['user_id']) ? filter_var($_POST['user_id'],FILTER_SANITIZE_NUMBER_INT) : 0;
$money = isset($_POST['money']) ? filter_var($_POST['money'],FILTER_SANITIZE_NUMBER_INT) : 0;
$opc = isset($_POST['opc']) ? filter_var($_POST['opc'],FILTER_SANITIZE_STRING) : '';


class executeConnection extends DBConnection{

    public function retrieveUser($name,$password){
        
        try{

            $stm = $this->connect()->prepare("SELECT u.id,u.name,u.lastname,m.id,m.user_id,m.money from account as u join money as m where u.id = m.id  and name = ? and password = ?");
            $stm->execute([$name,$password]);
    
            if($stm->rowCount() == 0){
                echo 
                "<div class='no-user'>
                        <p>User not Found</p>
                        <br>
                        <button class='btn btn-info create-user' data-toggle='modal' data-target='#new-customer'>Create User</button>
                </div>";
                return;
            }

                while($user = $stm->fetch()){
    
                    echo "
                    <h3 class='welcome'>Welcome</h3>
                        <p>Your balance is: </p>
                    <label class='ammount_info' data-id={$user['id']} data-name={$user['name']} data-accountid={$user['user_id']}>{$user['money']}</label>
                    <div id='retire' class='col-sm-7 retire' style='margin-top:3%'>
                    <label>Make a retirement</label><br>
                    <button class='btn btn-info makeRetirement' id='makeRetirement'>Go</button>
                    </div>

                    <div id='deposit' class='col-sm-7 deposit' style='margin-top:3%'>
                    <label>Make a Deposit</label><br>
                    <button class='btn btn-info makeDeposit' id='makeDeposit'>Go</button>
                    </div>";
                }
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
     
    }
    public function update_user_account($money,$userid){
        $stm = $this->connect()->prepare(update_user_account());
        $stm -> bindParam(':money',$money,PDO::PARAM_INT);
        $stm -> bindParam(':user_id',$userid,PDO::PARAM_INT);
        $stm -> execute();
    }

    public function insert_user_account($name,$lastname,$password){
        $stm = $this->connect()->prepare(insert_user_account());
        $stm->bindParam(':name',$name,PDO::PARAM_STR);
        $stm->bindParam(':lastname',$lastname,PDO::PARAM_STR);
        $stm->bindParam(':password',$password,PDO::PARAM_STR);
        $stm->execute();
    }
}

$start = new executeConnection();

if($opc === 'get_account'){

    $start->retrieveUser($name,$password);

}

if($opc === 'retire'){

    $start->update_user_account($money,$userid);
} 

if($opc === 'deposit'){

    $start->update_user_account($money,$userid); 
}

if($opc === "save_user"){
    $start->insert_user_account($name,$lastname);
}

?>