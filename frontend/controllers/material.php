<?php 

try{
    $con = new PDO("mysql:host=localhost;dbname=le", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch(PDOException $e) {
    echo "Failed to connect to " . $e->getMessage();
}

    if(isset($_POST["materialID"])) {

        $value = $_POST["materialID"];

        $query = $con->prepare("SELECT descrMat FROM inventario WHERE matID = :id");
        $query->bindParam(":id", $value);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        echo json_encode($row);


    }

?>