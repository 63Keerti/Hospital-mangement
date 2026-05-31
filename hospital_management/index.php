<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediCare · Hospital Management</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;line-height:1.5;color:#1a2b3e;background:#f5f9fc;scroll-behavior:smooth;}
header{
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 20px rgba(0,40,80,0.08);
    display:flex;justify-content:space-between;align-items:center;
    padding:0.8rem 5%;position:sticky;top:0;z-index:100;border-bottom:1px solid rgba(30,144,255,0.15);
}
.logo{display:flex;align-items:center;gap:12px;}
.logo img{height:44px;width:auto;}
.logo span{font-size:1.6rem;font-weight:700;background:linear-gradient(145deg,#0b5fa5,#1e90ff);-webkit-background-clip:text;background-clip:text;color:transparent;}
nav{display:flex;align-items:center;gap:1rem;}
nav a{color:#1e3a5f;text-decoration:none;font-weight:600;font-size:1.05rem;border-bottom:2px solid transparent;padding-bottom:4px;transition:0.2s;}
nav a:hover{border-bottom-color:#1e90ff;color:#1e90ff;}

/* Register dropdown */
.register-dropdown {position:relative;display:inline-block;}
.register-dropdown button{background:#1e90ff;color:white;padding:0.5rem 1rem;border:none;border-radius:8px;font-weight:600;cursor:pointer;}
.register-dropdown button i{margin-left:5px;}
.register-dropdown-content {
    display:none;
    position:absolute;
    top:38px;
    right:0;
    background:white;
    border-radius:8px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
    min-width:150px;
    z-index:100;
}
.register-dropdown-content a{
    display:block;
    padding:0.8rem 1rem;
    color:#1e3a5f;
    text-decoration:none;
    border-bottom:1px solid #f0f0f0;
}
.register-dropdown-content a:last-child{border-bottom:none;}
.register-dropdown-content a:hover{background:#e5f3ff;}

.hero{
    min-height:85vh;
    background: linear-gradient(135deg, rgba(0,50,100,0.75), rgba(0,80,150,0.6)),
                url('https://images.unsplash.com/photo-1588776814546-8b9498637f4b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920') center/cover no-repeat fixed;
    display:flex;align-items:center;justify-content:center;text-align:center;color:white;padding:0 20px;
}
.hero h1{
    font-size: clamp(2.5rem,8vw,4.2rem);font-weight:700;
    background: rgba(10,25,45,0.45);backdrop-filter: blur(4px);
    padding:1.2rem 2.8rem;border-radius:60px;border:1px solid rgba(255,255,255,0.25);
    box-shadow:0 25px 40px -10px rgba(0,0,0,0.3);letter-spacing:-0.02em;
}

section{padding:5rem 5%;max-width:1400px;margin:0 auto;}
section h2{text-align:center;font-size:2.5rem;font-weight:600;color:#0c4a6e;margin-bottom:3.5rem;position:relative;}
section h2:after{content:'';display:block;width:90px;height:4px;background:linear-gradient(90deg,#1e90ff,#60a5fa);border-radius:4px;margin:1rem auto 0;}

.cards{display:flex;flex-wrap:wrap;justify-content:center;gap:2.5rem;}
.card{background:white;border-radius:28px;padding:2.2rem 1.8rem;width:300px;text-align:center;box-shadow:0 15px 30px -12px rgba(0,80,120,0.15);transition:all 0.25s ease;border:1px solid rgba(255,255,255,0.5);backdrop-filter: blur(4px);display:flex;flex-direction:column;align-items:center;}
.card:hover{transform:translateY(-10px);box-shadow:0 30px 40px -15px #1e90ff55;border-color:#1e90ff30;}
.card img{width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid white;box-shadow:0 10px 20px -5px rgba(30,144,255,0.4);margin-bottom:1.2rem;}
.card h3{font-size:1.6rem;font-weight:600;margin-bottom:0.25rem;color:#0c4a6e;}
.card p{color:#2c3e5c;font-weight:400;font-size:1.05rem;margin-top:0.25rem;}
#patients .card i{font-size:3.8rem;color:#1e90ff;background:#e5f0ff;padding:1.2rem;border-radius:50%;margin-bottom:1.5rem;transition:0.2s;box-shadow:0 5px 0 #b3d4ff;}
#patients .card:hover i{background:#1e90ff;color:white;box-shadow:0 8px 0 #0b68c1;transform: scale(0.95);}

#contact{background:#e3f0fd;border-radius:80px 80px 0 0;margin-top:1rem;padding-bottom:4rem;}
.contact-info{text-align:center;font-size:1.3rem;background:white;padding:2.2rem;border-radius:50px;max-width:800px;margin:0 auto;box-shadow:0 10px 25px rgba(0,0,0,0.03);border:1px solid #cfe5ff;}
.contact-info i{color:#1e90ff;margin:0 12px 0 20px;}
.contact-info i:first-child{margin-left:0;}

footer{background:#102a41;color:#b6d0e8;text-align:center;padding:2rem 5%;font-weight:400;letter-spacing:0.3px;border-top:3px solid #1e90ff;}

.chat-btn{position:fixed;bottom:30px;right:30px;background:#1e90ff;color:white;border:none;border-radius:50px;width:70px;height:70px;font-size:2rem;cursor:pointer;box-shadow:0 15px 25px #1e90ff80;display:flex;align-items:center;justify-content:center;z-index:99;border:2px solid white;}
.chat-btn:hover{background:#0b5fa5;transform:scale(1.08) rotate(5deg);box-shadow:0 20px 35px #0b5fa5b0;}

.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,20,50,0.5);backdrop-filter:blur(6px);align-items:center;justify-content:center;z-index:1000;}
.modal-content{background:white;padding:2.2rem 2.2rem 2.8rem;border-radius:40px;width:420px;max-width:90%;text-align:center;box-shadow:0 30px 50px rgba(0,60,120,0.3);border:1px solid white;animation: modalFadeIn 0.3s;}
@keyframes modalFadeIn{from{opacity:0;transform:scale(0.9);}to{opacity:1;transform:scale(1);}}
.modal-content h3{font-size:2rem;font-weight:600;color:#0c4a6e;margin-bottom:0.8rem;}
.modal-content p{font-size:1.1rem;color:#335;margin-bottom:2rem;}
.close-btn{position:absolute;top:20px;right:25px;font-size:2rem;cursor:pointer;color:#667;transition:0.15s;line-height:1;}
.close-btn:hover{color:#1e90ff;}
.modal-actions{display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;}
.modal-actions button{background:white;border:2px solid #1e90ff;color:#1e90ff;font-weight:600;font-size:1.2rem;padding:0.8rem 2rem;border-radius:40px;cursor:pointer;transition:0.15s;min-width:130px;display:inline-flex;align-items:center;justify-content:center;gap:8px;}
.modal-actions button:hover{background:#1e90ff;color:white;border-color:#1e90ff;box-shadow:0 8px 12px #1e90ff40;}
.modal-actions button i{font-size:1.3rem;}
@media(max-width:700px){header{flex-direction:column;gap:0.8rem;}nav a{margin:0 1rem;}.hero h1{font-size:2.2rem;padding:1rem;}section{padding:3rem 1.5rem;}}
</style>
</head>
<body>

<header>
    <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" alt="MediCare icon">
        <span>MediCare</span>
    </div>
    <nav>
        <a href="#home">Home</a>
        <a href="#doctors">Doctors</a>
        <a href="#patients">Patients</a>
        <a href="#contact">Contact</a>

        <!-- Register dropdown -->
       <!-- Register dropdown -->
<div class="register-dropdown">
    <button id="registerBtn">Register <i class="fas fa-caret-down"></i></button>
    <div class="register-dropdown-content" id="registerDropdown">
        <a href="patient_dashboard.php">Patient</a>
        <a href="doctor_dashboard.php">Doctor</a>
        <a href="register_3admin.php">Admin</a>
    </div>
</div>

        </div>
    </nav>
</header>

<div class="hero" id="home">
    <h1>Exceptional care, closer to you</h1>
</div>

<section id="doctors">
    <h2>Our specialists</h2>
    <div class="cards">
        <div class="card">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Smith">
            <h3>Dr. John Smith</h3>
            <p>Cardiologist · MBBS, MD</p>
        </div>
        <div class="card">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Emily Clark">
            <h3>Dr. Emily Clark</h3>
            <p>Pediatrician · DCH, MRCPCH</p>
        </div>
        <div class="card">
            <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="Dr. Alan Walker">
            <h3>Dr. Alan Walker</h3>
            <p>Neurologist · DM, FRCP</p>
        </div>
    </div>
</section>

<section id="patients">
    <h2>Patient services</h2>
    <div class="cards">
        <div class="card">
            <i class="fas fa-calendar-check"></i>
            <h3>Book appointment</h3>
            <p>Secure online scheduling, instant confirmation.</p>
        </div>
        <div class="card">
            <i class="fas fa-notes-medical"></i>
            <h3>Medical history</h3>
            <p>Access reports & records 24/7, privately.</p>
        </div>
        <div class="card">
            <i class="fas fa-file-invoice-dollar"></i>
            <h3>Billing & insurance</h3>
            <p>Transparent estimates and digital claims.</p>
        </div>
    </div>
</section>

<section id="contact">
    <h2>Get in touch</h2>
    <div class="contact-info">
        <i class="fas fa-envelope"></i> info@medicare.com
        <i class="fas fa-phone-alt"></i> +91 98765 43210
        <i class="fas fa-map-marker-alt"></i> 123 Health Street, City
    </div>
</section>

<footer>
    &copy; 2026 MediCare Hospital Management. All rights reserved.
    <span style="opacity:0.7; display:block; font-size:0.9rem; margin-top:8px;">Compassion · Innovation · Trust</span>
</footer>

<button class="chat-btn" id="chatBtn"><i class="fas fa-robot"></i></button>

<div class="modal" id="chatModal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h3><i class="fas fa-stethoscope" style="color:#1e90ff;"></i> MediBot AI</h3>
        <p>Hello! I’m your virtual assistant. Please identify yourself:</p>
        <div class="modal-actions">
            <button onclick="alert('👤 Patient portal — coming right up!')"><i class="fas fa-user-injured"></i> Patient</button>
            <button onclick="alert('👨‍⚕️ Doctor dashboard — secure access.')"><i class="fas fa-user-md"></i> Doctor</button>
            <button onclick="alert('🏥 Hospital user — welcome.')"><i class="fas fa-hospital-user"></i> User</button>
        </div>
        <p style="font-size:0.9rem; margin-top:1.8rem; color:#6b7b8f;"><i class="fas fa-shield-alt"></i> end-to‑end encrypted</p>
    </div>
</div>

<script>
    // Chat modal
    const chatBtn = document.getElementById('chatBtn');
    const modal = document.getElementById('chatModal');
    const closeBtn = document.getElementById('closeModal');
    chatBtn.addEventListener('click',()=>modal.style.display='flex');
    closeBtn.addEventListener('click',()=>modal.style.display='none');
    window.addEventListener('click',e=>{if(e.target===modal) modal.style.display='none';});
    window.addEventListener('keydown',e=>{if(e.key==='Escape'&&modal.style.display==='flex') modal.style.display='none';});

    // Register dropdown
    const registerBtn = document.getElementById('registerBtn');
    const registerDropdown = document.getElementById('registerDropdown');
    registerBtn.addEventListener('click', (e)=>{
        e.stopPropagation();
        registerDropdown.style.display = registerDropdown.style.display==='block'?'none':'block';
    });
    window.addEventListener('click',()=>registerDropdown.style.display='none');
</script>
</body>
</html>
