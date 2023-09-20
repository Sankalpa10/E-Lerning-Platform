<?php include 'header.php';
  include 'connect.php';
  $con=mysqli_connect('localhost','root','','economics') or die(mysqli_error($con));

  if (!isset($_COOKIE['email'])) {
    # code...
    ?>
    <script>
      alert("Not Logged in. Please log in first.");
      window.location.assign("login.php");
    </script>
    <?php
  }else {
    $email = $_COOKIE['email'];
    $user_sql = "select * from user where email = '$email'";
    $user_res = $conn->query($user_sql);
    if ($user_res->num_rows > 0) {
      # code...
      $user_row = $user_res->fetch_assoc();
    }else {
      ?>
      <script>
        alert("Not Logged in. Please log in first.");
        window.location.assign("log.php?out");
      </script>
      <?php
    }
  }

  if (isset($_GET['b'])) {
    # code...
    $b = $_GET['b'];
    if (!($user_row['status'] == $b || $user_row['status'] == 0)) {
      # code...
      ?>
      <script>
        alert("Not subscribed to this service. Please subscribe to access this section.");
        window.location.assign("dashboard.php");
      </script>
      <?php
    }

    if ($b == 1) {
      
      # code...
      ?>
      <div class="dashboard">
      <center>
        <h2>SFT</h2>
         <?php
      $micro = "select * from chapter where cat = $b";
      $result_micro = $conn->query($micro);
      while ($row_micro = $result_micro->fetch_assoc()) {
        ?>
          <a href="videos.php?ch=<?php echo $row_micro['cid']; ?>"><div style="background: #015ba1;" class="chapter"><?php echo $row_micro['name']; ?></div></a>
        <?php
      }
      ?>
      </center>
      <div class="clearfix"> </div>
      </div>
      <?php
    }elseif ($b == 2) {
      # code...
      ?>
      <div class="dashboard">
      <center>
        <h2>ET</h2>
      <?php
      $micro = "select * from chapter where cat = $b";
      $result_micro = $conn->query($micro);
      while ($row_micro = $result_micro->fetch_assoc()) {
        ?>
          <a href="videos.php?ch=<?php echo $row_micro['cid']; ?>"><div style="background: #015ba1;" class="chapter"><?php echo $row_micro['name']; ?></div></a>
        <?php
      }
      ?>
      </center>
      </div>
      <?php
    }
    elseif ($b == 3) {
      # code...
      ?>
      <div class="dashboard">
      <center>
        <h2>BST</h2>
      <?php
      $micro = "select * from chapter where cat = $b";
      $result_micro = $conn->query($micro);
      while ($row_micro = $result_micro->fetch_assoc()) {
        ?>
          <a href="videos.php?ch=<?php echo $row_micro['cid']; ?>"><div style="background: #015ba1;" class="chapter"><?php echo $row_micro['name']; ?></div></a>
        <?php
      }
      ?>
      </center>
      </div>
      <?php
    }
    elseif ($b == 4) {
      # code...
      ?>
      <div class="dashboard">
      <center>
        <h2>IT</h2>
      <?php
      $micro = "select * from chapter where cat = $b";
      $result_micro = $conn->query($micro);
      while ($row_micro = $result_micro->fetch_assoc()) {
        ?>
          <a href="videos.php?ch=<?php echo $row_micro['cid']; ?>"><div style="background: #015ba1;" class="chapter"><?php echo $row_micro['name']; ?></div></a>
        <?php
      }
      ?>
      </center>
      </div>
      <?php
    }else {
      ?>
      <script>
        alert("Sorry! Wrong Request");
        window.location.assign("dashboard.php");
      </script>
      <?php
    }
  }else {
    ?>
    <script>
      alert("Sorry! Wrong Request");
      window.location.assign("dashboard.php");
    </script>
    <?php
  }

include 'footer.php'; ?>
