<?php
include 'db.php';
$doctors = mysqli_query($conn,"SELECT * FROM doctors");
$staffs = mysqli_query($conn,"SELECT * FROM staff");
$messages = mysqli_query($conn,"SELECT * FROM messages ORDER BY timestamp DESC");
$logs = mysqli_query($conn,"SELECT * FROM audit_logs ORDER BY timestamp DESC");
$payrolls = mysqli_query($conn,"SELECT * FROM payroll");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Combined Doctor & Staff Features</title>
    <style>
        body{font-family:Arial;margin:20px;}
        h2{color:#1e90ff;}
        table{width:100%;border-collapse:collapse;margin-bottom:30px;}
        th,td{border:1px solid #ccc;padding:8px;text-align:left;}
        th{background:#1e90ff;color:white;}
    </style>
</head>
<body>
<h2>Emergency On-Call List</h2>
<table>
<tr><th>Name</th><th>Role</th><th>Contact</th></tr>
<?php while($d=mysqli_fetch_assoc($doctors)){ ?>
<tr><td><?= $d['name'] ?></td><td>Doctor</td><td><?= $d['contact'] ?></td></tr>
<?php } ?>
<?php while($s=mysqli_fetch_assoc($staffs)){ ?>
<tr><td><?= $s['name'] ?></td><td><?= $s['role'] ?></td><td><?= $s['contact'] ?></td></tr>
<?php } ?>
</table>

<h2>Internal Messaging</h2>
<table>
<tr><th>Sender</th><th>Receiver</th><th>Message</th><th>Timestamp</th></tr>
<?php while($m=mysqli_fetch_assoc($messages)){ ?>
<tr>
<td><?= $m['role_sender'] ?> #<?= $m['sender_id'] ?></td>
<td><?= $m['role_receiver'] ?> #<?= $m['receiver_id'] ?></td>
<td><?= $m['message'] ?></td>
<td><?= $m['timestamp'] ?></td>
</tr>
<?php } ?>
</table>

<h2>Payroll Summary</h2>
<table>
<tr><th>Staff ID</th><th>Role</th><th>Working Hours</th><th>Overtime</th><th>Salary</th><th>Pay Date</th></tr>
<?php while($p=mysqli_fetch_assoc($payrolls)){ ?>
<tr>
<td><?= $p['staff_id'] ?></td><td><?= $p['role'] ?></td><td><?= $p['working_hours'] ?></td>
<td><?= $p['overtime_hours'] ?></td><td><?= $p['salary'] ?></td><td><?= $p['pay_date'] ?></td>
</tr>
<?php } ?>
</table>

<h2>Audit Logs</h2>
<table>
<tr><th>ID</th><th>User ID</th><th>Role</th><th>Action</th><th>Timestamp</th></tr>
<?php while($l=mysqli_fetch_assoc($logs)){ ?>
<tr>
<td><?= $l['id'] ?></td><td><?= $l['user_id'] ?></td><td><?= $l['role'] ?></td>
<td><?= $l['action'] ?></td><td><?= $l['timestamp'] ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
