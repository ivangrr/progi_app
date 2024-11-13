<?php
class Fees {  
  // Properties
  
  // Methods  
  /*
    Basic buyer fee: 10% of the price of the vehicle
    Common: minimum $10 and maximum $50
    Luxury: minimum 25$ and maximum 200$
  */
  public static function basicBuyerFee($price, $vehicule_type) {
    $result = $price * 0.1;

    if($vehicule_type == "COMMON"){
        if($result < 10){
            $result = 10;
        }
        elseif($result > 50){
            $result = 50;
        }
    }
    else{
        if($result < 25){
            $result = 25;
        }
        elseif($result > 200){
            $result = 200;
        }
    }
    return $result;
  }

  /*
    The seller's special fee:
    Common: 2% of the vehicle price 
    Luxury: 4% of the vehicle price
  */

  public static function sellerSpecialFee($price, $vehicule_type) {
    if($vehicule_type == "COMMON"){
        $result = $price * 0.02;
    }
    else{
        $result = $price * 0.04;
    }
    return $result;
  }

  /*
    The added costs for the association based on the price of the vehicle:
    $5 for an amount between $1 and $500
    $10 for an amount greater than $500 up to $1000
    $15 for an amount greater than $1000 up to $3000
    $20 for an amount over $3000
  */
   
  public static function associationFee($price) {
    if($price >= 1 && $price <= 500) {
        $result = 5;
    }
    elseif($price > 500 && $price <= 1000) {
        $result = 10;
    }
    elseif($price > 1000 && $price <= 3000) {
        $result = 15;
    }
    else {
        $result = 20;
    }
    return $result;
  }
}
?>
