<?php
session_start();
session_destroy();

echo "<script>
alert('Logout Success');
location.href='../guest.php';
</script>";
?>