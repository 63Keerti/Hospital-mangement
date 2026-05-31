<?php
session_start();
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB failed: ".mysqli_connect_error()); }

// Sample daily patient report
$today = date('Y-m-d');
$patients_today = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM patients WHERE DATE(registered_at)='$today'"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Reports & Analytics</title>
<style>
body{font-family:sans-serif;padding:2rem;}
table{width:50%;border-collapse:collapse;margin-top:1rem;}
th,td{border:1px solid #ccc;padding:0.5rem;text-align:center;}
th{background:#1e90ff;color:white;}
</style>
</head>
<body>
<h2>Reports & Analytics</h2>
<h3>Today's Patients: <?php echo $patients_today['total']; ?></h3>
<!-- Additional charts / reports can be added using Chart.js or similar -->
</body>
</html>
