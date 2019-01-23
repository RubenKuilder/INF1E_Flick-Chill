<?php
session_start();

if ($_SESSION['id'] <= "1") {
    header('location:index.php');
    exit();
}
?>
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
    

    </div>
</div>

<?php
require('footer.php')
?>
