<?php
require_once("../include/functions.php");
include '../include/Header.php';
include '../include/Connection.php';
?>
<body id="home">
    <div class="combodiv">
        <fieldset>
            <legend>Quick Search</legend>
            <form action= "index.php" method = 'post'>
                <table class="comboTable">
                    <tr>
                        <th>Attract Type: </th>
                        <td>
                            <select name='type'>
                                <option value='theme_park' selected > Theam Park</option>
                                <option value='production' >Theatre</option>
                                <option value='sight_seeing' >Sight Seeing</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                      <th>Price: </th>
                        <td>
                            <select name='price'>
                                <option value='> -1'> All </option>
                                <option value='<11'> £0 - £10 </option>
                                <option value='BETWEEN 10 AND 21'>£11 - £20</option>
                                <option value='>20'>£21+</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                      <th>City: </th>
                        <td>
                            <select name='city'>
                                <?php
                                    //populate drop down with values from city table 
                                    $cityQuery = "SELECT city_id, city_name FROM city";

                                    $cityResult =  mysqli_query($connection, $cityQuery);

                                    $city = 'NULL';
                                    if(!$cityResult){
                                        die("Query Failed");

                                    }else{
                                        while ($row = mysqli_fetch_assoc($cityResult)) {
                                            $city = $row['city_id'];
                                            echo "<option value='" . $row['city_id'] . "'>" . $row['city_name'] . "</option>";
                                        }
                                        echo "</select>";

                                        mysqli_free_result($cityResult);
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Search" class="indexButtons"/>
                        </td>
                    </tr>          
                </table>
            </form>	
        </fieldset>
    </div>   


    <div class="combodiv">
        <fieldset>
            <legend>Super Search</legend>
            <label>Enter an attraction name, city or country into the search box.</label></br></br>
    <label>Entering part of a word will still work.</label></br></br></br>
                <form action="index.php" method="post">	
                    <h2>Search: <input type="text" name="search" class="searchBox" required></h2> 
                    <div class="buttonContainer">
                        
                        <input type="submit" value="Let's go..." class="indexButtons">
                    </div>
                </form>
        </fieldset>
    </div>

<!--QUICK SEARCH-->

<?php
	//if search button has been clicked
	if(isset($_POST['type'])){

	//get attraction type value from drop down, need to change fk when production
	if(isset($_POST['type'])){
		//set default fk value. This will be different if the production table is selected.
		$fk = "attract_id_fk";
		$table = $_POST['type'];

		//if prouction table then change fk name
		 if($_POST['type'] == 'production'){
			$fk = "attract_id_ck";
		 }
	}

	//get city value from drop down
	if(isset($_POST['city'])){
		$city = $_POST['city'];
	}

	//get price value from drop down
	if(isset($_POST['price'])){
		 $price = $_POST['price'];
	}

	//start the query
	$query = "SELECT attract_id, attract_name, description, attract_adult_price,
		 attract_student_price, attract_child_price, attract_senior_price FROM ";
	
	//add table value to query based on attraction type and join to attraction table using attraction_id pk and fk
	$query .= $table ." NATURAL JOIN attractions WHERE "
	. $fk . " = attract_id && attract_adult_price ";



	//need to find city from drop down. end of query
	$query .= $price ." && city_id_fk = '" .$city ."'";



	$result =  mysqli_query($connection, $query);
	
	if(!$result){
		die("Query Failed");

	}else{
		if(mysqli_num_rows($result) > 0){
		echo "<br/><table class='bookings'><tr><th>Name</th><th width=45%>Description</th><th>Adult Price</th>
		<th>Student Price</th><th>Child Price</th><th>Senior Price</th><th colspan=2>Add to Cart</th></tr>";
			while($attraction = mysqli_fetch_assoc($result)){
			$id = $attraction["attract_id"];
				$name = $attraction["attract_name"];
				$description = $attraction["description"];
				$attract_adult_price = $attraction["attract_adult_price"];
				$attract_student_price = $attraction["attract_student_price"];
				$attract_child_price = $attraction["attract_child_price"];
				$attract_senior_price = $attraction["attract_senior_price"];

				echo "<tr><td> $name </td> <td> $description </td> <td> $attract_adult_price </td>
				 <td> $attract_student_price </td> <td> $attract_child_price </td> <td> $attract_senior_price </td>
				 
                 <form action='addToCart.php' method='get'>
                 <td>
                    <label>Adult:<input type='text' name='adult' value='0' class='txtQuantity'></label> </br>
                   <label>Child:<input type='text' name='child' value='0' class='txtQuantity'></label> </br>
                   <label>Student:<input type='text' name='student' value='0' class='txtQuantity'></label> </br>
                   <label>Senior:<input type='text' name='senior' value='0' class='txtQuantity'></label> </br>
              
                 <input type='submit' value='Add' class='Buttons'/>
				<input type='hidden' name='id' value=$id class='signin'></td></form></tr>";


			}
	
		mysqli_free_result($result);
		echo "</table>";

		}
	}
}

?>

<!--SUPER SEARCH-->

<?php
 $search = isset($_POST['search']) ? $_POST['search'] : "";

$query  = "SELECT c.city_name, cn.country_name, a.attract_id, a.description, a.attract_name, a.attract_website, a.attract_adult_price, a.attract_child_price, a.attract_student_price, a.attract_senior_price from attractions a 
            LEFT outer JOIN theme_park t
            ON (a.attract_id = t.attract_id_fk)
            left outer JOIN sight_seeing s
            ON (a.attract_id = s.attract_id_fk)
             left outer JOIN city c 
            ON (a.city_id_fk = c.city_id)
            left outer JOIN country cn 
            ON (c.country_id_fk = cn.country_id)

            where a.attract_name like '%$search%' OR c.city_name like '%$search%' OR cn.country_name like '%$search%';";

	$result = mysqli_query($connection, $query);
	// Test if there was a query error
//	if (!$result) {
//		// header("Location: index.php?found=false");
//        $found = false;
//	}
//    else{
//        $found = true;
//    }

 $attract_name = null;
 $city_name = null;
 $country_name = null;
 $description = null;
 $attract_website =null;
 $attract_adult_price = null;
 $attract_child_price = null;
 $attract_student_price = null;
 $attract_senior_price =null;

if($search != ""){
    


//$result = $_SESSION["Results"];


 //$found = isset($_GET['found']) ? $_GET['found'] : "";
//echo $found;

 echo "<table class='bookings'>
 <tr> 
 <th>Name</th>
 <th >Description</th>
 <th>Website</th>
 <th>Adult Price</th>
 <th>Child Price</th>
 <th>Student Price</th>
 <th>Senior Price</th>
 <th colspan=2>Add to cart</th>
 </tr>";
//
//for($i=0;$i<count($_Session['Results']);$i++)
//{
   
while($row = mysqli_fetch_array($result))
    {
$attract_id =isset($row['attract_id'])? $row['attract_id'] : '';
$attract_name =isset($row['attract_name']) ? $row['attract_name'] : '';
$city_name = isset($row['city_name']) ? $row['city_name'] : '';
$country_name = isset($row['country_name']) ? $row['country_name'] : '';
$description = isset($row['description']) ? $row['description'] : '';
$attract_website = isset($row['attract_website']) ? $row['attract_website'] : '';$row['attract_website'];
$attract_adult_price = isset($row['attract_adult_price']) ? $row['attract_adult_price'] : '';
$attract_child_price = isset($row['attract_child_price']) ? $row['attract_child_price'] : '';;
$attract_student_price = isset($row['attract_student_price']) ? $row['attract_student_price'] : '';
$attract_senior_price = isset($row['attract_senior_price']) ? $row['attract_senior_price'] : '';
          
 echo "<tr> 
 <td width=10%>$attract_name</br>$city_name, $country_name</td>
 <td width=30%>$description</td>
 <td>$attract_website</td>
 <td>$attract_adult_price</td>
 <td>$attract_child_price</td>
 <td>$attract_student_price</td>
 <td>$attract_senior_price</td>
 <form action='addToCart.php' method='get'>
 <td>
   <label>Adult:<input type='text' name='adult' value='0' class='txtQuantity'></label> </br>
   <label>Child:<input type='text' name='child' value='0' class='txtQuantity'></label> </br>
   <label>Student:<input type='text' name='student' value='0' class='txtQuantity'></label> </br>
   <label>Senior:<input type='text' name='senior' value='0' class='txtQuantity'></label> </br>

<input type='submit' value='Add' class='Buttons'/>
<input type='hidden' name='id' value='$attract_id' class='signin'></td>
</form>
 </tr>";         

}
    echo "</table>"; 
}
?>  


</body>
</html>
