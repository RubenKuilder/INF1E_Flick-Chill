<?php
session_start();

if ($_SESSION['id'] == "") {
    header('location:index.php');
    exit();
}
    require('system/config.php');
    require('header.php');
?>
    <div class="about">
        <h1 class="ahead">About Us?</h1>
        <p>We are the Undercover Apple and the Rap Goblins, Students from NHLStenden.</p>
        <div class="abox">
            <p class="aname">Arjan Heijnen</p>
            <img class="asize" src="assets/images/aboutus/arjanheijnen.png" alt="Arjan Heijnen">
        </div>
        <div class="abox">
            <p class="aname">Casper van den Berg</p>
            <img class="asize" src="assets/images/aboutus/caspervdberg.png" alt="Casper van den Berg">
        </div>
        <div class="abox">
            <p class="aname">Jordy Neef</p>
            <img class="asize" src="assets/images/aboutus/jordyneef.png" alt="Jordy Neef">
        </div>
        <div class="abox">
            <p class="aname">Jurrian Tanke</p>
            <img class="asize" src="assets/images/aboutus/jurriantanke.png" alt="Jurrian Tanke">
        </div>
        <div class="abox">
            <p class="aname">Koen Somsen</p>
            <img class="asize" src="assets/images/aboutus/koensomsen.png" alt="Koen Somsen">
        </div>
        <div class="abox">
            <p class="aname">Lars Busker</p>
            <img class="asize" src="assets/images/aboutus/larsbusker.png" alt="Lars Busker">
        </div>
        <div class="abox">
            <p class="aname">Ruben Kuilder</p>
            <img class="asize" src="assets/images/aboutus/rubenkuilder.png" alt="Ruben Kuilder">
        </div>
    </div>
</body>