<?php 
  unset($_COOKIE['current_user_id']);
    setcookie('current_user_id', null, time() - 3600, '/lms');
?>
<script>
    window.location = '../login'
</script>
<?php
?>