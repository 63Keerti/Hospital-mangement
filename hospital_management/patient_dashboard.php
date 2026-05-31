<?php
// patient_dashboard.php
session_start();
include 'db.php'; // Make sure your db.php is correctly configured
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patient Dashboard · Hospital Management</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg,#e0f0ff,#ffffff);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:20px;
}
.dashboard-container {
    background: rgba(255,255,255,0.95);
    padding:3rem 2rem;
    border-radius:30px;
    box-shadow:0 15px 40px rgba(0,60,120,0.2);
    text-align:center;
    width:100%;
    max-width:600px;
}
.dashboard-container h1 {
    margin-bottom:2rem;
    font-size:2rem;
    color:#0b5fa5;
}
.dashboard-container p {
    margin-bottom:2rem;
    color:#333;
}
.button-group {
    display:flex;
    flex-direction:column;
    gap:1.5rem;
}
.button-group a {
    text-decoration:none;
    padding:1.2rem 1rem;
    border-radius:50px;
    font-size:1.2rem;
    font-weight:600;
    color:white;
    background:#1e90ff;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    transition:0.2s;
}
.button-group a:hover {
    background:#0b5fa5;
    transform:scale(1.05);
}
.button-group a i {
    font-size:1.5rem;
}
</style>
</head>
<body>

<div class="dashboard-container">
    <h1>Patient Dashboard</h1>
    <p>Manage patient records, admissions, and history</p>

    <div class="button-group">
        <a href="register_patient.php"><i class="fas fa-user-plus"></i> Register Patient</a>
        <a href="adt.php"><i class="fas fa-procedures"></i> Admission / Discharge / Transfer (ADT)</a>
        <a href="history.php"><i class="fas fa-notes-medical"></i> Medical History</a>
    </div>
</div>

</body>
</html>
