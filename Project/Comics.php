<?php

session_start();

if(isset($_SESSION["user_id"])){
  $mysqli = require __DIR__ ."/database.php";
  $sql = "SELECT * FROM user
          where id = {$_SESSION["user_id"]}";
  $result =  $mysqli -> query ($sql);
  $user = $result -> fetch_assoc();
}
 ?>

 <!--index.html file-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Comics</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style media="screen">
  *{box-sizing:border-box;}
  .banner{
    width:100%;
    height:auto;
    background:rgba(223,204,255,0.6);
  }
  .content{
    margin-top: 20px;
    width:auto;
    height: auto;
    overflow:;
  }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
  <link rel="stylesheet" href="css/comic.css">
</head>

  <body class="body">
    <div class="banner">
      <h1 >COMIC</h1>
    </div>

    <?php if (isset($user)): ?>
        <p>Hello <?= htmlspecialchars($user["name"])?> <small>^^</small>!</p>
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p><a href="login.php">login in</a>
          or <a href="signup.html">sign up<a>.</p>
    <?php endif; ?>
    <!--change the CSS of this division!!!-->
    <div>

      <div class="">
        <div class="boxmain">
          <ul class="slides">
            <input type="radio" id="control-1" name="control" checked>
            <input type="radio" id="control-2" name="control">
            <input type="radio" id="control-3" name="control">

            <!--  Left/Right Button  -->
            <div class="navigator slide-1">
              <label for="control-3">
                <i class="fas fa-chevron-left"></i>
              </label>
              <label for="control-2">
                <i class="fas fa-chevron-right"></i>
              </label>
            </div>

            <div class="navigator slide-2">
              <label for="control-1">
                <i class="fas fa-chevron-left"></i>
              </label>
              <label for="control-3">
                <i class="fas fa-chevron-right"></i>
              </label>
            </div>

            <div class="navigator slide-3">
              <label for="control-2">
                <i class="fas fa-chevron-left"></i>
              </label>
              <label for="control-1">
                <i class="fas fa-chevron-right"></i>
              </label>
            </div>
            <!--  /Left/Right Button  -->

            <li class="slide"><img = src="img/car.png"></li>
            <li class="slide"><img = src="img/tree.png"></li>
            <li class="slide"><img = src="img/dusk.png"></li>

            <div class="controls-visible">
              <label for="control-1"></label>
              <label for="control-2"></label>
              <label for="control-3"></label>
            </div>
          </ul>
          <!-- partial -->
          <div><center><h3 style="color:black;">PRESALE</h3></center></div>
        </div>
      </div>


        <div class="boxnav"><em>
            <span>Synopsis:</span>
            <span>Probably can't wait for release day, just for everyone to see.</span>
            <span><a href="index.php"><?php echo"&nbsp;&nbsp;"; ?>HOME</a></span>
        </div>
    </div>

        <br><br>
        <div class="footer">
        <footer>
        &copy;Yokada
        </footer>
        </div>



  </body>
</html>
