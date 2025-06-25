<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $messages = [
        'name' => "",
        'email' => "",
        'age' => ""
    ]; // assoc. arrays for input validations 


    $name = $email = $age = ""; // set the variables as empty stings to avoid errors when calling in the value attribute
    $name = $_POST['name'];
    $email = $_POST['email;'];
    $age = $_POST['age'];


    // input validations


    // for name
    if (empty($name)) {
        $messages['name'] = "Please Input a Name!";
    } else if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $messages['name'] = "Name must contain only letters!";
    }

    // for email
    if (empty($email)) {
        $messages['email'] = "Please Input a Name!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages['email'] = "Please enter a valid email address!";
    }

    // for age
    if (empty($age)) {
        $messages['age'] = "Please Input a Name!";
    } else if (!preg_match("/^[0-9]+$/", $age)) {
        $messages['age'] = "age must contain only numbers!";
    }
}
