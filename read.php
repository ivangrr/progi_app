<?php
 
require_once 'config.php';
require_once 'fees.php';

$dsn = "sqlite:$db";

try {
    // connect to database
    $pdo = new PDO($dsn);

    // get all bids from database sorted by latest first
    $sql = "SELECT VEHICLE_PRICE AS price, VEHICLE_TYPE.DESCRIPTION AS vehicule_type, 0 AS basic_buyer_free, 0 AS seller_special_fee,  0 AS association_fee, 100 AS storage_fee, 0 AS total_price  FROM BID, VEHICLE_TYPE WHERE BID.vehicle_type_id = VEHICLE_TYPE.vehicle_type_id ORDER BY bid_id DESC";
    $result = $pdo->prepare($sql);
    $result->execute([]);
    $data = $result->fetchAll();

    foreach ($data as $row => $bid) {
        $data[$row]['basic_buyer_free'] = round(Fees::basicBuyerFee($bid['price'], $bid['vehicule_type']), 2);
        $data[$row]['seller_special_fee'] = round(Fees::sellerSpecialFee($bid['price'], $bid['vehicule_type']), 2);
        $data[$row]['association_fee'] = round(Fees::associationFee($bid['price']), 2);
        $data[$row]['total_price'] = $data[$row]['price'] + $data[$row]['basic_buyer_free'] + $data[$row]['seller_special_fee'] + $data[$row]['association_fee'] + $data[$row]['storage_fee'];
    }
    // send all records fetched back to AJAX
    echo json_encode($data);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}