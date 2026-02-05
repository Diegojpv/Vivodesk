<!-- ==================================== Navbar HTML ============================ -->
<!-- This file will be used in all sections of the wokdesk to avoid rewriting the same code for each file. -->
    <nav class="wd-navbar">
        <header class="wd-navbar__header">
            <h1>Vivodesk</h1>
                <input type="checkbox" id="wd-navbar--checkbox">
                <label for="wd-navbar--checkbox" class="wd-navbar__toggle">
                    <div class="bar bar--top"></div>
                    <div class="bar bar--middle"></div>
                    <div class="bar bar--bottom"></div>
                </label>
        </header>
        <div class="wd-navbar__wrapper">
            <div class="wd-navbar__user-info">
                <img src="../assets/img/user-navbar.webp" alt="">
                <p><?php echo htmlspecialchars($username); ?></p>
            </div>
            <ul class="wd-navbar__list">
                <li class="wd-navbar__link">
                    <a href="clients.php">
                        <img src="../assets/img/clients.webp" alt="">
                        <p>Clients</p>
                    </a>
                </li>
                <li class="wd-navbar__link">
                    <a href="inventory.php">
                        <img src="../assets/img/inventory.webp" alt="">
                        <p>Inventory</p>
                    </a>
                </li>   
                <li class="wd-navbar__link">
                    <a href="#">
                        <img src="../assets/img/services.webp" alt="">
                        <p>Services</p>
                    </a>    
                </li>
                <li class="wd-navbar__link">
                    <a href="#">
                        <img src="../assets/img/notification.webp" alt="">
                        <p>Notifications</p>
                    </a>
                </li>      
                <li class="wd-navbar__link">
                    <a href="profile.php">
                        <img src="../assets/img/user.webp" alt="">
                        <p>Profile</p>
                    </a>
                </li>
                <li class="wd-navbar__link">
                    <a href="../index.php">
                        <img src="../assets/img/exit.webp" alt="">
                        <p>Exit</p>
                    </a>
                </li>
            </ul>
        </div>
    </nav>