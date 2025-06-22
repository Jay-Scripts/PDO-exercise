<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Error - Something Went Wrong</title>
  <style>
    body {
      background: #f8d7da;
      color: #721c24;
      font-family: Arial, sans-serif;
      text-align: center;
      padding-top: 10%;
    }

    .error-container {
      background: #fff;
      border: 1px solid #f5c6cb;
      border-radius: 8px;
      display: inline-block;
      padding: 40px 60px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    h1 {
      font-size: 2.5em;
      margin-bottom: 0.5em;
    }

    p {
      font-size: 1.2em;
      margin-bottom: 1.5em;
    }

    a {
      color: #721c24;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="error-container">
    <h1>Oops! An Error Occurred</h1>
    <p>Sorry, something went wrong. Please try again later.</p>
    <a href="/index.php">Go back to Home</a>
  </div>
  <script>
    setInterval(() => {
      fetch("DB_conn.inc.php") // assumes check_db.php is in same folder
        .then(res => res.text())
        .then(data => {
          if (data === "OK") {
            window.location.href = "../index.php"; // go back to main page
          }
        });
    }, 500); // check every .5 seconds
  </script>


</body>

</html>