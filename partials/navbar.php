<style>
  nav {
    background: #4f46e5; 
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  nav h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    display: flex;
    align-items: center;
  }

  nav h2 img {
    height: 30px;
    margin-right: 10px;
    vertical-align: middle;
  }

  ul {
    list-style: none;
    display: flex;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
  }

  nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: 700;
    padding: 0.5rem 1.2rem;
    border-radius: 12px;
    background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
    box-shadow: 0 4px 10px rgba(124, 58, 237, 0.4);
    transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
    display: inline-block;
    user-select: none;
  }

  nav ul li a:hover,
  nav ul li a:focus {
    background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
    box-shadow: 0 6px 15px rgba(167, 139, 250, 0.7);
    transform: translateY(-2px);
    outline: none;
  }

  nav ul li a:active {
    transform: translateY(0);
    box-shadow: 0 3px 8px rgba(124, 58, 237, 0.6);
  }

  @media (max-width: 600px) {
    nav {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.8rem;
    }
    nav ul {
      flex-direction: column;
      width: 100%;
      gap: 0.5rem;
    }
    nav ul li a {
      display: block;
      width: 100%;
      text-align: center;
    }
  }
</style>

<nav>
  <h2>
    <img src="logo.png" alt="Logo">
    SANGGAR DIGITAL
  </h2>
  <ul>
    <li><a href="/sanggardigital/">Home</a></li>
    <li><a href="#" id="btnShowLogin">Login</a></li>
  </ul>
</nav>
