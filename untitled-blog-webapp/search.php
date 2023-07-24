<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="Logo.png" type="image/png">
<title>Search</title>
</head>
<body>
<div class="container">

<br>
<?php
include "design.php";
include "navbar.php";
?> 
<br><br>

<form method="POST" action="">
  <input type="text" name="search" placeholder="Search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : (isset($_GET['search']) ? $_GET['search'] : ''); ?>">
  <input type="submit" value="Search">
</form>

<br>

<?php
include "DBConnection.php"; // include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the search query from the form input
  $search = $_POST['search'];

  // Prepare the SQL query with a placeholder for the search term
//   $sql = "SELECT * FROM blog WHERE title LIKE '%$search%'";
  $sql = "SELECT * FROM blog WHERE title LIKE '%$search%' OR para1 LIKE '%$search%' OR para2 LIKE '%$search%' OR para3 LIKE '%$search%' OR para4 LIKE '%$search%' OR author LIKE '%$search%' OR tag1 LIKE '%$search%' OR tag2 LIKE '%$search%' OR tag3 LIKE '%$search%' OR tag4 LIKE '%$search%' OR tag5 LIKE '%$search%'";


  // Execute the query
  $result = mysqli_query($conn, $sql);

  // Check if any rows are returned
  if (mysqli_num_rows($result) > 0) {
    // echo "<h2><b>Search Results</b></h2>";
    echo '<table style="border-collapse: collapse;">'; // Start the table and set the CSS style for invisible borders

    // Fetch and display each row as a table row
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
          
      // Display pic1
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
    echo "<p>No matches found.</p>";
  }
}
?>


</div>
</body>
</html>