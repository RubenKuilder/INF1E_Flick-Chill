<!DOCTYPE html>
<?php
require('system/config.php');
require('header.php');

?>
    <h1 id="dashboardTitle">Dashboard</h1>
    <section id="dashboardContainer">
    </section>
    
    <div class="overlayPopup">
        <div class="overlayBackground"></div>
        <div class="popupContent">
            <div class="videoIframe">
                <img src="assets/images/emma-watson.jpg" alt="bae">
            </div>
            <div class="rating">
                <?php               require 'Rating.php';?>
            </div>
            <div class="discription">
                <h2>Sam Jackson</h2>
                <p>
                    Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
                </p>
            </div>
            <div class="popupFooter">
                <a href="https://youtu.be/z-zxaKQfW6s">https://youtu.be/z-zxaKQfW6s</a>
            </div>
        </div>
    </div>
    </body>
</html>
