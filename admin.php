<?php
// Database configuration
$host = 'localhost';
$dbName = 'economics';
$username = 'root';
$password = '';

// Connect to the database
try {
    $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Check if the request is confirmed
if (isset($_POST['confirm_request'])) {
    $requestId = $_POST['request_uid'];

    // Get the request data
    $query = "SELECT * FROM request WHERE uid = :request_uid";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':request_uid', $requestId);
    $stmt->execute();
    $requestData = $stmt->fetch(PDO::FETCH_ASSOC);
    $n=0;
    $query= "UPDATE `request` SET `status`=$n WHERE uid = :request_uid";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':request_uid', $requestId);
    $stmt->execute();

    try {
        $query = "INSERT INTO user (uid,name,email, password,status) VALUES ($requestId, :name, :email, :password,$n)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $requestData['name']);
        $stmt->bindParam(':email', $requestData['email']);
        $stmt->bindParam(':password', $requestData['password']);
        $stmt->execute();
        
        echo '<script>alert("Data inserted successfully!");</script>';
    } catch (PDOException $e) {
        
        //echo "An error occurred: " . $e->getMessage();
        echo '<script>alert("Already Confirm Data");</script>';
    }
    // Add the request data to the user table
    
}

// Retrieve all data from the request table
$query = "SELECT * FROM request";
$stmt = $db->prepare($query);
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Requests</h3>
    <div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
    <table border = 1 cellspacing = 0 cellpadding = 10 class="table table-bordered table-stripped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Password</th>
            <th>Amount</th>
            <th>Slip</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($requests as $request): ?>
        <tr>
            <td><?php echo $request['uid']; ?></td>
            <td><?php echo $request['name']; ?></td>
            <td><?php echo $request['phone']; ?></td>
            <td><?php echo $request['gender']; ?></td>
            <td><?php echo $request['email']; ?></td>
            <td><?php echo $request['password']; ?></td>
            <td><?php echo $request['amount']; ?></td>
            <td> <img src="img/<?php echo $request["image"]; ?>" width = 200 title="<?php echo $request['image']; ?>"> </td>
            <td class="text-center">
                                <?php if($request['status'] == 1): ?>
                                    <span class="badge badge-danger">Not Access</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Access</span>
                                <?php endif; ?>
                            </td>
            <td>
                <form method="POST" action="admin.php">
                    <input type="hidden" name="request_uid" value="<?php echo $request['uid']; ?>">
                    <button type="submit" name="confirm_request" class="btn btn-primary" id="confirm">Confirm</button>
                    
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>
</div>
</div>
</div>
<div class="modal-body">
<div class="modal-body">
    <?php
    include 'connect.php';
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_request'])) {
        $all_ok = 1;
        $msg = "";

        $name = $_POST['name'];
        $num = $_POST['num'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $all_ok = 0;
            $msg = "INVALID EMAIL.";
        }

        if (!(strlen($num) == 10)) {
            $all_ok = 0;
            $msg = "INVALID MOBILE NUMBER.";
        }

        if ($all_ok == 1) {
            $insert = "INSERT INTO teacher (name, phone,temail, password) VALUES ('$name', '$num', '$email', '$pass')";
            if ($conn->query($insert) === true) {
                ?>
                <script>
                    alert("Teacher Added");
                    window.location.assign("admin.php");
                </script>
                <?php
            } else {
                echo $conn->error;
                ?>
                <script>
                    alert("You have already submitted a request.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("<?php echo $msg; ?>");
            </script>
            <?php
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_login'])) {
        // Handle login form submission if needed
    }
    
    ?>
<div><h2>Add Teachers </h2></div>
    <div class="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"><br><br>
            <input type="text" placeholder="Name: [A-Z]" name="name" autocomplete="off" required="yes" pattern="[A-Za-z\\s]*" /><br><br>
            <input type="number" placeholder="10 digit mobile number" name="num" autocomplete="off" required="yes" /><br><br>
            <div>
                <select name="select"> 
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div><br>
            <input type="email" placeholder="E-Mail" name="email" autocomplete="off" required="yes" /><br><br>
            <input type="password" placeholder="Password" name="pass" autocomplete="off" required="yes" /><br><br>
        
            <div class="modal-footer">
                <button type="submit" name="submit_request" class="btn btn-primary">Add Teacher</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    
?>
