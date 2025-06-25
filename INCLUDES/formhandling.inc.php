<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // initialized the  variable to avoid errors when called in value attribute
    require "DB_conn.inc.php";

    $name = $email = $age = "";
    // assoc. array for msg in the input fields
    $msg = ['name' => "", 'email' => "", 'age' => ""];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age =  $_POST['age'];

    // sanitizing user input before sending in value attribute
    $sanitizedName = htmlspecialchars($name);
    $sanitizedEmail = htmlspecialchars($email);
    $sanitizedAge = htmlspecialchars($age);

    // validation for name input
    if (empty($name)) {
        $msg['name'] = "<p class='bg-red-300'>Please Enter a Name!</p>";
    } else if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $msg['name'] = "<p class='bg-'>Please enter a valid Name, Only letters and spaces allowed!</p>";
    } else {
        $msg['name'] = "<p class='bg-green-300'>Valid Name!!!</p>";
    }

    // email validation
    if (empty($email)) {
        $msg['email'] = "<p class='bg-red-300'>Please Enter a Email!</p>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg['email'] = "<p class='bg-red-300'>Please enter a valid Email address!</p>";
    } else {
        $msg['email'] = "<p class='bg-green-300'>Valid Email address!!!</p>";
    }

    // validation for age
    if (empty($age)) {
        $msg['age'] = "<p class='bg-red-300'>Please Enter Age!</p>";
    } else if (!preg_match("/^[0-9]+$/", $age)) {
        $msg['age'] = "<p class='bg-'>Please enter a valid Age, Only letters allowed!</p>";
    } else {
        $msg['age'] = "<p class='bg-green-300'>Valid Age!!</p>";
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, age)
    VALUES (:name, :email, :age); ");

    //binding paramerters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':age', $age);
    $stmt->execute();
}
