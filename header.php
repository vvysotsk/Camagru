<div id="header">
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="button" onclick="location.href = 'framework/disconnect.php'">
            <div class="empty">Disconnect</div>
        </div>
    <?php } else { ?>
        <div class="button" onclick="location.href = 'index.php'">
            <div class="empty">Login</div>
        </div>
    <?php }
    if (isset($_SESSION['id'])) {
        ?>
        <div class="button" onclick="location.href = 'gallery.php'">
            <div class="empty">Gallery</div>
        </div>
        <div class="button" onclick="location.href = 'views.php'">
            <div class="empty">Views</div>
        </div>
<?php } ?>
</div>
