<?php


    $sdn = "mysql:host=localhost;dbname=task";
    $user = "root";
    $pass = "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    try {

        $db = new PDO($sdn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 
    catch (PDOException $e) {
        
        echo "failed " . $e->getMessage();
    }