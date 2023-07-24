<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="Logo.png" type="image/png">
<title>Post</title>
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

// Retrieve the title from the query parameter
$title = $_GET['title'];

// Fetch the blog data based on the title
$query = "SELECT * FROM blog WHERE title = '$title'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Display the title in <h1> tags
    echo '<h1>' . $row['title'] . '</h1>';

    // Display date without time
    $dateAdded = $row['date_added']; // Assuming $row contains the fetched row from the database

    // Format the date without the time of day
    $date = date('Y-m-d', strtotime($dateAdded));


    echo '<table style="border-collapse: collapse;">';
    echo '<tr>';
    echo '<td style="border: none;"><b>Author:</b></td>';
    echo '<td style="border: none;">' . $row['author'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td style="border: none;"><b>Date:</b></td>';
    echo '<td style="border: none;">' . $date . '</td>';
    echo '</tr>';
    echo '</table>';

    echo '<br><br>';
    // Display pic1
    $pic1Path = $row['pic1'];
    if (file_exists($pic1Path)) {
        echo '<img src="' . $pic1Path . '" alt="Preview Photo">';
    }

    echo '<div style="margin: 0 auto; width: 50%;">';
    echo '<p>' . $row['para1'] . '</p>';
    echo '</div>';
    // Display pic2
    $pic2Path = $row['pic2'];
    if (file_exists($pic2Path)) {
        echo '<img src="' . $pic2Path . '" alt="Photo 1">';
    }

    echo '<div style="margin: 0 auto; width: 50%;">';
    echo '<p>' . $row['para2'] . '</p>';
    echo '</div>';

    // Display pic3
    $pic3Path = $row['pic3'];
    if (file_exists($pic3Path)) {
        echo '<img src="' . $pic3Path . '" alt="Photo 2">';
    }

    echo '<div style="margin: 0 auto; width: 50%;">';
    echo '<p>' . $row['para3'] . '</p>';
    echo '</div>';

    // Display pic4
    $pic4Path = $row['pic4'];
    if (file_exists($pic4Path)) {
        echo '<img src="' . $pic4Path . '" alt="Photo 3">';
    }

    echo '<div style="margin: 0 auto; width: 50%;">';
    echo '<p>' . $row['para4'] . '</p>';
    echo '</div>';

    
    // echo '<br><br><br><br><p><b>Tags: </b>' . $row['tag1'] . ', ' . $row['tag2'] . ', ' . $row['tag3'] . ', ' . $row['tag4'] . ', ' . $row['tag5'] . '</p>';
    
    echo '<br><br><br><br><p><b>Tags: </b>';
    echo '<a href="search.php?search=' . urlencode($row['tag1']) . '">' . $row['tag1'] . '</a>, ';
    echo '<a href="search.php?search=' . urlencode($row['tag2']) . '">' . $row['tag2'] . '</a>, ';
    echo '<a href="search.php?search=' . urlencode($row['tag3']) . '">' . $row['tag3'] . '</a>, ';
    echo '<a href="search.php?search=' . urlencode($row['tag4']) . '">' . $row['tag4'] . '</a>, ';
    echo '<a href="search.php?search=' . urlencode($row['tag5']) . '">' . $row['tag5'] . '</a>';
    echo '</p>';

    } else {
    echo 'Blog not found.';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>



</div>
</body>
</html>