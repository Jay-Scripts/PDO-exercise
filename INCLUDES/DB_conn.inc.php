<?php
// $servername = "localhost:3307";
// $databasename = "PDO";

$dsn = "mysql:host=localhost;port=3307;dbname=PDO"; // data source name
$username  = "root"; // db user 
$password = ""; // db password

try {
    $pdo = new PDO($dsn, $username, $password); // database object  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setting an attribute 
    echo "OK";
    // grabing the errors, if we get an error then we throw an error,
} catch (PDOException $e) // then this wll catch that error, run this of theres an error the var $e was the placeholder for the error message
{
    header("Location: ./includes/errorPage.php"); // redirect to error page in the same folder
    exit;
    echo "FAIL";
    // echo "<p class='text-white'>Connection Failed: " . $e->getMessage() . "</p>";  // if didn't connect to database then throw this exeptiion here

}
