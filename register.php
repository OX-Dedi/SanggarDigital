<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi Kursus</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

   body {
  font-family: 'Inter', sans-serif;
  background: url('bgori2.png') center/cover no-repeat, 
              linear-gradient(135deg, #3B82F6, #9333EA);
  background-blend-mode: overlay;
  overflow: hidden;
  height: 100vh;
  position: relative;
  animation: gradientShift 20s infinite linear;
}
 
.container {
  position: relative;
  z-index: 1;
  max-width: 420px;
  margin: auto;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.25);  
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);

  
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);

  border: 1px solid rgba(255, 255, 255, 0.3); 
}


    @keyframes fadeSlideIn {
      0% {opacity: 0; transform: translateY(40px);}
      100% {opacity: 1; transform: translateY(0);}
    }

    .container h2 {
      text-align: center;
      margin-bottom: 24px;
      font-size: 24px;
      color: #111827;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      font-size: 14px;
      color: #374151;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      border-radius: 10px;
      border: 1px solid #d1d5db;
      background-color: #f9fafb;
      font-size: 15px;
      transition: border-color 0.3s;
    }

    .form-group input:focus {
      border-color: #6366f1;
      outline: none;
      background-color: #fff;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #6366f1;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #4f46e5;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color:rgb(246, 246, 61);
      text-decoration: none;
      font-weight: 500;
    }

    .back-link:hover {
      color:rgb(255, 255, 255);
    }

       #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

  </style>
</head>
<body>

<div id="particles-js"></div>

<div class="container">
  <h2>Registrasi Akun</h2>
  <form method="POST">
    <div class="form-group">
      <label for="name">Nama Lengkap</label>
      <input type="text" id="name" name="name" placeholder="Contoh: Nama Lengkap Kamu" required />
    </div>
    <div class="form-group">
      <label for="email">Email Aktif</label>
      <input type="email" id="email" name="email" placeholder="Contoh: email@gmail.com" required />
    </div>
    <div class="form-group">
      <label for="password">Kata Sandi</label>
      <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required />
    </div>
    <button type="submit">Daftar Sekarang</button>
  </form>
  <a href="index.php" class="back-link">← Kembali ke Beranda</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", {
  "particles": {
    "number": {"value": 60, "density": {"enable": true, "value_area": 800}},
    "color": {"value": "#ffffff"},
    "shape": {"type": "circle"},
    "opacity": {"value": 0.3},
    "size": {"value": 4},
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.2,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 2,
      "direction": "none",
      "straight": false,
      "bounce": false
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {"enable": true, "mode": "grab"},
      "onclick": {"enable": false}
    },
    "modes": {
      "grab": {"distance": 140, "line_linked": {"opacity": 0.5}}
    }
  },
  "retina_detect": true
});
</script>

</body>
</html>
