<?php
       
// Start the session
session_start();

// unset($_SESSION['items']);

include '../include/Connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";
$adultq = isset($_GET['adult']) ? $_GET['adult'] : "0";
$childq = isset($_GET['child']) ? $_GET['child'] : "0";
$studentq = isset($_GET['student']) ? $_GET['student'] : "0";
$seniorq = isset($_GET['senior']) ? $_GET['senior'] : "0";


if($adultq == 0 && $childq == 0 && $studentq == 0 && $seniorq == 0){
    header("Location: index.php"); 
}
else{
if($id != ""){
        // 2. Perform database query
    $query  =  "select a.attract_id,a.attract_name, ci.city_name, ";
    $query .=  "co.country_name, a.attract_adult_price, a.attract_child_price, ";
    $query .=  "a.attract_student_price, a.attract_senior_price ";
    $query .=  "from attractions a join city ci ";
    $query .=  "on (a.city_id_fk = ci.city_id) ";
    $query .=  "join country co ";
    $query .=  "on (ci.country_id_fk = co.country_id) ";
    $query .=  "where attract_id = '$id'";

    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
        die("Database query failed.");
        // Redirecting To Login
        header("Location: Login.php?login=false"); 
    }

    if(!isset($_SESSION['items'])){
            $_SESSION['items'] = array();
    }

     $row = mysqli_fetch_assoc($result);

    $adultPrice = $row['attract_adult_price'];
    $childPrice = $row['attract_child_price'];
    $studentPrice = $row['attract_student_price'];
    $seniorPrice = $row['attract_senior_price'];  
    $total = ($adultq * $adultPrice) + ($childq * $childPrice) + ($studentq * $studentPrice) + ($seniorq * $seniorPrice);

    $_SESSION['items'][count($_SESSION['items'])]=array('attract_id' => $row['attract_id'], 'attract_name' => $row['attract_name'], 'city_name' => $row['city_name'],  'country_name' => $row['country_name'], 'total' => $total, 'adultq' => $adultq, 'childq' => $childq, 'studentq' => $studentq, 'seniorq' => $seniorq, 'adultPrice' => $adultPrice, 'childPrice' => $childPrice, 'studentPrice' => $studentPrice, 'seniorPrice' => $seniorPrice);

    // 4. Release returned data
    mysqli_free_result($result);
    // 5. Close database connection
    mysqli_close($connection);

    header("Location: shoppingCart.php"); 
}
else{
       header("Location: index.php"); 
}
}
