<?php
session_start();

// Initialize receipt session
if (!isset($_SESSION['receipt'])) {
    $_SESSION['receipt'] = [];
}

// Function to add items to the receipt
function addToReceipt($item, $price)
{
    $_SESSION['receipt'][] = [
        'item' => $item,
        'price' => $price
    ];
}

// Handle add item POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item']) && isset($_POST['price'])) {
        $item = $_POST['item'];
        $price = (float)$_POST['price'];
        addToReceipt($item, $price);
    }

    // Clear receipt
    if (isset($_POST['clear'])) {
        $_SESSION['receipt'] = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pure PHP POS Demo</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background: #f2f2f2;
        }

        .card {
            display: inline-block;
            padding: 15px 20px;
            margin: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            border: none;
            font-size: 18px;
        }

        .receipt {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .receipt h2 {
            margin-top: 0;
        }
    </style>
</head>

<body>

    <h1>🧋 Pure PHP POS</h1>
    <p>Click a product to add it to the receipt</p>

    <!-- Product Cards -->
    <form method="POST" style="display:inline;">
        <input type="hidden" name="item" value="Milk Tea">
        <input type="hidden" name="price" value="120">
        <button class="card" type="submit">🧋 Milk Tea - ₱120</button>
    </form>

    <form method="POST" style="display:inline;">
        <input type="hidden" name="item" value="Coffee">
        <input type="hidden" name="price" value="100">
        <button class="card" type="submit">☕ Coffee - ₱100</button>
    </form>

    <form method="POST" style="display:inline;">
        <input type="hidden" name="item" value="Cookie">
        <input type="hidden" name="price" value="50">
        <button class="card" type="submit">🍪 Cookie - ₱50</button>
    </form>

    <form method="POST" style="display:inline;">
        <input type="hidden" name="item" value="Fries">
        <input type="hidden" name="price" value="80">
        <button class="card" type="submit">🍟 Fries - ₱80</button>
    </form>

    <!-- Receipt Section -->
    <div class="receipt">
        <h2>🧾 Receipt</h2>
        <ul>
            <?php
            $total = 0;
            foreach ($_SESSION['receipt'] as $entry) {
                echo "<li>{$entry['item']} - ₱{$entry['price']}</li>";
                $total += $entry['price'];
            }
            ?>
        </ul>
        <hr>
        <strong>Total: ₱<?= $total ?></strong>

        <!-- Clear Button -->
        <form method="POST" style="margin-top: 20px;">
            <button class="card" name="clear" type="submit">❌ Clear Receipt</button>
        </form>
    </div>

</body>

</html>