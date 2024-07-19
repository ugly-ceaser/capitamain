<?php if (isset($_GET["msg"])) { ?>
  <div class="alert bg-light alert-dismissible">
    <a href="#" class="close text-danger" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?= $_GET["msg"] ?></strong>
  </div>
<?php } ?>