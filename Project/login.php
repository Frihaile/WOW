<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"]==="POST") {
  $mysqli = require __DIR__ . "/database.php";
  $sql = sprintf("SELECT * FROM user
         WHERE email = '%s'",
         $mysqli -> real_escape_string($_POST["email"]));
  $result = $mysqli ->query($sql);
  $user = $result -> fetch_assoc();
  if ($user) {
    if (password_verify($_POST["password"],$user["password_hash"])) {
      session_start();
      session_regenerate_id();//avoid session fixation attack
      $_SESSION["user_id"] = $user["id"];
      header("Location:index.php");
      exit;
    }
  }
    $is_invalid = true;
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <style media="screen">
    .banner{
      width:100%;
      height:auto;
      background:#E4E997;
    }
    .loginform{
      display:inline-block;
      width:100%;
      height:auto;
      background:#CCCCFF;
      margin-top:10px;
      padding-left:;
      padding-top:6%;
      padding-bottom:6%;
      border-radius:10px 10px;
    }
    </style>
  </head>
  <body>
    <?php if($is_invalid): ?>
      <em>Invalid login.</em>
    <?php endif; ?>

    <div class="banner"><h1>Login</h1></div>
    <a href="signup.html">< Signup</a>

    <div class="loginform">
      <center>
      <form class="" action="" method="post" novalidate>

        <div class="">
          <label for="email">Email</label>
          <input type="email"  id="email" name="email"
          value="<?= htmlspecialchars($_POST["email"] ?? "")?>">
          <!--keep email exists after input-->
        </div>

        <div class="">
          <label for="password">Password</label>
          <input type="password"  id="password" name="password">
        </div>

        <br><button type="submit" name="">Login in</button>
      </form>
      </center>
    </div>
  </body>
</html>
