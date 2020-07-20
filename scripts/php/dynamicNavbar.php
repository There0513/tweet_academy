<div class="col" id="kek">
    <div id="navbarMenu" class="col">
        <div class="row mt-4 navbarItems">
            <a href="./index.php">
                <h5 class="navbarTitles d-none d-lg-block d-xl-block mr-4">Home</h5>
            </a>
            <a href="./index.php"><img class="navbarImg" src="./assets/navbar-home.png"></a>
        </div>
        <div class="row mt-4 navbarItems">
            <a href="./profile.php">
                <h5 class="navbarTitles d-none d-lg-block d-xl-block mr-4">Profile</h5>
            </a>
            <a href="./profile.php?pseudo=<?= $userInfo[3]; ?>"><img class="navbarImg" src="./assets/navbar-profile.png"></a>
        </div>
        <div class="row mt-4 navbarItems">
            <a href="./messages.php">
                <h5 class="navbarTitles d-none d-lg-block d-xl-block mr-4">Messages</h5>
            </a>
            <a href="./messages.php"><img class="navbarImg" src="./assets/navbar-message.png"></a>
        </div>
        <?php
        if (isset($_SESSION['id_user'])) {
        ?>
            <div class="row mt-4 navbarItems">
                <h5 class="navbarTitles d-none d-lg-block d-xl-block mr-4"><a href="./redirect.php?disconnect=1">Logout</a></h5>
                <img class="navbarImg" src="./assets/navbar-logout.png">
            </div>
        <?php } else {
        ?>
            <div class="row mt-4 navbarItems">
                <h5 class="navbarTitles d-none d-lg-block d-xl-block mr-4"><a href="./login.php">Login/Signup</a></h5>
            </div>
        <?php }
        ?>
        <div class="row" style="margin-top: 400px;">
            <button class="btn btn-light" type="text" id="theme_day">Light theme</button>
            <button class="btn btn-dark" type="text" id="theme_night">Dark theme</button>
        </div>
    </div>
</div>