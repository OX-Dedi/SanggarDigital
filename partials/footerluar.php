<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
   @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
  footer {
    background: linear-gradient(145deg, #0f0c29, #302b63, #24243e);
    color: #e0e0f8;
    font-family: 'Poppins', sans-serif;
    padding: 4rem 2rem 2rem;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 1s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .footer-container {
    max-width: 1300px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
  }

  .footer-column h3 {
    color: #a77fff;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    position: relative;
    font-weight: 600;
  }

  .footer-column h3::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    background: #a77fff;
    margin-top: 6px;
    border-radius: 5px;
  }

  .footer-column p,
  .footer-column li,
  .footer-column a {
    font-size: 0.95rem;
    color: #ccc;
    line-height: 1.7;
    text-decoration: none;
  }

  .footer-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-column a:hover {
    color: #ffffff;
    text-shadow: 0 0 5px #a77fff;
  }

  .partner-logos {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 1rem;
  }

  .partner-logos a {
    width: 55px;
    height: 55px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .partner-logos a img {
    width: 70%;
    height: auto;
  }

  .partner-logos a:hover {
    transform: scale(1.15);
    box-shadow: 0 0 12px #a77fff99;
  }

  .social-icons {
    display: flex;
    gap: 15px;
    margin-top: 1rem;
  }

  .social-icons a {
    font-size: 1.4rem;
    color: #ccc;
    padding: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    transition: 0.3s;
    backdrop-filter: blur(5px);
  }

  .social-icons a:hover {
    color: #ffffff;
    background: #a77fff;
    transform: scale(1.2);
    box-shadow: 0 0 10px #a77fff;
  }

  .footer-bottom {
    text-align: center;
    margin-top: 3rem;
    font-size: 0.9rem;
    color: #aaa;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 1.5rem;
  }

  @media (max-width: 768px) {
    .footer-container {
      grid-template-columns: 1fr;
      text-align: center;
    }

    .partner-logos,
    .social-icons {
      justify-content: center;
    }
  }
</style>

<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h3>Tentang Kami</h3>
      <p>SanggarDigital adalah platform pembelajaran digital kreatif untuk pelajar dan mahasiswa Indonesia, menggabungkan teknologi dan kreativitas.</p>
    </div>
    <div class="footer-column">
      <h3>Navigasi</h3>
      <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Kursus</a></li>
        <li><a href="#">Artikel</a></li>
        <li><a href="#">Tentang Kami</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Kontak</h3>
      <p>Email: info@sanggardigital.id</p>
      <p>Telp: +62 812 3456 7890</p>
      <p>Alamat: Jl. Teknologi No. 88, Bandung</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
    <div class="footer-column">
      <h3>Mitra Kami</h3>
      <div class="partner-logos">
        <a href="#"><img src="assets/1.png" alt="Logo 1"></a>
        <a href="#"><img src="assets/2.png" alt="Logo 2"></a>
        <a href="#"><img src="assets/3.png" alt="Logo Dev"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    &copy; 2025 <strong>SanggarDigital</strong>. All rights reserved.
  </div>
</footer>
