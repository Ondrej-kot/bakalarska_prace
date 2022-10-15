<head>
    <link rel="stylesheet" href="header.css">
</head>
<header>
    <nav class="navbar">
        <a href="./index.php"><div class="logo"><img id="logo" src="./img/logo_b.png"><div id="logo_text">Provozně ekonomická fakulta</div></div></a>

        <ul class="nav-links">
            <input type="checkbox" id="checkbox_toggle" />
            <label for="checkbox_toggle" class="hamburger">&#9776;</label>
            <!-- NAVIGATION MENUS -->
            <div class="menu">
                <a href="./uznani_predmetu.php"><li>Uznání předmětu</li></a>
                <a href="./presun_predmetu.php"><li>Přesun předmětu</li></a>
                <li class="services">
                    <a>Další žádosti</a>
                    <!-- DROPDOWN MENU -->
                    <ul class="dropdown">
                        <a href="./uni_zadost.php"><li>Univerzání žádost</li></a>
                        <a href="./opakovani_rocniku.php"><li>Opakování ročníku</li></a>
                        <a href="./prihlaska_promoce.php"><li>Přihláška k promoci</li></a>
                    </ul>
                </li>
                <?php if (isset($_SESSION['iduser'])) { ?>
                    <a href="./account.php"><li><?php
                            echo $_SESSION['name'];
                            echo ' ';
                            echo $_SESSION['surname'];
                            ?></li></a>
                <?php } ?>
                <?php if (!isset($_SESSION['iduser'])) { ?>
                    <a onclick="openForm()"><li>Přihlášení</li></a>
<?php } ?>
            </div>
        </ul>
    </nav>

    <div id="pozadi">         
        <div id="prihlaseni">
            <span onclick="closeForm()" id="exit">×</span>
            <div id="whitebck">
                <form id="login" action="login.php" method="POST">
                    <div class="container">
                        <h1>Přihlásit se</h1>
                        <p id="pozn">Pro přihlášení vyplňte pole níže.</p>
                        <hr>
                        <label for="e-mail"><b>Uživatelské jméno</b></label>
                        <input id="w1" type="email" placeholder="xuzivatel001" id="e-mail" name="email" required>
                        <label for="w2"><b>Heslo</b></label>
                        <input id="w2" type="password" placeholder="Heslo" name="password" required>
                        <a id="forgotpass" href="/zapom_heslo.php" >Zapomněli jste heslo?</a>
                        <div id="hlaska"></div>
                        <button type="submit" id="signupbtn">Přihlásit se</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <script>
        function openForm() {
            document.getElementById("pozadi").style.display = "block";
        }
        function closeForm() {
            document.getElementById("pozadi").style.display = "none";
        }
    </script>
</header>

