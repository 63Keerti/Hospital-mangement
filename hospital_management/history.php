<?php
include 'db.php';

// Add new record
if(isset($_POST['add_record'])){
    $pid = $_POST['patient_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $sql = "INSERT INTO medical_history (patient_id,diagnosis,treatment) VALUES ($pid,'$diagnosis','$treatment')";
    mysqli_query($conn,$sql);
}

// Fetch patients
$patients = mysqli_query($conn,"SELECT id,name FROM patients");
?>
<!DOCTYPE html>
<html>
<head><title>Patient History</title></head>
<body>
<h2>Patient Medical Records</h2>

<h3>Add Record</h3>
<form method="post">
    Patient: <select name="patient_id">
        <?php while($p=mysqli_fetch_assoc($patients)){ echo "<option value='{$p['id']}'>{$p['name']}</option>"; } ?>
    </select><br>
    Diagnosis: <input type="text" name="diagnosis" required><br>
    Treatment: <input type="text" name="treatment" required><br>
    <button type="submit" name="add_record">Add Record</button>
</form>

<h3>All Records</h3>
<table border="1" cellpadding="5">
<tr><th>Patient</th><th>Diagnosis</th><th>Treatment</th><th>Date</th></tr>
<?php
$records = mysqli_query($conn,"SELECT mh.*,p.name as pname FROM medical_history mh JOIN patients p ON mh.patient_id=p.id ORDER BY mh.created_at DESC");
while($r=mysqli_fetch_assoc($records)){
    echo "<tr><td>{$r['pname']}</td><td>{$r['diagnosis']}</td><td>{$r['treatment']}</td><td>{$r['created_at']}</td></tr>";
}
?>
</table>
</body>
</html>
