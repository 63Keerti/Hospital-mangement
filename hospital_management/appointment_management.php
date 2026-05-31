<?php
// appointment_management.php
session_start();

// Optional: check if user is logged in
// if (!isset($_SESSION['patient_id'])) {
//     header("Location: index.php");
//     exit();
// }

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "hospital_db";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle appointment form submission
if (isset($_POST['book_appointment'])) {
    $patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $doctor_id    = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);

    $insert = mysqli_query($conn, "INSERT INTO appointments (patient_name, doctor_id, appointment_date, appointment_time) 
                                  VALUES ('$patient_name', '$doctor_id', '$appointment_date', '$appointment_time')");
    if ($insert) {
        $msg = "Appointment booked successfully!";
        // TODO: Add SMS/Email reminder logic here
    } else {
        $msg = "Error booking appointment: " . mysqli_error($conn);
    }
}

// Fetch doctors for dropdown
$doctors = mysqli_query($conn, "SELECT id, name, specialization FROM doctors ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Scheduling · MediCare</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body { font-family:'Inter',sans-serif; background:#f5f9fc; color:#1a2b3e; margin:0; padding:0; }
    header { background:#1e90ff; color:white; padding:1rem 5%; display:flex; justify-content:space-between; align-items:center; }
    header h1 { font-size:1.8rem; }
    .container { max-width:900px; margin:3rem auto; background:white; padding:2rem; border-radius:20px; box-shadow:0 10px 25px rgba(0,0,0,0.1); }
    form { display:flex; flex-direction:column; gap:1rem; }
    input, select { padding:0.7rem 1rem; border-radius:8px; border:1px solid #ccc; font-size:1rem; width:100%; }
    button { background:#1e90ff; color:white; padding:0.8rem 1.5rem; border:none; border-radius:10px; font-weight:600; cursor:pointer; transition:0.3s; }
    button:hover { background:#0b5fa5; }
    .msg { text-align:center; font-weight:600; color:green; margin-bottom:1rem; }
    table { width:100%; border-collapse:collapse; margin-top:2rem; }
    table, th, td { border:1px solid #ccc; }
    th, td { padding:0.8rem; text-align:center; }
    th { background:#1e90ff; color:white; }
</style>
</head>
<body>

<header>
    <h1>MediCare · Appointment Scheduling</h1>
    <a href="patient_dashboard.php" style="color:white; text-decoration:none; font-weight:600;">Back to Dashboard <i class="fas fa-arrow-left"></i></a>
</header>

<div class="container">
    <?php if (isset($msg)) echo "<div class='msg'>$msg</div>"; ?>

    <h2>Book a New Appointment</h2>
    <form method="POST" action="">
        <input type="text" name="patient_name" placeholder="Patient Full Name" required>
        <select name="doctor_id" required>
            <option value="">Select Doctor</option>
            <?php while ($doc = mysqli_fetch_assoc($doctors)) { ?>
                <option value="<?php echo $doc['id']; ?>">
                    <?php echo $doc['name'] . " (" . $doc['specialization'] . ")"; ?>
                </option>
            <?php } ?>
        </select>
        <input type="date" name="appointment_date" required>
        <input type="time" name="appointment_time" required>
        <button type="submit" name="book_appointment"><i class="fas fa-calendar-check"></i> Book Appointment</button>
    </form>

    <h2>Upcoming Appointments</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        $appointments = mysqli_query($conn, "SELECT a.id, a.patient_name, d.name as doctor_name, a.appointment_date, a.appointment_time
                                             FROM appointments a
                                             JOIN doctors d ON a.doctor_id = d.id
                                             ORDER BY a.appointment_date ASC, a.appointment_time ASC");
        $count = 1;
        while ($row = mysqli_fetch_assoc($appointments)) {
            echo "<tr>
                    <td>{$count}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['appointment_date']}</td>
                    <td>{$row['appointment_time']}</td>
                  </tr>";
            $count++;
        }
        ?>
    </table>
</div>

</body>
</html>
