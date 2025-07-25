<?php
include('../dbconnection.php');
if (isset($_POST['submit'])) {
    $eid = isset($_GET['editid']) ? intval($_GET['editid']) : 0;
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $contno = $_POST['contactno'] ?? '';
    $email = $_POST['email'] ?? '';
    $add = $_POST['address'] ?? '';

    $stmt = $con->prepare("UPDATE tblusers SET FirstName=?, LastName=?, MobileNumber=?, Email=?, Address=? WHERE ID=?");
    $stmt->bind_param("sssssi", $fname, $lname, $contno, $email, $add, $eid);
    if ($stmt->execute()) {
        echo "<script>alert('You have successfully updated the data');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Edit User</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
 color: #fff;
 background: #63738a;
 font-family: 'Roboto', sans-serif;
}
.form-control {
 height: 40px;
 box-shadow: none;
 color: #969fa4;
}
.form-control:focus {
 border-color: #5cb85c;
}
.form-control, .btn { 
 border-radius: 3px;
}
.signup-form {
 width: 450px;
 margin: 0 auto;
 padding: 30px 0;
 font-size: 15px;
}
.signup-form h2 {
 color: #636363;
 margin: 0 0 15px;
 position: relative;
 text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
 content: "";
 height: 2px;
 width: 30%;
 background: #d4d4d4;
 position: absolute;
 top: 50%;
 z-index: 2;
} 
.signup-form h2:before {
 left: 0;
}
.signup-form h2:after {
 right: 0;
}
.signup-form .hint-text {
 color: #999;
 margin-bottom: 30px;
 text-align: center;
}
.signup-form form {
 color: #999;
 border-radius: 3px;
 margin-bottom: 15px;
 background: #f2f3f7;
 box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
 padding: 30px;
}
.signup-form .form-group {
 margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
 margin-top: 3px;
}
.signup-form .btn { 
 font-size: 16px;
 font-weight: bold; 
 min-width: 140px;
 outline: none !important;
}
.signup-form .row div:first-child {
 padding-right: 10px;
}
.signup-form .row div:last-child {
 padding-left: 10px;
} 
.signup-form a {
 color: #fff;
 text-decoration: underline;
}
.signup-form a:hover {
 text-decoration: none;
}
.signup-form form a {
 color: #5cb85c;
 text-decoration: none;
} 
.signup-form form a:hover {
 text-decoration: underline;
} 
</style>
</head>
<body>
<div class="signup-form">
 <form method="POST">
<?php
$eid = isset($_GET['editid']) ? intval($_GET['editid']) : 0;
$ret = $con->prepare("SELECT * FROM tblusers WHERE ID=?");
$ret->bind_param("i", $eid);
$ret->execute();
$result = $ret->get_result();
if ($row = $result->fetch_assoc()) {
?>
 <h2>Update</h2>
 <p class="hint-text">Update your info.</p>
 <div class="form-group">
 <div class="row">
 <div class="col"><input type="text" class="form-control" name="fname" value="<?php echo htmlspecialchars($row['FirstName']); ?>" required="true"></div>
 <div class="col"><input type="text" class="form-control" name="lname" value="<?php echo htmlspecialchars($row['LastName']); ?>" required="true"></div>
 </div> 
 </div>
 <div class="form-group">
 <input type="text" class="form-control" name="contactno" value="<?php echo htmlspecialchars($row['MobileNumber']); ?>" required="true" maxlength="10" pattern="[0-9]+">
 </div>
 <div class="form-group">
 <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required="true">
 </div>
 <div class="form-group">
 <textarea class="form-control" name="address" required="true"><?php echo htmlspecialchars($row['Address']); ?></textarea>
 </div> 
<?php
} else {
    echo "<p>User not found.</p>";
}
$ret->close();
?>
 <div class="form-group">
 <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
 </div>
 </form>
</div>
</body>
</html>
