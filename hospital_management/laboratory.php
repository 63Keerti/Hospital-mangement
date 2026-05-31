<?php
// laboratory.php
session_start();
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB failed: ".mysqli_connect_error()); }

// Add test request
if(isset($_POST['add_test'])){
    $patient_name = $_POST['patient_name'];
    $test_name    = $_POST['test_name'];
    mysqli_query($conn,"INSERT INTO lab_tests (patient_name,test_name,status) VALUES ('$patient_name','$test_name','Pending')");
    $msg = "Test requested!";
}

// Update result (simplified)
if(isset($_POST['update_result'])){
    $id = $_POST['test_id'];
    $result = $_POST['result'];
    mysqli_query($conn,"UPDATE lab_tests SET status='Completed', result='$result' WHERE id='$id'");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Laboratory Management</title>
<style>
body{font-family:sans-serif;padding:2rem;}
input,button,textarea{padding:0.5rem;margin:0.5rem 0;width:100%;}
table{width:100%;border-collapse:collapse;margin-top:1rem;}
th,td{border:1px solid #ccc;padding:0.5rem;text-align:center;}
th{background:#1e90ff;color:white;}
.msg{color:green;}
</style>
</head>
<body>
<h2>Laboratory Test Requests</h2>
<?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="patient_name" placeholder="Patient Name" required>
<input type="text" name="test_name" placeholder="Test Name" required>
<button type="submit" name="add_test">Request Test</button>
</form>

<h3>All Tests</h3>
<table>
<tr><th>#</th><th>Patient</th><th>Test</th><th>Status</th><th>Result</th><th>Update Result</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM lab_tests ORDER BY id DESC");
$i=1;
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>$i</td>
    <td>{$row['patient_name']}</td>
    <td>{$row['test_name']}</td>
    <td>{$row['status']}</td>
    <td>{$row['result']}</td>
    <td>
    <form method='POST'>
    <input type='hidden' name='test_id' value='{$row['id']}'>
    <input type='text' name='result' placeholder='Enter result'>
    <button type='submit' name='update_result'>Update</button>
    </form>
    </td>
    </tr>";
    $i++;
}
?>
</table>
</body>
</html>
