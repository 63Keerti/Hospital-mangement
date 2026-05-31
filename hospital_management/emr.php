<?php
session_start();
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB failed: ".mysqli_connect_error()); }

if(isset($_POST['add_record'])){
    $patient = $_POST['patient_name'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];
    mysqli_query($conn,"INSERT INTO emr (patient_name,diagnosis,prescription) VALUES ('$patient','$diagnosis','$prescription')");
    $msg = "EMR record added!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>EMR Management</title>
<style>
body{font-family:sans-serif;padding:2rem;}
input,textarea,button{padding:0.5rem;margin:0.5rem 0;width:100%;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ccc;padding:0.5rem;text-align:center;}
th{background:#1e90ff;color:white;}
.msg{color:green;}
</style>
</head>
<body>
<h2>Electronic Medical Records</h2>
<?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="patient_name" placeholder="Patient Name" required>
<textarea name="diagnosis" placeholder="Diagnosis" required></textarea>
<textarea name="prescription" placeholder="Prescription" required></textarea>
<button type="submit" name="add_record">Add Record</button>
</form>

<h3>All Records</h3>
<table>
<tr><th>#</th><th>Patient</th><th>Diagnosis</th><th>Prescription</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM emr ORDER BY id DESC");
$i=1;
while($row=mysqli_fetch_assoc($res)){
    echo "<tr><td>$i</td><td>{$row['patient_name']}</td><td>{$row['diagnosis']}</td><td>{$row['prescription']}</td></tr>";
    $i++;
}
?>
</table>
</body>
</html>
