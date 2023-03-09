<?php require_once('../config/db.php') ?>
<?php require_once('../config/app-config.php') ?>
<?php require_once('../config/variables.php') ?>

<?php if($current_user_role !== 'user'): ?> <script> window.location = '../403' </script> <?php endif ?>
<?php if($current_user_status == 'fined'): ?> <script> window.location = 'fined' </script> <?php endif ?>