<?php
require "./includes/DB_conn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="flex flex-col justify-center items-center h-screen bg-gray-900">
    <form action="./includes/formhandling.inc.php" class="border-2 border-black p-5 flex flex-col justify-center items-center rounded-2xl bg-white " method="post">
        <label for="name">Name :</label> <br>
        <input type="text" name="name" id="name" class="border-2 border-black"><br>
        <label for="email">Email :</label> <br>
        <input type="email" id="email" name="email" class="border-2 border-black"> <br>
        <label for="age">Age :</label><br>
        <input type="number" id="age" name="age" class="border-2 border-black">
        <button name="submit" class="border-2 border-black p-3 rounded-2xl bg-green-600 text-white hover:bg-green-400 active:bg-green-200 ease-in-out m-2">Submit</button>

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
        }, 500); // check every .5 seconds
    </script>
</body>


</html>