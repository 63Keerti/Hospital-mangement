<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Horizon Admin · Hospital Dashboard</title>
<!-- Google Font & Font Awesome -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>
/* ------------------ BASIC RESET ------------------ */
* { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
body { background: #f0f4f8; display: flex; height: 100vh; overflow: hidden; }

/* ------------------ SIDEBAR ------------------ */
.sidebar {
    width: 280px; height: 100vh;
    background: linear-gradient(170deg, #0a1a2b 0%, #112b42 100%);
    color: #e0edff; transition: width 0.35s; position: relative;
    box-shadow: 10px 0 30px rgba(0,20,40,0.3); border-right: 1px solid rgba(255,255,255,0.05);
    overflow-y: auto; overflow-x: hidden; z-index: 10;
}
.sidebar.collapsed { width: 85px; }
.sidebar .logo-area { display:flex; align-items:center; justify-content:space-between; padding:1.8rem 1.2rem 1.8rem 1.5rem; border-bottom:1px solid rgba(255,255,255,0.08); margin-bottom:1.5rem; }
.sidebar .logo-area h2 { font-weight:600; font-size:1.8rem; background: linear-gradient(130deg, #aac8ff, #ffffff); -webkit-background-clip:text; background-clip:text; color:transparent; white-space:nowrap; }
.sidebar.collapsed .logo-area h2 { display:none; }
.collapse-arrow { background: rgba(255,255,255,0.1); width:32px; height:32px; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:#b0d0ff; font-size:1.2rem; }
.collapse-arrow:hover { background:#2563eb; color:white; }
.sidebar.collapsed .collapse-arrow { transform:rotate(180deg); margin:auto; }
.sidebar ul { list-style:none; padding:0 12px; }
.sidebar ul li { margin:8px 0; }
.sidebar ul li a { display:flex; align-items:center; gap:16px; padding:12px 18px; border-radius:14px; color:#cbd5e1; text-decoration:none; font-weight:500; font-size:1rem; transition:all 0.2s; white-space:nowrap; }
.sidebar ul li a i { font-size:1.4rem; min-width:28px; color:#7aa9ff; }
.sidebar ul li a:hover { background:#2563eb; color:white; box-shadow:0 8px 12px #1e3a8a40; }
.sidebar ul li a:hover i { color:white; }
.sidebar.collapsed ul li a span { display:none; }
.sidebar.collapsed ul li a { justify-content:center; padding:12px 0; }

/* ------------------ MAIN PANEL ------------------ */
.main { flex:1; display:flex; flex-direction:column; overflow-y:auto; background:#f4f9ff; }

/* ------------------ HEADER ------------------ */
.header { background: rgba(255,255,255,0.75); backdrop-filter: blur(12px); padding:0.8rem 2rem; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid rgba(30,144,255,0.2); box-shadow:0 8px 20px rgba(0,30,60,0.05); position:sticky; top:0; z-index:5; }
.page-title h1 { font-size:1.9rem; font-weight:600; background: linear-gradient(145deg, #1e3a5f, #2563eb); -webkit-background-clip:text; background-clip:text; color:transparent; }
.header-right { display:flex; align-items:center; gap:25px; }
.search-box { background:white; border-radius:40px; padding:0.4rem 0.4rem 0.4rem 1.5rem; display:flex; align-items:center; box-shadow:0 4px 12px rgba(0,0,0,0.02); border:1px solid #e2ecff; }
.search-box input { border:none; outline:none; background:transparent; font-size:1rem; width:200px; }
.search-box button { background:#2563eb; border:none; color:white; width:38px; height:38px; border-radius:40px; cursor:pointer; transition:0.2s; }
.search-box button:hover { background:#0b5fa5; transform:scale(1.05); }
.profile { display:flex; align-items:center; gap:12px; cursor:pointer; }
.profile img { width:48px; height:48px; border-radius:50%; object-fit:cover; border:2px solid white; box-shadow:0 4px 10px rgba(0,80,150,0.2); }
.profile span { font-weight:600; color:#1e2f4a; }

/* ------------------ QUICK ACTION CARDS ------------------ */
.cards { display:grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap:1.8rem; padding:2rem; }
.card { background:white; padding:1.6rem 1.5rem; border-radius:28px; box-shadow:0 18px 30px -12px rgba(0,70,120,0.12); transition:0.3s; border:1px solid rgba(255,255,255,0.6); display:flex; align-items:center; justify-content:space-between; cursor:pointer; }
.card:hover { transform:translateY(-8px); box-shadow:0 30px 45px -15px #2563eb80; border-color:#2563eb30; }
.card-left h3 { font-size:1rem; font-weight:500; color:#4b587c; margin-bottom:6px; }
.card-left p { font-size:1.2rem; font-weight:600; color:#0b2a4a; }
.card-icon { background:linear-gradient(145deg,#e5f0ff,#d4e6ff); width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2rem; color:#2563eb; transition:0.2s; }
.card:hover .card-icon { background:#2563eb; color:white; transform:scale(1.05); }

/* footer */
.footer-note { text-align:center; padding:1.5rem; color:#7a8cac; font-size:0.95rem; border-top:1px solid #d9e8ff; margin-top:1rem; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="logo-area">
        <h2>Horizon</h2>
        <div class="collapse-arrow" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <!-- UPDATED LINKS -->
    <ul>
        <li><a href="index.php"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a></li>
        <li><a href="doctor_dashboard.php"><i class="fas fa-user-md"></i><span>Doctors</span></a></li>
        <li><a href="patient_dashboard.php"><i class="fas fa-user-nurse"></i><span>Staff</span></a></li>
        <li><a href="billing.php"><i class="fas fa-file-invoice"></i><span>Billing</span></a></li>
        <li><a href="pharmacy.php"><i class="fas fa-pills"></i><span>Pharmacy</span></a></li>
        <li><a href="laboratory.php"><i class="fas fa-vial"></i><span>Laboratory</span></a></li>
        <li><a href="emr.php"><i class="fas fa-notes-medical"></i><span>EMR</span></a></li>
        <li><a href="ward_bed.php"><i class="fas fa-bed"></i><span>Ward & Bed</span></a></li>
        <li><a href="reports.php"><i class="fas fa-chart-bar"></i><span>Reports</span></a></li>
        <li><a href="roles_security.php"><i class="fas fa-shield-alt"></i><span>Roles & Security</span></a></li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">
    <!-- HEADER -->
    <div class="header">
        <div class="page-title">
            <h1>Hospital Admin Dashboard</h1>
        </div>
        <div class="header-right">
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="icon-btn">
                <i class="far fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>
            <div class="profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="profile">
                <span>Elena Parker</span>
            </div>
        </div>
    </div>

    <!-- QUICK ACTIONS CARDS -->
    <div class="cards">
        <div class="card" onclick="location.href='billing.php';">
            <div class="card-left"><h3>Billing</h3><p>Generate invoices & manage claims</p></div>
            <div class="card-icon"><i class="fas fa-file-invoice"></i></div>
        </div>
        <div class="card" onclick="location.href='pharmacy.php';">
            <div class="card-left"><h3>Pharmacy</h3><p>Manage medicines & stock</p></div>
            <div class="card-icon"><i class="fas fa-pills"></i></div>
        </div>
        <div class="card" onclick="location.href='laboratory.php';">
            <div class="card-left"><h3>Laboratory</h3><p>Test requests & results</p></div>
            <div class="card-icon"><i class="fas fa-vial"></i></div>
        </div>
        <div class="card" onclick="location.href='emr.php';">
            <div class="card-left"><h3>EMR</h3><p>Electronic medical records</p></div>
            <div class="card-icon"><i class="fas fa-notes-medical"></i></div>
        </div>
        <div class="card" onclick="location.href='ward_bed.php';">
            <div class="card-left"><h3>Ward & Bed</h3><p>Bed allocation & availability</p></div>
            <div class="card-icon"><i class="fas fa-bed"></i></div>
        </div>
        <div class="card" onclick="location.href='reports.php';">
            <div class="card-left"><h3>Reports</h3><p>Analytics & daily reports</p></div>
            <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
        </div>
        <div class="card" onclick="location.href='roles_security.php';">
            <div class="card-left"><h3>Roles & Security</h3><p>User permissions & audit logs</p></div>
            <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
        </div>
    </div>

    <div class="footer-note">
        &copy; 2026 MediCare Hospital Admin Dashboard. All rights reserved.
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
    const arrowIcon = document.querySelector('.collapse-arrow i');
    if(sidebar.classList.contains('collapsed')){
        arrowIcon.classList.replace('fa-chevron-left','fa-chevron-right');
    } else {
        arrowIcon.classList.replace('fa-chevron-right','fa-chevron-left');
    }
}
</script>
</body>
</html>
