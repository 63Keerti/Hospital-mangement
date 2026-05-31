<?php
session_start();
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB failed: ".mysqli_connect_error()); }

// Add bed or assign
if(isset($_POST['add_bed'])){
    $ward = $_POST['ward'];
    $bed_no = $_POST['bed_no'];
    $status = $_POST['status'];
    mysqli_query($conn,"INSERT INTO beds (ward,bed_no,status) VALUES ('$ward','$bed_no','$status')");
    $msg = "Bed added!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ward & Bed Management</title>
<style>
body{font-family:sans-serif;padding:2rem;}
input,select,button{padding:0.5rem;margin:0.5rem 0;}
table{width:100%;border-collapse:collapse;margin-top:1rem;}
th,td{border:1px solid #ccc;padding:0.5rem;text-align:center;}
th{background:#1e90ff;color:white;}
.msg{color:green;}
</style>
</head>
<body>
<h2>Ward & Bed Management</h2>
<?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="ward" placeholder="Ward Name" required>
<input type="text" name="bed_no" placeholder="Bed Number" required>
<select name="status">
<option value="Available">Available</option>
<option value="Occupied">Occupied</option>
</select>
<button type="submit" name="add_bed">Add Bed</button>
</form>

<h3>Current Beds</h3>
<table>
<tr><th>#</th><th>Ward</th><th>Bed No</th><th>Status</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM beds ORDER BY ward,bed_no");
$i=1;
while($row=mysqli_fetch_assoc($res)){
    echo "<tr><td>$i</td><td>{$row['ward']}</td><td>{$row['bed_no']}</td><td>{$row['status']}</td></tr>";
    $i++;
}
?>
</table>
</body>
</html>
