<?php
require_once "./includes/DB_conn.inc.php";

// assoc. array for msg in the input fields
$msg = ['name' => "", 'email' => "", 'age' => "", 'notif' => ""];

// initialized the  variable to avoid errors when called in value attribute
$name = $email = $age = "";
$sanitizedName = $sanitizedEmail = $sanitizedAge = "";


$nameHasError = $emailHasError = $ageHasError = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age =  $_POST['age'];

    // sanitizing user input before sending in value attribute
    $sanitizedName = htmlspecialchars($name);
    $sanitizedEmail = htmlspecialchars($email);
    $sanitizedAge = htmlspecialchars($age);

    // validation for name input
    if (empty($name)) {
        $msg['name'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Please Enter a Name!</p>";
        $nameHasError = true;
    } else if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $msg['name'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Please enter a valid Name, Only letters and spaces allowed!</p>";
        $nameHasError = true;
    } else {
        $msg['name'] = "<p class='bg-green-300 w-full rounded-2xl p-3 text-center'>Valid Name!!!</p>";
        $nameHasError = false;
    }

    // email validation
    if (empty($email)) {
        $msg['email'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Please Enter a Email!</p>";
        $emailHasError = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg['email'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Please enter a valid Email address!</p>";
        $emailHasError = true;
    } else {
        $msg['email'] = "<p class='bg-green-300 w-full rounded-2xl p-3 text-center'>Valid Email address!!!</p>";
        $emailHasError = false;
    }

    // validation for age
    if (empty($age)) {
        $msg['age'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center '>Please Enter Age!</p>";
        $ageHasError = true;
    } else if (!preg_match("/^[0-9]+$/", $age)) {
        $msg['age'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Please enter a valid Age, Only letters allowed!</p>";
        $ageHasError = true;
    } else {
        $msg['age'] = "<p class='bg-green-300 w-full rounded-2xl p-3 text-center'>Valid Age!!</p>";
        $ageHasError = false;
    }

    // will not send the data if theres and errror in the input 
    // note do not input users data directly in the database use prepared statements

    if (!$nameHasError && !$emailHasError && !$ageHasError) {
        // using NOT NAMED PARAMETER
        // $query = "INSERT INTO users (name, email, age)
        // VALUES (?, ?, ?);";

        // $stmt = $pdo->prepare($query);
        // $stmt->execute([$name, $email, $age]);

        // using named parameters 
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age)
        VALUES (:name, :email, :age); "); // set a placeholder 

        // binding the user input data 
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        $msg['notif'] = "<p class='bg-green-300 w-full rounded-2xl p-3 text-center'>Sucess!</p>";

        $stmt->execute(); // execute the data input
    } else {
        // send a message if theres a problem in the user input
        $msg['notif'] = "<p class='bg-red-300 w-full rounded-2xl p-3 text-center'>Follow the instructions!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="flex flex-col justify-center items-center h-screen bg-gray-900">
    <form action="index.php" method="post"
        class="border-2 border-black p-5 w-[80vw] flex flex-col justify-center items-center rounded-2xl bg-white">

        <label for="name">Name :</label>
        <input type="text" name="name" id="name" class="border-2 border-black"
            value="<?php echo $sanitizedName; ?>"><br>
        <?php echo $msg['name']; ?>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" class="border-2 border-black"
            value="<?php echo $sanitizedEmail; ?>"><br>
        <?php echo $msg['email']; ?>

        <label for="age">Age :</label>
        <input type="number" name="age" id="age" class="border-2 border-black"
            value="<?php echo $sanitizedAge; ?>"><br>
        <?php echo $msg['age']; ?>

        <div class="btns flex justify-center items-centers">
            <button name="submit"
                class="border-2 border-black p-3 rounded-2xl bg-green-600 text-white hover:bg-green-400 active:bg-green-200 ease-in-out m-2">
                Submit
            </button>
            <a href="UPDATE_DELETE.PHP">
                <div name="U&D"
                    class="border-2 border-black p-3 rounded-2xl bg-green-600 text-white hover:bg-green-400 active:bg-green-200 ease-in-out m-2">
                    Update & Delete
                </div>
            </a>
        </div>
        <?php echo $msg['notif']; ?>

    </form>

    <script>
        setInterval(() => {
            fetch("./includes/DB_conn.inc.php")
                .then(res => res.text())
                .then(data => {
                    if (data !== "OK") {
                        window.location.href = "./includes/errorPage.php";
                    }
                });
        }, 500);
    </script>
</body>

</html>