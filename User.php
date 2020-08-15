<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/23/2020
 * Time: 6:16 AM
 */

include ('connection.php');

class User
{
    static function insertUser($db,$username){


        $userQuery = $db->prepare("INSERT INTO users(username,password,role) VALUES (:username,:password,:role)");
        $userQuery->bindParam(":username",$username);
        $userQuery->bindValue(":password","zanzibar2020");
        $userQuery->bindValue(":role","owner");
        $execQuery = $userQuery -> execute();
        return $execQuery;
    }

    static  function  updateUser($db, $username, $password, $role, $userid){
        $updateQuery = $db -> prepare("update users set username=:username, password=:password, role=:role where user_id=:userid");
        $updateQuery->bindParam(":username",$username);
        $updateQuery->bindParam(":password",$password);
        $updateQuery->bindParam(":role",$role);
        $updateQuery->bindParam(":userid",$userid);
        $execQuery = $updateQuery -> execute();
        return $execQuery;
    }




}


