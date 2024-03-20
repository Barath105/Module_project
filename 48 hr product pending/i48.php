<?php
session_start();
?>
<!DOCTYPE html>
<!-- saved from url=(0068)file:///C:/xampp/htdocs/PROJECT/48%20hr%20product%20pending/i48.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        nav .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #f7ce68;
        }

        .apply-form {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background: url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            background-color:#dcdffa;
        }

        .item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .item:hover {
            transform: scale(1.02);
        }
        button {
            width: 134px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        body{
            overflow-x: hidden;
        }
        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adjust this margin as needed */
        }

        .container {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line */
            justify-content: space-around;
            margin: 20px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="s48.css">
</head>
<body>
    <header style="position: relative;height: 28px;top: -8px;width: 1364px;left: -8px;">
        <nav>
            <div class="logo" style="position: relative;top: -9px;left: 8px">
                <i class="fas fa-home"></i> Pending Product
            </div>
            <ul>
                <li><a href="../36 hr home/i36.php" style="position: relative;top: -9px;left:16px;">Home</a></li>
            </ul>
        </nav>
    </header>
    <!-- button group -->
    <div class="button-group" style="position:relative;left:-4px;top:28px;">
        <a href="../47 hr product/i47.html">
            <button id="addBtn" style="width: 106px; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px; margin-right: 20px;" fdprocessedid="edr5qqp">Add</button>
        </a>
        <button id="pendingBtn" style="width: 106px; margin-right: 20px;" fdprocessedid="3ngugx">Pending</button>
        <a href="">
            <button id="historyBtn" style="width: 106px;" fdprocessedid="7nfh6h">History</button>
        </a>
    </div>

    <?php
$itemsPerPage = 10;

// Get the current page from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$conn = new mysqli("localhost", "root", "", "adminhr");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculate the offset based on the current page
$offset = ($current_page - 1) * $itemsPerPage;

$sql = "SELECT `product_id`, `client_name`, `client_contact`, `totalcost`, `advance_paid`, `amount_remaining` FROM `hrproduct` LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize entry number
    $entryNumber = $offset + 1;

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="item" style="position:relative;top:40px;">';
        echo "<h3>Product " . $entryNumber . "</h3>";
        echo "<p><strong>Product ID:</strong> " . $row["product_id"] . "</p>";
        echo "<p><strong>Client:</strong> " . $row["client_name"] . "</p>";
        echo "<p><strong>Contact:</strong> " . $row["client_contact"] . "</p>";
        echo "<p><strong>Total Amount:</strong> $" . $row["totalcost"] . "</p>";
        echo "<p><strong>Advanced Paid:</strong> $" . $row["advance_paid"] . "</p>";
        echo "<p><strong>Pending Amount:</strong> $" . $row["amount_remaining"] . "</p>";
        echo "<button type='submit' style='position: relative;left: 0px;top: 10px;'>View Status</button>";
        echo "</div>";

        // Increment entry number
        $entryNumber++;
    }

    // Pagination links
    $sql = "SELECT COUNT(*) AS total FROM `hrproduct`";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalItems = $row['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo '<div style="clear:both;"></div>';
    echo '<div style="text-align:center; margin-top: 20px;">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
    echo '</div>';
} else {
    echo "0 results";
}

$conn->close();
?>


<script>
    document.getElementById("addBtn").addEventListener("click", function () {
        updateButtonColors(this);
        // Your other actions for the "Apply" button here
    });
    
    document.getElementById("pendingBtn").addEventListener("click", function () {
        updateButtonColors(this);
        // Your other actions for the "Pending" button here
    });
    
    document.getElementById("historyBtn").addEventListener("click", function () {
        updateButtonColors(this);
        // Your other actions for the "History" button here
    });

    window.addEventListener("load", function () {
        var pendingBtn = document.getElementById("pendingBtn");
    pendingBtn.style.backgroundColor = "skyblue";
    });
    
    function updateButtonColors(clickedButton) {
        const buttons = document.querySelectorAll(".button-group button");
    
        buttons.forEach(function (button) {
            if (button === clickedButton) {
                button.style.backgroundColor = "skyblue"; // Change the background color of the clicked button to skyblue
            } else {
                button.style.backgroundColor = ""; // Reset the background color of other buttons to default
            }
        });
    }
</script>

</body>
</html>