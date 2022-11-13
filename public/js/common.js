//スクロールアニメーション
wow = new WOW();
wow.init();

//imgタグをsvg化
/*window.addEventListener('load', function () {
  deSVG('.svg', true);
});*/

//アンカーリンク スムーススクロール
$(function () {
  $('a[href^="#"]').not('.systemTab .js-systemTab').click(function () {
    var speed = 300;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top - 100;
    $("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });
});

//topに戻るボタン
$(document).ready(function () {
  var showFlag = false;
  var topBtn = $('.js_backtop');
  (topBtn).css('opacity', '0');
  var showFlag = false;

  $(window).scroll(function () {
    if ($(this).scrollTop() > 10) {
      if (showFlag == false) {
        showFlag = true;
        topBtn.stop().animate({ 'opacity': '1' }, 500);
      }
    } else {
      if (showFlag) {
        showFlag = false;
        topBtn.stop().animate({ 'opacity': '0' }, 500);
      }
    }
  });

  topBtn.click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });
  $('.js_backtop').click(function () {
    $('html,body').animate({
      scrollTop: 0
    }, 400);
    return false;
  });
});

/* アコーディオン */
$(function () {
  var acBtn = $('.js-accordionBtn');
  acBtn.on('click', function () {
    $(this).next().slideToggle(200);
    $(this).toggleClass('open', 200);
  });
});

/* moreボタン */
$(function () {
  var acBtn = $('.js-moreBtn');
  acBtn.on('click', function () {
    $(this).prev().slideToggle(200);
    $(this).toggleClass('open', 200);
  });
});

// ハンバーガーメニュー
$(function () {

  var $hamburger_btn = $('#js-hamburger-btn');
  var $navin = $('#js-hamburger-gnav ');
  var $search_btn = $('#js-search-btn');
  var $nav2in = $('#js-search-gnav');
  var $open = 'open'; // class
  var $close = $('a[href^="#"]');
  var $body = $('.js-body');

  $hamburger_btn.on('click', function () {
    if (!$hamburger_btn.hasClass($open)) {
      $hamburger_btn.addClass($open);
      $navin.addClass($open);
      $body.addClass($open);
      $search_btn.removeClass($open);
      $nav2in.removeClass($open);
    } else {
      $hamburger_btn.removeClass($open);
      $navin.removeClass($open);
      $body.removeClass($open);
    }
  });
  $close.on('click', function () {
    $hamburger_btn.removeClass($open);
    $navin.removeClass($open);
    $body.removeClass($open);
  });

});

//swiper 必要なら設置
$(function () {
  if ($(".js-swiper-top").length) {
    let swiper = new Swiper('.js-swiper-top', {
      // 以下にオプションを設定
      loop: true, //最後に達したら先頭に戻る
      centeredSlides: true,
      slidesPerView: 1.5,
      spaceBetween: 20,
      autoplay: {
        delay: 2000,
      },

      //ページネーション表示の設定
      /*pagination: {
        el: '.swiper-pagination', //ページネーションの要素
        type: 'bullets', //ページネーションの種類
        clickable: true, //クリックに反応させる
      },
  
      //ナビゲーションボタン（矢印）表示の設定
      navigation: {
        nextEl: '.swiper-button-next', //「次へボタン」要素の指定
        prevEl: '.swiper-button-prev', //「前へボタン」要素の指定
      },
  
      //スクロールバー表示の設定
      scrollbar: {
        el: '.swiper-scrollbar', //要素の指定
      },*/
    })
  }

});

//読み込みアニメ
$(function () {
  $('.topHero__title .fst').addClass('is-show');

  $('.topHero__title .sec').delay(1000).queue(function () {
    $(this).addClass('is-show');
  })
});

//スクロールアニメ
$(function () {

  function adAnime() {
    $('.js-anime').each(function () {
      var elemPos = $(this).offset().top + 150;
      var scroll = $(window).scrollTop();
      var windowheight = $(window).height();
      if (scroll >= elemPos - windowheight) {
        $(this).addClass('is-anime');
      } else {
        //$(this).removeClass('is-anime');
      }
    });
  }
  $(window).scroll(function () {
    adAnime();
  });
  /*$(window).on('load', function(){
    adAnime();
  });*/

});

//タグ内テキスト分割
$(function () {

  var element = $(".js-slitTxt");

  element.each(function () {
    var text = $(this).text();
    var textbox = "";
    text.split('').forEach(function (t, i) {
      if (t !== " ") {
        if (i < 10) {
          textbox += '<span style="animation-delay:.' + i + 's;">' + t + '</span>';
        } else {
          var n = i / 10;
          textbox += '<span style="animation-delay:' + n + 's;">' + t + '</span>';
        }
      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);

  });

});

//グローバルメニューをスクロールに合わせて追従
$(function () {
  var $naviItem = $('#js-hamburger-gnav ul li');
  var $boxItem = $('.js-navSection');
  var $naviNum = $naviItem.length;

  var $naviItemElm = new Array();
  var $boxItemElm = new Array();
  var $itemKey = new Array();
  var $boxKey = new Array();
  var $distance = new Array();
  var $height = new Array();
  var $endPoint = new Array();

  $(window).on('load scroll', function () {
    if ($boxItem.length) {
    $scrollTopDistance = $(window).scrollTop();

    for (var a = 0; a < $naviNum; a++) {
      $naviItemElm[a] = $naviItem.eq(a);
      $boxItemElm[a] = $boxItem.eq(a);
      
      $itemKey[a] = $naviItemElm[a].find('a').attr('href').replace(/#/g, "");
      $boxKey[a] = $boxItemElm[a].attr('id');
      if ($boxItemElm[a].length) {
      $distance[a] = $boxItemElm[a].offset().top - 180;
      }
      $height[a] = $boxItemElm[a].outerHeight();
      $endPoint[a] = $distance[a] + $height[a];

      if ($itemKey[a] == $boxKey[a] && $scrollTopDistance > $distance[a] && $scrollTopDistance < $endPoint[a]) {
        $naviItem.eq(a).addClass('is-now');
      } else if ($scrollTopDistance < $distance[a] || $scrollTopDistance > $endPoint[a]) {
        $naviItem.eq(a).removeClass('is-now');
      }
    }
  }
  });
});