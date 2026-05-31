<?php
// pharmacy.php
session_start();
$conn = mysqli_connect("localhost","root","","hospital_db");
if(!$conn){ die("DB failed: ".mysqli_connect_error()); }

// Add medicine
if(isset($_POST['add_medicine'])){
    $name = $_POST['name'];
    $qty  = $_POST['quantity'];
    mysqli_query($conn,"INSERT INTO pharmacy (medicine_name,quantity) VALUES ('$name','$qty')");
    $msg = "Medicine added!";
}

// Update stock alert (placeholder)
$low_stock = mysqli_query($conn,"SELECT * FROM pharmacy WHERE quantity < 10");
?>
<!DOCTYPE html>
<html>
<head>
<title>Pharmacy Management</title>
<style>body{font-family:sans-serif;padding:2rem;}input,button{padding:0.5rem;margin:0.5rem 0;}table{width:100%;border-collapse:collapse;}th,td{border:1px solid #ccc;padding:0.5rem;}th{background:#1e90ff;color:white;}.msg{color:green;}</style>
</head>
<body>
<h2>Pharmacy Inventory</h2>
<?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="name" placeholder="Medicine Name" required>
<input type="number" name="quantity" placeholder="Quantity" required>
<button type="submit" name="add_medicine">Add Medicine</button>
</form>

<h3>Current Stock</h3>
<table>
<tr><th>#</th><th>Medicine</th><th>Quantity</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM pharmacy ORDER BY id DESC");
$i=1;
while($row=mysqli_fetch_assoc($res)){
    echo "<tr><td>$i</td><td>{$row['medicine_name']}</td><td>{$row['quantity']}</td></tr>";
    $i++;
}
?>
</table>

<h3>Low Stock Alert</h3>
<?php if(mysqli_num_rows($low_stock)>0){ while($row=mysqli_fetch_assoc($low_stock)){ echo "<p>⚠ {$row['medicine_name']} low: {$row['quantity']} left</p>"; } } else { echo "<p>All stock sufficient</p>"; } ?>
</body>
</html>
