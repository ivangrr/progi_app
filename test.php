<?php
require_once 'fees.php';

$result = Fees::basicBuyerFee(501, "COMMON");
echo $result." - Fees::basicBuyerFee(501, \"COMMON\") - ";
echo round($result, 2) == round(50, 2) ? "approved" : "error";
echo "<br>";

$result = Fees::basicBuyerFee(398, "COMMON");

echo $result." - Fees::basicBuyerFee(398, \"COMMON\") - ";
echo round($result, 2) == round(39.8, 2) ? "approved" : "error";
echo "<br>";

$result = Fees::sellerSpecialFee(501, "COMMON");
echo $result." - Fees::sellerSpecialFee(501, \"COMMON\") - ";
echo round($result, 2) == round(10.02, 2) ? "approved" : "error";
echo "<br>";

$result = Fees::sellerSpecialFee(398, "COMMON");
echo $result." - Fees::sellerSpecialFee(398, \"COMMON\") - ";
echo round($result, 2) == round(7.96, 2) ? "approved" : "error";
echo "<br>";

$result = Fees::associationFee(499);
echo $result." - Fees::associationFee(499) - ";
echo round($result, 2) == round(5, 2) ? "approved" : "error";
echo "<br>";

$result = Fees::associationFee(700);
echo $result." - Fees::associationFee(700) - ";
echo round($result, 2) == round(10, 2) ? "approved" : "error";
echo "<br>";

