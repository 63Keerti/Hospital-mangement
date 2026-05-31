<?php
include 'db.php';

// Handle adding a new doctor
if(isset($_POST['add_doctor'])){
    $name = $_POST['name'];
    $photo = $_POST['photo'];
    $qualifications = $_POST['qualifications'];
    $experience = $_POST['experience'];
    $specialization = $_POST['specialization'];
    $contact = $_POST['contact'];
    $department = $_POST['department'];
    $schedule = $_POST['schedule'];
    $slot = $_POST['slot'];
    $telemedicine = isset($_POST['telemedicine']) ? 1 : 0;

    $sql = "INSERT INTO doctors 
        (name, photo, qualifications, experience, specialization, contact, department_id, schedule, slot_duration, telemedicine)
        VALUES ('$name','$photo','$qualifications','$experience','$specialization','$contact','$department','$schedule','$slot','$telemedicine')";
    mysqli_query($conn,$sql);
}

// Fetch doctors and departments
$doctors = mysqli_query($conn,"SELECT d.*, dep.name AS department_name FROM doctors d LEFT JOIN departments dep ON d.department_id = dep.id");
$departments = mysqli_query($conn,"SELECT * FROM departments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
    <style>
        body{font-family:Arial;margin:20px;}
        table{border-collapse:collapse;width:100%;margin-top:20px;}
        th,td{padding:10px;border:1px solid #ccc;text-align:left;}
        th{background:#1e90ff;color:white;}
        form{padding:20px;border:1px solid #ddd;margin-bottom:20px;}
        input,select{width:100%;padding:8px;margin:5px 0;}
        button{padding:10px 20px;background:#1e90ff;color:white;border:none;border-radius:5px;cursor:pointer;}
    </style>
</head>
<body>
<h2>Doctor Management</h2>

<form method="POST">
    <h3>Add Doctor</h3>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="photo" placeholder="Photo URL">
    <input type="text" name="qualifications" placeholder="Qualifications">
    <input type="text" name="experience" placeholder="Experience (years)">
    <input type="text" name="specialization" placeholder="Specialization">
    <input type="text" name="contact" placeholder="Contact">
    <select name="department" required>
        <option value="">Select Department</option>
        <?php while($dep = mysqli_fetch_assoc($departments)) { ?>
        <option value="<?= $dep['id'] ?>"><?= $dep['name'] ?></option>
        <?php } ?>
    </select>
    <input type="text" name="schedule" placeholder="Schedule (e.g., Mon-Fri 9am-5pm)">
    <input type="number" name="slot" placeholder="Slot Duration (minutes)">
    <label><input type="checkbox" name="telemedicine" checked> Enable Telemedicine</label><br><br>
    <button type="submit" name="add_doctor">Add Doctor</button>
</form>

<h3>Doctor List</h3>
<table>
<tr>
    <th>ID</th><th>Name</th><th>Dept</th><th>Schedule</th><th>Slot</th><th>Telemedicine</th>
</tr>
<?php while($doc=mysqli_fetch_assoc($doctors)){ ?>
<tr>
    <td><?= $doc['id'] ?></td>
    <td><?= $doc['name'] ?></td>
    <td><?= $doc['department_name'] ?></td>
    <td><?= $doc['schedule'] ?></td>
    <td><?= $doc['slot_duration'] ?> min</td>
    <td><?= $doc['telemedicine'] ? 'Yes':'No' ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
