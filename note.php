<?php

include 'connect.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pdf'])) {
        $note = $_GET['n'];
        $pd = $_POST['pdf'];

        $note = mysqli_real_escape_string($conn, $note);
        $pd = mysqli_real_escape_string($conn, $pd);

        $book_sql = "UPDATE `chapter` SET `link`='$pd' WHERE `cid`='$note'";
        $book_res = $conn->query($book_sql);

        if ($book_res) {
            echo "PDF link updated successfully!";
        } else {
            echo "Error updating PDF link: " . mysqli_error($conn);
        }
    } else {
        echo "PDF field is missing in the form submission.";
    }
}
?>

<div class="video-menu" style="height: 70px;">
 <ul>
 <a href="teacher_dashboard.php"><li> Classes
  </li></a>
  <a href="my_upload.php"><li>
    My Uploads
  </li></a>
  <a href="my-notes.php"><li style="background: #555";>
   Add Notes
  </li></a>
  <a href="add_topic.php"><li>
    Add Topic
  </li></a></ul>

</div>
<div class="login-form">
<form action="" method="POST" enctype="multipart/form-data">
    Insert PDF Drive Link -->
	<input type="text" name="pdf" multiple/>
	<input type="submit"/><br>
    <!-- Click Here to Upload DOCUMENT
    <input type="file" name="files[]" multiple/>
    <input type="submit"/><br>  
    Click Here to Upload TextFile
    <input type="file" name="files[]" multiple/>
    <input type="submit"/> -->
    </form>
</div>

