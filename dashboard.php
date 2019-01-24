<?php
session_start();

if ($_SESSION['id'] <= "1") {
    header('location:index.php');
    exit();
}

require('system/config.php');
require('header.php');
if(isset($_GET['search'])){
    $dTitel = ucfirst(($_GET['search']));
} else {
    $dTitel = 'Dashboard';
}

?>
<h1 id="dashboardTitle"><?php echo $dTitel; ?> </h1>
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
