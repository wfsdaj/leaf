$(function () {
  // bootstrap tooltips
  $('[data-toggle="tooltip"]').tooltip();
  // 刷新页面
  $(".js-refresh").click(function () {
    location.reload();
  });
  // 后退，没有来源页面信息的时候，改成首页URL地址
  $(".js-back").click(function () {
    document.referrer === ""
      ? (window.location.href = "/")
      : window.history.back();
  });

  // 点击刷新验证码
  $("#resetCaptcha").click(function () {
    resetCaptcha();
  });
  // 刷新验证码
  function resetCaptcha() {
    $("#resetCaptcha").attr("src", "/index/captcha/" + Math.random());
  }

  // 回到页面顶部
  $(window).scroll(function () {
    if ($(window).scrollTop() > 150) {
      $("#js-toTop").show();
    } else {
      $("#js-toTop").hide();
    }
  });
  $("#js-toTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 300);
    return false;
  });

  // 上滑显示，下滑隐藏
  let windowTop = 0; // 初始话可视区域距离页面顶端的距离
  $(window).scroll(function () {
    let scrolls = $(this).scrollTop(); // 获取当前可视区域距离页面顶端的距离
    if (scrolls >= windowTop) {
      //当 scrolls>windowTop 时，表示页面在向下滑动
      $(".scrolled").removeClass("show");
      windowTop = scrolls;
    } else {
      // 显示导航条
      $(".scrolled").addClass("show");
      windowTop = scrolls;
    }
  });
});

// ajax提交数据
function ajax(url, params, callback = false) {
  $.ajax({
    url: url,
    type: "POST",
    data: params,
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function (get) {
      if (get.status === 'success') {
        notie.alert({ type: 1, text: get.message, time: 2 });
      }
      callback(get);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      error_post();
    },
  });
}

function error_post() {
  setTimeout(function () {
      notie.alert({ type: 3, text: "服务器忙, 请重试。", time: 2 });
  }, 500);
}