<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<link rel="icon" href="Logo.png" type="image/png">
<title>Create</title>
</head>
<body>
  <div class="container">
    <?php
    include "design.php";
    include "navbar.php";
    ?>
    <br><br>
    <form method="post" enctype="multipart/form-data">
      <label for="author">Author:</label><br>
      <input type="text" id="author" name="author" required><br>
      <label for="title">Title:</label><br>
      <input type="text" id="title" name="title" required><br>

      <br><br>
      <label>Upload Preview Photo:</label><br>
      <input type="file" name="pic1"><br><br>

      <br><br>
      <label><b>Paragraph 1</b></label><br>
      <textarea name="para1" rows="8" cols="100" required></textarea>
      <br><br><br>
      <label>Upload Photo 1:</label><br>
      <input type="file" name="pic2"><br><br>

      <br><br>
      <label><b>Paragraph 2</b></label><br>
      <textarea name="para2" rows="8" cols="100"></textarea>
      <br><br><br>
      <label>Upload Photo 2:</label><br>
      <input type="file" name="pic3"><br><br>

      <br><br>
      <label><b>Paragraph 3</b></label><br>
      <textarea name="para3" rows="8" cols="100"></textarea>
      <br><br><br>
      <label>Upload Photo 3:</label><br>
      <input type="file" name="pic4"><br><br>

      <br><br>
      <label><b>Paragraph 4</b></label><br>
      <textarea name="para4" rows="8" cols="100"></textarea>
      <br>

      <br>
      <p>Add 5 tags</p>
      <label for="tag1">Tag 1:</label>
      <input type="text" id="tag1" name="tag1" required><br>
      <label for="tag2">Tag 2:</label>
      <input type="text" id="tag2" name="tag2" required><br>
      <label for="tag3">Tag 3:</label>
      <input type="text" id="tag3" name="tag3" required><br>
      <label for="tag4">Tag 4:</label>
      <input type="text" id="tag4" name="tag4" required><br>
      <label for="tag5">Tag 5:</label>
      <input type="text" id="tag5" name="tag5" required><br>
      <br><br>

      <!-- db default pass xxxxx -->
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password" required>
      <br><br>
      <input type="submit" value="Post">
    </form>

    <br>
    <?php
 include "DBConnection.php"; // include the database connection file

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Retrieve form data
     $author = $_POST["author"];
     $title = $_POST["title"];
     $para1 = $_POST["para1"];
     $para2 = $_POST["para2"];
     $para3 = $_POST["para3"];
     $para4 = $_POST["para4"];
     $pic1 = $_FILES["pic1"]["tmp_name"];
     $pic2 = $_FILES["pic2"]["tmp_name"];
     $pic3 = $_FILES["pic3"]["tmp_name"];
     $pic4 = $_FILES["pic4"]["tmp_name"];
     $tag1 = $_POST["tag1"];
     $tag2 = $_POST["tag2"];
     $tag3 = $_POST["tag3"];
     $tag4 = $_POST["tag4"];
     $tag5 = $_POST["tag5"];
     $password = $_POST["password"];

     // Check if the provided password matches the password in the database
     $accessQuery = "SELECT * FROM access WHERE blog_pass = '$password'";
     $accessResult = mysqli_query($conn, $accessQuery);

     // Generate unique file names for the uploaded pictures
     $pic1Destination = "uploads/pic1_" . uniqid() . ".jpg";
     $pic2Destination = "uploads/pic2_" . uniqid() . ".jpg";
     $pic3Destination = "uploads/pic3_" . uniqid() . ".jpg";
     $pic4Destination = "uploads/pic4_" . uniqid() . ".jpg";
 
     move_uploaded_file($pic1, $pic1Destination);
     move_uploaded_file($pic2, $pic2Destination);
     move_uploaded_file($pic3, $pic3Destination);
     move_uploaded_file($pic4, $pic4Destination);
 
     // Prepare and execute the SQL statement
     $sql = "INSERT INTO blog (author, title, para1, para2, para3, para4, pic1, pic2, pic3, pic4, tag1, tag2, tag3, tag4, tag5)
             VALUES ('$author', '$title', '$para1', '$para2', '$para3', '$para4', '$pic1Destination', '$pic2Destination', '$pic3Destination', '$pic4Destination', '$tag1', '$tag2', '$tag3', '$tag4', '$tag5')";
 
     if (mysqli_query($conn, $sql)) {
         echo "<script>alert('Posted Successfully');</script>";
     } else {
         echo "<script>alert('Error caused by one of the following: Content missing, Repeat Title, Incorrect size/length or Unsupported characters');</script>";
     }
 
     mysqli_close($conn); // close the database connection
 }
 
    ?>

  </div>
</body>

</html>



      
      