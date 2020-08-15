<?php
class connection{
    public static function connect(){
        $host="localhost";
        $username="root";
        $password="";
        $dbname="taka";


        try{
            $connection=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo "connection ipo</br>";

        }catch(PDOException $except){
            echo "error imejitokeza".$except->getMessage();
        }
        return $connection;
    }

}


?>