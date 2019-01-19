<?php
session_start();

if ($_SESSION['id'] == "") {
    header('location:index.php');
    exit();
}
?>
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
    

    </div>
</div>

</body>
<?php
require('footer.php')
?>
    </body>

</html>
