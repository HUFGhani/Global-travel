<?php 
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : "";
$links = isset($_GET['links']) ? $_GET['links'] : "";
$adultq = isset($_GET['adultQuantity']) ? $_GET['adultQuantity'] : "0";
$childq = isset($_GET['childQuantity']) ? $_GET['childQuantity'] : "0";
$studentq = isset($_GET['studentQuantity']) ? $_GET['studentQuantity'] : "0";
$seniorq = isset($_GET['seniorQuantity']) ? $_GET['seniorQuantity'] : "0";

if($adultq < 0 or is_numeric($adultq) == false){
    $adultq = 0;
}
if($childq < 0 or is_numeric($childq) == false){
    $childq = 0;
}
if($studentq < 0 or is_numeric($studentq) == false){
    $studentq = 0;
}
if($seniorq < 0 or is_numeric($seniorq) == false){
    $seniorq = 0;
}


if(isset($_SESSION['items'][$id])){
    if($links == 'Delete'){
        unset($_SESSION['items'][$id]);
        $_SESSION['items'] = array_values(array_filter($_SESSION['items']));
    }
    elseif($links == 'Update'){
        if($adultq == 0 && $childq == 0 && $studentq == 0 && $seniorq == 0){
            unset($_SESSION['items'][$id]);
            $_SESSION['items'] = array_values(array_filter($_SESSION['items']));
        }
        else{
            $_SESSION['items'][$id]['adultq'] = $adultq;
            $_SESSION['items'][$id]['childq'] = $childq;
            $_SESSION['items'][$id]['studentq'] = $studentq;
            $_SESSION['items'][$id]['seniorq'] = $seniorq; 
            
            $adultPrice = $_SESSION['items'][$id]['adultPrice'];
            $childPrice = $_SESSION['items'][$id]['childPrice'];
            $studentPrice = $_SESSION['items'][$id]['studentPrice'];
            $seniorPrice = $_SESSION['items'][$id]['seniorPrice'];
            $total = ($adultq * $adultPrice) + ($childq * $childPrice) + ($studentq * $studentPrice) + ($seniorq * $seniorPrice);
            $_SESSION['items'][$id]['total'] = $total;  

        }
    }
}   

header("Location: shoppingCart.php"); 
?>