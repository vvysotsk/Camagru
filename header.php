<div id="header">
  <?php if(isset($_SESSION['id'])) { ?>
      <div class="button" onclick="location.href='framework/disconnect.php'">
        <span>Disconnect</snap>
      </div>
  <?php } else { ?>
    <div class="button" onclick="location.href='index.php'">
        <span>Login</snap>
    </div>
  <?php }
  if(isset($_SESSION['id'])) { ?>
  <div class="button" onclick="location.href='gallery.php'">
    <span>Gallery</snap>
  </div>
  <div class="button" onclick="location.href='views.php'">
    <span>Views</snap>
  </div>
  <?php } ?>
</div>
