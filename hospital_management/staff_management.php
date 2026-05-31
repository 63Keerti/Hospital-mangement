<?php
include 'db.php';

// Add staff
if(isset($_POST['add_staff'])){
    $name=$_POST['name']; $photo=$_POST['photo']; $role=$_POST['role'];
    $qual=$_POST['qualifications']; $exp=$_POST['experience']; $contact=$_POST['contact'];
    $shift=$_POST['shift']; $task=$_POST['task']; $training=$_POST['training'];

    $sql="INSERT INTO staff (name,photo,role,qualifications,experience,contact,shift,task,training)
          VALUES ('$name','$photo','$role','$qual','$exp','$contact','$shift','$task','$training')";
    mysqli_query($conn,$sql);
}

$staffs = mysqli_query($conn,"SELECT * FROM staff");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Management</title>
    <style>
        body{font-family:Arial;margin:20px;}
        form{border:1px solid #ddd;padding:20px;margin-bottom:20px;}
        input,select{width:100%;padding:8px;margin:5px 0;}
        button{padding:10px 20px;background:#1e90ff;color:white;border:none;border-radius:5px;cursor:pointer;}
        table{width:100%;border-collapse:collapse;}
        th,td{border:1px solid #ccc;padding:10px;text-align:left;}
        th{background:#1e90ff;color:white;}
    </style>
</head>
<body>
<h2>Staff Management</h2>

<form method="POST">
    <h3>Add Staff</h3>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="photo" placeholder="Photo URL">
    <input type="text" name="role" placeholder="Role (Nurse, Lab, Reception)">
    <input type="text" name="qualifications" placeholder="Qualifications">
    <input type="text" name="experience" placeholder="Experience">
    <input type="text" name="contact" placeholder="Contact">
    <input type="text" name="shift" placeholder="Shift (Morning/Evening/Night)">
    <input type="text" name="task" placeholder="Assigned Task/Ward">
    <input type="text" name="training" placeholder="Training/Certifications">
    <button type="submit" name="add_staff">Add Staff</button>
</form>

<h3>Staff List</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Role</th><th>Shift</th><th>Task</th><th>Training</th></tr>
<?php while($s=mysqli_fetch_assoc($staffs)){ ?>
<tr>
<td><?= $s['id'] ?></td><td><?= $s['name'] ?></td><td><?= $s['role'] ?></td>
<td><?= $s['shift'] ?></td><td><?= $s['task'] ?></td><td><?= $s['training'] ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
