<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>User Roles & Security</title>
<style>body{font-family:sans-serif;padding:2rem;}ul{list-style:none;}</style>
</head>
<body>
<h2>User Roles & Security</h2>
<ul>
<li>Admin: Full access to all modules</li>
<li>Doctor: Access to patient records, appointments, EMR</li>
<li>Nurse: Access to assigned patient care, ward & bed management</li>
<li>Accountant: Billing & invoicing, financial reports</li>
<li>Patient: Appointment booking, view own records, billing</li>
</ul>

<h3>Security Measures</h3>
<ul>
<li>Role-based access control (RBAC)</li>
<li>Encrypted sensitive data (e.g., medical records)</li>
<li>Audit logs for all critical actions</li>
<li>Password policies & 2FA support</li>
</ul>
</body>
</html>
