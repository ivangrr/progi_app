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

    $sql = 'INSERT INTO BID(vehicle_price,vehicle_type) VALUES(:price, :vehicule_type)';
 
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

    // insert data the vehicule type COMMON 
    $vehiculeTypetId =  insert_vehicule_type($pdo, 'COMMON');
    insert_bid($pdo, 398, vehiculeTypetId);
    insert_bid($pdo, 501, vehiculeTypetId);
    insert_bid($pdo, 57, vehiculeTypetId);
    insert_bid($pdo, 1100, vehiculeTypetId);

    // insert data the vehicule type LUXURY 
    $vehiculeTypetId =  insert_vehicule_type($pdo, 'LUXURY');
    insert_bid($pdo, 1800, $vehiculeTypetId);    
    insert_bid($pdo, 1000000, $vehiculeTypetId);

    echo "Done";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}