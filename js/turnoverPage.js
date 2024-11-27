
      // 总页数
      const PAGECOUNT = 22
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
          btn[0].style.backgroundColor = "rgba(110, 100, 100, 0.3)"
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
                  btn[1].style.color = "darkgray"
                  btn[1].disabled = true
                  book.style.transform = 'translateX(300px)'
              }
          }
      }
      init()
 