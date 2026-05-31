<?php
include 'db.php';

// Admission
if(isset($_POST['admit'])){
    $pid = $_POST['patient_id'];
    $room = $_POST['room_no'];
    $sql = "INSERT INTO adt (patient_id,action,room) VALUES ($pid,'admission','$room')";
    mysqli_query($conn,$sql);
}

// Discharge
if(isset($_POST['discharge'])){
    $pid = $_POST['patient_id'];
    $sql = "INSERT INTO adt (patient_id,action) VALUES ($pid,'discharge')";
    mysqli_query($conn,$sql);
}

// Transfer
if(isset($_POST['transfer'])){
    $pid = $_POST['patient_id'];
    $newroom = $_POST['new_room'];
    $sql = "INSERT INTO adt (patient_id,action,room) VALUES ($pid,'transfer','$newroom')";
    mysqli_query($conn,$sql);
}

// Fetch patients
$patients = mysqli_query($conn,"SELECT id,name FROM patients");
?>
<!DOCTYPE html>
<html>
<head><title>ADT Management</title></head>
<body>
<h2>Admission / Discharge / Transfer</h2>

<h3>Admit Patient</h3>
<form method="post">
    Patient: <select name="patient_id">
        <?php while($p=mysqli_fetch_assoc($patients)){ echo "<option value='{$p['id']}'>{$p['name']}</option>"; } ?>
    </select><br>
    Room No: <input type="text" name="room_no" required><br>
    <button type="submit" name="admit">Admit</button>
</form>

<h3>Discharge Patient</h3>
<form method="post">
    Patient: <select name="patient_id">
        <?php
        mysqli_data_seek($patients,0); // reset pointer
        while($p=mysqli_fetch_assoc($patients)){ echo "<option value='{$p['id']}'>{$p['name']}</option>"; }
        ?>
    </select><br>
    <button type="submit" name="discharge">Discharge</button>
</form>

<h3>Transfer Patient</h3>
<form method="post">
    Patient: <select name="patient_id">
        <?php
        mysqli_data_seek($patients,0);
        while($p=mysqli_fetch_assoc($patients)){ echo "<option value='{$p['id']}'>{$p['name']}</option>"; }
        ?>
    </select><br>
    New Room No: <input type="text" name="new_room" required><br>
    <button type="submit" name="transfer">Transfer</button>
</form>
</body>
</html>
