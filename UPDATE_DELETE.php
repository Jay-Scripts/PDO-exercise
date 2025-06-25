<?php
require_once "./includes/DB_conn.inc.php";

// assoc. array for msg in the input fields
$msg = ['notif' => ""];
$search = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $search = $_POST['search'];

    $stmt = $pdo->prepare("UPDATE users SET name = :search where id = 1");
    $stmt->bindParam(':search', $search);

    $stmt->execute(); // execute the data input
    $msg['notif'] = "<p class='bg-green-300 w-full rounded-2xl p-3 text-center'>Sucess!</p>";
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
    <h1 class="text-center text-4xl m-4">Search & Update</h1>
    <form action="UPDATE_DELETE.php" method="post"
        class="border-2 border-black p-5 flex justify-center items-center rounded-2xl bg-white">

        <label for="search">Search :</label>
        <input type="text" name="search" id="search" class="border-2 border-black"
            value="<?php echo htmlspecialchars($search); ?>"><br>


        <button name="submit"
            class="border-2 border-black p-3 rounded-2xl bg-green-600 text-white hover:bg-green-400 active:bg-green-200 ease-in-out m-2">
            Submit
        </button>
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