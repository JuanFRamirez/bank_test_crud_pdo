<?php

function update_user_account(){
    return "UPDATE money SET money = :money WHERE user_id = :user_id";
}

function insert_user_account(){
    return "INSERT INTO account (name,lastname,password) VALUES(:name,:lastname,:password)";
}


?>