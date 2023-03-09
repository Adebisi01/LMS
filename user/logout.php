<?php 
   unset($_COOKIE['current_user_id']);
    setcookie('current_user_id', null, time() - 3600, '/lms');
    // setcookie('current_user_id', '', time() - 3600, '/');
?>
<script>
    window.location = '../login'
</script>
<?php
?>