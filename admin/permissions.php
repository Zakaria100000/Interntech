<?php
  session_start();
  $email = $_SESSION['email'];

  $sql_permission = "SELECT rp.id_permission as permission, rp.is_allowed as is_allowed
    FROM user as u
    INNER JOIN role as r ON u.id_role = r.id
    INNER JOIN role_permission as rp ON r.id = rp.id_role
    WHERE u.email = '$email'";
?>