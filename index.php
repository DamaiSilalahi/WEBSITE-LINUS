<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/faq.css">
    <link rel="stylesheet" href="css/stylenav.css">  
    <link rel="stylesheet" href="css/dm_main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Didot&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQysCqG7Sro0uY27iNvQ6MJ86oWkiLccs"></script>
    <script src="js/script_map.js"></script>
    <title>LINUS TRACKING</title>

</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="img/logousu.jpg" alt="logo usu">
        </div>
        <div class="center-nav">
            <a href="index.php"> 
                <h1>
                    <span>LINUS</span>
                    <span>TRACKING</span>
                </h1>
            </a>
            <a href="index.php" class="location-linus-btn"> 
                <img src="img/logolinus1.png" alt="logolinus">
            </a>
        </div>

        <div class="toggle-container">
        <div class="toggle-with-text">
        <a href="TL/TentangLinus.php"> <span class="tentang-linus">Tentang</span></a>
        </div>
            <input type="checkbox" id="darkModeToggle">
            <label for="darkModeToggle" class="toggle-label">
                <div class="toggle-ball">
                    <svg class="sun-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" style="fill: rgba(56, 189, 248, 0.2); stroke: #0ea5e9;"></path>
                        <path d="M12 4v1M17.66 6.344l-.828.828M20.005 12.004h-1M17.66 17.664l-.828-.828M12 20.01V19M6.34 17.664l.835-.836M3.995 12.004h1.01M6 6l.835.836" style="stroke: #0ea5e9;"></path>
                    </svg>

                    <svg class="moon-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z" style="fill: rgba(56, 189, 248, 0.2);"></path>
                        <path d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.632Z" style="fill: #0ea5e9;"></path>
                        <path d="M17 3a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z" style="fill: #0ea5e9;"></path>
                    </svg>
                </div>
            </label>
        </div>        

      <div class="hamburger" onclick="toggleSidebar()">
          &#9776;
      </div>
  </nav> 

<aside id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="toggleSidebar()">&times;</a>
    <a href="TL/TentangLinus.php" onclick="openTentangLinus()">Tentang Linus</a>

    <div class="toggle-container">
        <input type="checkbox" id="darkModeToggle">
        <label for="darkModeToggle" class="toggle-label">
            <div class="toggle-ball">

                <svg class="sun-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" style="fill: rgba(56, 189, 248, 0.2); stroke: #0ea5e9;"></path>
                    <path d="M12 4v1M17.66 6.344l-.828.828M20.005 12.004h-1M17.66 17.664l-.828-.828M12 20.01V19M6.34 17.664l.835-.836M3.995 12.004h1.01M6 6l.835.836" style="stroke: #0ea5e9;"></path>
                </svg>

                <svg class="moon-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17.715 15.15A6.5 6.5 0 0 1 9 6.035C6.106 6.922 4 9.645 4 12.867c0 3.94 3.153 7.136 7.042 7.136 3.101 0 5.734-2.032 6.673-4.853Z" style="fill: rgba(56, 189, 248, 0.2);"></path>
                    <path d="m17.715 15.15.95.316a1 1 0 0 0-1.445-1.185l.495.869ZM9 6.035l.846.534a1 1 0 0 0-1.14-1.49L9 6.035Zm8.221 8.246a5.47 5.47 0 0 1-2.72.718v2a7.47 7.47 0 0 0 3.71-.98l-.99-1.738Zm-2.72.718A5.5 5.5 0 0 1 9 9.5H7a7.5 7.5 0 0 0 7.5 7.5v-2ZM9 9.5c0-1.079.31-2.082.845-2.93L8.153 5.5A7.47 7.47 0 0 0 7 9.5h2Zm-4 3.368C5 10.089 6.815 7.75 9.292 6.99L8.706 5.08C5.397 6.094 3 9.201 3 12.867h2Zm6.042 6.136C7.718 19.003 5 16.268 5 12.867H3c0 4.48 3.588 8.136 8.042 8.136v-2Zm5.725-4.17c-.81 2.433-3.074 4.17-5.725 4.17v2c3.552 0 6.553-2.327 7.622-5.537l-1.897-.632Z" style="fill: #0ea5e9;"></path>
                    <path d="M17 3a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z" style="fill: #0ea5e9;"></path>
                </svg>
            </div>
        </label>
    </div>
</div>
  </aside>

     <div class="notification-box" id="notification">
        <p id="notificationMessage">Ini adalah pemberitahuan!</p>
    </div>
    
    <script>
        setTimeout(() => {
            showNotification(" ⚠️ LINUS sedang tidak beroperasi", 5000);
        }, 2000);
    </script>
    <a href="faq/faq.php">
       <div class="faq-button">
           <i class="fa fa-question"></i>
       </div>
    </a>
    <main>
        <div class="mapContainer">  
            <div id="map"></div>
        </div>
    </main>

    <footer>
    <div class="footer-content">
        <div class="layanan-pengaduan">
            <div class="icon-box">
                <i class="fa fa-user" style="font-size: 50px;"></i>
            </div>
            <p style="font-size: 35px">LAYANAN PENGADUAN</p>
            <div class="phone">
                <i class="fa fa-phone"></i>
                <i class="fa fa-whatsapp"></i>
                <span>0812-6356-534<br>0812-8688-5588</span>
            </div>
        </div>
        <div class="footer-center">
            <p class="copyright">Copyright © 2024 Linus Tracking</p>
        </div>
    </div>
</footer> 
<script src="js/script.js"></script>
</body>
</html>
