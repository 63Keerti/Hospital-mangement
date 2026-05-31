<?php
// billing.php
session_start();

// Database connection
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB connection failed: ".mysqli_connect_error()); }

// Handle bill generation form
if(isset($_POST['generate_bill'])){
    $patient_name = $_POST['patient_name'];
    $treatment    = $_POST['treatment'];
    $amount       = $_POST['amount'];
    $insurance    = $_POST['insurance'] ?? 'None';

    mysqli_query($conn,"INSERT INTO bills (patient_name,treatment,amount,insurance) 
                        VALUES ('$patient_name','$treatment','$amount','$insurance')");
    $msg = "Bill generated successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Billing & Invoicing</title>
<style>
body{font-family:sans-serif;padding:2rem;}
input, select, button{padding:0.5rem;margin:0.5rem 0;width:100%;}
.container{max-width:700px;margin:auto;}
table{width:100%;border-collapse:collapse;margin-top:1rem;}
table,th,td{border:1px solid #ccc;padding:0.5rem;text-align:center;}
th{background:#1e90ff;color:white;}
.msg{color:green;font-weight:bold;}
</style>
</head>
<body>
<div class="container">
<h2>Generate Bill</h2>
<?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="patient_name" placeholder="Patient Name" required>
<input type="text" name="treatment" placeholder="Treatment / Test / Medicine" required>
<input type="number" name="amount" placeholder="Amount" required>
<select name="insurance">
<option value="">Insurance (optional)</option>
<option value="HealthCare Inc">HealthCare Inc</option>
<option value="LifeCover">LifeCover</option>
</select>
<button type="submit" name="generate_bill">Generate Bill</button>
</form>

<h3>All Bills</h3>
<table>
<tr><th>#</th><th>Patient</th><th>Treatment</th><th>Amount</th><th>Insurance</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM bills ORDER BY id DESC");
$i=1;
while($row=mysqli_fetch_assoc($res)){
    echo "<tr><td>$i</td><td>{$row['patient_name']}</td><td>{$row['treatment']}</td><td>{$row['amount']}</td><td>{$row['insurance']}</td></tr>";
    $i++;
}
?>
</table>
</div>
</body>
</html>
