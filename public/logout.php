 <?php
session_start();

$return = isset($_GET['return']) ? $_GET['return'] : "index.php";

if(session_destroy()) // Destroying All Sessions
{
    header("Location: $return"); // Redirecting To Home Page
}
?>
