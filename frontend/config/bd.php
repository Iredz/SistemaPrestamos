<?php 

    try{
        $con = new PDO("mysql:host=localhost;dbname=", "root", "le");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }catch(PDOException $e) {
        echo "Failed to connect to " . $e->getMessage();
    }

?>