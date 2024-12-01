<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/TL.css">
    <link rel="stylesheet" href="../css/dm_TL.css">
    <link rel="stylesheet" href="../css/dm_main.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/stylenav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Didot&display=swap" rel="stylesheet">
    <title>LINUS TRACKING</title>
    <script>
        function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("active");
    }
    </script>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="../img/logousu.jpg" alt="logo usu">
        </div>
        <div class="center-nav">
            <a href="../index.php"> 
                <h1>
                    <span>LINUS</span>
                    <span>TRACKING</span>
                </h1>
            </a>
            <a href="../index.php" class="location-linus-btn">
                <img src="../img/logolinus1.png" alt="logolinus">
            </a>
        </div>

        <div class="toggle-container">
        <div class="toggle-with-text">
        <a href="../TL/TentangLinus.php"> <span class="tentang-linus">Tentang</span></a>
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
          <a href="TentangLinus.php" onclick="openTentangLinus()">Tentang Linus</a> 
        </aside>
    <a href="../faq/faq.php">
       <div class="faq-button">
           <i class="fa fa-question"></i>
    </div>
    </a>   
    <main>
       
        <section class="TLcontent">
            <article class="TLdescription">
                <header>
                <h1 class="main-title">TENTANG LINUS</h1>
                    </header>
                <img src="../img/linus_1.webp" alt="Gambar Bus LINUS" class="TLbus-image">
                <p>
                    Universitas Sumatera Utara dengan bangga mempersembahkan <strong>Bus LINUS (Lintas USU)</strong>, sebuah inovasi transportasi transit yang diluncurkan pada 9 Maret 2013. Layanan ini dirancang khusus untuk memudahkan mobilitas civitas academica USU, menawarkan kenyamanan dan efisiensi tanpa biaya, alias gratis!
                </p>
                <p>
                    Dengan dua armada yang siap beroperasi setiap hari perkuliahan, Bus LINUS melayani rute mengelilingi kawasan kampus yang strategis. Mahasiswa dapat dengan mudah menumpangi bus ini dengan menunggu di halte-halte yang tersebar dari pintu 1 hingga pintu 4 Kampus USU. Keberadaan Bus LINUS telah menjadikannya sebagai primadona di kalangan mahasiswa, bukan hanya karena layanan gratis yang ditawarkan, tetapi juga karena kenyamanan yang tiada tara.
                </p>
                <p>
                    Bus LINUS dilengkapi dengan kursi ergonomis dan pendingin udara yang membuat setiap perjalanan menjadi lebih menyenangkan. Selain berfungsi sebagai solusi transportasi yang efisien, bus ini juga sering menjadi tempat yang ideal untuk berinteraksi antar mahasiswa. Suasana akrab dan penuh kehangatan tercipta, mempererat hubungan sosial di lingkungan kampus.
                </p>
                <p>
                    Layanan ini bukan sekadar fasilitas, tetapi juga cerminan komitmen USU untuk menciptakan lingkungan yang mendukung keberlanjutan dan kesejahteraan komunitas kampus. Dengan semua keunggulannya, Bus LINUS mempermudah mobilitas sekaligus memperkaya pengalaman kampus yang nyaman dan dinamis. Ayo manfaatkan layanan ini untuk menjelajahi kampus dan berinteraksi dengan teman-teman!
                </p>
            </article>

            <article>
                <img src="../img/rute_linus.png" alt="Gambar rute linus" class="TLrute">
                <div class="TLtable">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center;">Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="TLbold">Hari</td>
                                <td class="TLbold">Waktu</td>
                            </tr>
                            <tr>
                                <td>Senin-Jumat</td>
                                <td>07.30-17.00</td>
                            </tr>
                            <tr>
                                <td>Sabtu</td>
                                <td>07.30-13.00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="TLinfo">Tiba setiap 10-15 Menit</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="TLnotes">
                        <p>*Harap Tunjukkan Kartu Tanda Mahasiswa/Staff pada saat naik.</p>
                        <p>*Harap selalu menjaga ketertiban, kesopanan, dan kebersihan untuk kenyamanan bersama.</p>
                    </div>
                </div>

                <div class="TLprocedure-table">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center;">Prosedur Naik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="TLbold">Perempuan</td>
                                <td>Naik dari pintu belakang</td>
                            </tr>
                            <tr>
                                <td class="TLbold">Laki-laki</td>
                                <td>Naik dari pintu depan</td>
                            </tr>
                            <tr>
                                <td class="TLbold">Cara Keluar</td>
                                <td>Semua keluar dari pintu depan</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="TLinfo">*Jangan lupa mengucapkan terima kasih kepada supir.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>
    <script src="../js/darkmode.js"></script>
   
</body>
</html>