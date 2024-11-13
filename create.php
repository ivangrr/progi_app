<?php
 
require_once 'config.php';

$dsn = "sqlite:$db";

function insert_vehicule_type($pdo, $description)  {
    $sql = 'INSERT INTO VEHICLE_TYPE(description) VALUES(:description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':description', $description);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function insert_bid($pdo, $price, $vehicule_type) {

    $sql = 'INSERT INTO BID(vehicle_price,vehicle_type_id) VALUES(:price, :vehicule_type)';
 
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':price' => $price,
        ':vehicule_type' => $vehicule_type,
    ]);

    return $pdo->lastInsertId();
}

try {
    // connect to database
    $pdo = new PDO($dsn);

    // insert bid
    insert_bid($pdo, $_POST["price"], $_POST["vehicule_type"]);

    echo "Done";
    
} catch (\PDOException $e) {
    echo $e->getMessage();
}