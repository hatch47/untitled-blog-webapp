<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="Logo.png" type="image/png">
<title>Home</title>
</head>
<body>
<div class="container">

<br>
<?php
include "design.php";
include "navbar.php";
?> 

<br>
<?php
include "DBConnection.php"; // include the database connection file

$query = "SELECT pic1, title FROM blog ORDER BY date_added desc";
$result = mysqli_query($conn, $query);

if ($result) {
    // Start the table and set the CSS style for invisible borders
    echo '<table style="border-collapse: collapse;">';

    // Fetch and display each row as a table row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        
        // Display pic1
        // $pic1Path = 'uploads/pic1.jpg';
        $pic1Path = $row['pic1'];
        if (file_exists($pic1Path)) {
            echo '<td style="border: none; padding: 1px;"><a href="post.php?title=' . urlencode($row['title']) . '" style="text-decoration: none; color: black;">';
            echo '<img src="' . $pic1Path . '" alt="Preview Photo" style="width: 150px; height: 150px;">';
            echo '</a></td>';
        }
        
        echo '<td style="border: none; padding: 1px;"><a href="post.php?title=' . urlencode($row['title']) . '" style="text-decoration: none; color: black;"><h1>' . $row['title'] . '</h1></a></td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>



</div>
</body>
</html>