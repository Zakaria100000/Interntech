<?php
  session_start();
  $email = $_SESSION['email'];

  $sql_permission = "SELECT p.label as permission, rp.is_allowed as is_allowed
    FROM user as u
    INNER JOIN role as r ON u.id_role = r.id
    INNER JOIN role_permission as rp ON r.id = rp.id_role
    INNER JOIN permission as p ON rp.id_permission = p.id
    WHERE u.email = '$email'";

  $result = mysqli_query($link, $sql_permission);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $_SESSION[$row['permission']] = $row['is_allowed'];
  }
?>