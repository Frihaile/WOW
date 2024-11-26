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
     <title>Death And the Maiden</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/index.css">
     <style media="screen">
     *{box-sizing:border-box;}
     .banner{
       width:100%;
       height:auto;
       background:#f0d9e7;
     }
     .content{
       margin-top: 20px;
       width:100%;
       overflow:hidden;
     }
     :root {
            --w: 240px;
            --h: 240px;
        }

        #book {
            height: var(--h);
            position: relative;
            margin: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 1s;
            perspective: 1600px;
            transform-style: preserve-3d;
        }
        .book-cover {
            /* 封面比页面每条边宽25px */
            height: calc(var(--h) + 50px);
            width: calc(var(--w) + 50px);
            position: absolute;
            background-image: linear-gradient(to bottom, rgba(202,180,170,0.5),rgba(190,180,170,0.7));
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            transition: 1s;
            transform-origin: left;
            backface-visibility: visible;
            border: .5px solid #FFE4E1;
            overflow: hidden;
        }
        .book-page {
            height: var(--h);
            width: var(--w);
            position: absolute;
            z-index: 100;
            transition: 1s;
            /* 封面比页面每条边宽的长度 */
            transform-origin: -25px;
            background-size: cover;
            backface-visibility: visible;
        }

        #control {
            margin-top: 60px;
            user-select: none;
        }
        #control button {
            display: inline-block;
            width: 45px;
            height: 45px;
            border: 0;
            margin: 0px 15px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            border-radius:;
            background-color:#f0d9e7;
            outline: none;
        }
     </style>
     <link rel="stylesheet" href="css/excertps.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
   </head>

  <body class="body">
    <div class="banner">
      <h1 >Death And the Maiden</h1>
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

      <div id="book">
          <div class="book-cover one-page"><img src="img/death.jpg"></div>

          <div class="book-page one-page"><img src="img/death1.jpg"></div>
          <div class="book-page one-page"><img src="img/death2.jpg"></div>
          <div class="book-page one-page"><img src="img/death3.jpg"></div>
          <div class="book-page one-page"><img src="img/death4.jpg"></div>
          <div class="book-page one-page"><img src="img/death8.jpg"></div>
          <div class="book-page one-page"><img src="img/death6.jpg"></div>
          <div class="book-page one-page"><img src="img/death7.jpg"></div>
          <div class="book-page one-page"><img src="img/death9.jpg"></div>
          <div class="book-page one-page"><img src="img/death10.jpg"></div>
          <div class="book-page one-page"><img src="img/death11.jpg"></div>

          <div class="book-cover one-page"></div>
      </div>
      <div id="control">
          <button>&lt;</button>
          <button>&gt;</button>
      </div>

      <script>
          // 总页数
          const PAGECOUNT = 12
          // 当前页面编号
          let pageNo = 0

          // 内容页
          let pages = document.querySelectorAll('.book-page')
          // 封面页
          let cover = document.querySelectorAll('.book-cover')
          // 按钮
          let btn = document.querySelectorAll('#control button')
          //
          let book = document.querySelector('#book')
          // 所有页
          let allPages = document.querySelectorAll('.one-page')

          function init() {
              // 初始化内容页的图片
              for (let index = 0; index < pages.length; index++) {
                  pages[index].style.backgroundImage = "url('" + [index+1] + ".jpg')"
                  pages[index].style.zIndex = PAGECOUNT - index - 1
              }
              cover[0].style.zIndex = PAGECOUNT
              cover[1].style.zIndex = 1

              // 默认页面为封面，左按钮无效
              btn[0].style.backgroundColor = "rgba(110, 110, 110, 0.5)"
              btn[0].style.color = "darkgray"
              btn[0].disabled = true

              // 左翻页
              btn[0].onclick = function() {
                  pageNo --
                  // 如果当前是最后一页，并往前翻
                  if ((PAGECOUNT - 1) == pageNo) {
                      allPages[pageNo].style.transform = 'rotateY(0deg)'
                      //( 240px + 50px ) * 0.5
                      book.style.transform = 'translateX(145px)'
                      btn[1].style.backgroundColor = "rgba(63, 63, 63, 0.8)"
                      btn[1].style.color = "white"
                      btn[1].disabled = false
                  }
                  else {
                      allPages[pageNo].style.transform = 'rotateY(0deg)'
                  }
                  allPages[pageNo].style.zIndex = PAGECOUNT - pageNo

                  if( 0 == pageNo ) {
                      btn[0].style.backgroundColor = "rgba(110, 110, 110, 0.5)"
                      btn[0].style.color = "gray"
                      btn[0].disabled = true
                      book.style.transform = 'translateX(0px)'
                  }
              }

              // 右翻页
              btn[1].onclick = function() {
                  // 如果当前是第一页，并往后翻
                  if ( 0 == pageNo ) {
                      allPages[pageNo].style.transform = 'rotateY(-180deg)'
                      //( 240px + 50px ) * 0.5
                      book.style.transform = 'translateX(145px)'
                      btn[0].style.backgroundColor = "rgba(63, 63, 63, 0.8)"
                      btn[0].style.color = "white"
                      btn[0].disabled = false
                  }
                  else {
                      allPages[pageNo].style.transform = 'rotateY(-180deg)'
                  }

                  allPages[pageNo].style.zIndex = 1000 + pageNo
                  pageNo ++

                  if( PAGECOUNT == pageNo ) {
                      btn[1].style.backgroundColor = "rgba(110, 110, 110, 0.5)"
                      btn[1].style.color = "gray"
                      btn[1].disabled = true
                      book.style.transform = 'translateX(300px)'
                  }
              }
          }
          init()
      </script>

        <div class="boxnav"><em>
            <span>Synopsis:</span>
            <span>Elfriede Jelinek, 2004 wurde ihr der Nobelpreis für Literatur verliehen.</span>
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
