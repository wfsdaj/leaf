<?php include VIEWS_PATH . 'layouts/_header.view.php'; ?>

<main class="container">
    <?php include VIEWS_PATH . 'layouts/_nav.view.php'; ?>

    <div class="mt-5 mb-5">
        <div class="auth-logo mx-auto">
            LOGO
        </div>
    </div>

    <div class="auth-form">
        <form id="auth-form" method="POST" autocomplete="off">
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="username" id="username" value="" placeholder="用户名" autocomplete="off" autofocus>
                <label class="form-label" for="username">用户名</label>
                <small id="usernameHelp" class="form-text text-danger"></small>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="密码" autocomplete="off">
                <label class="form-label" for="password">密码</label>
                <small id="passwordHelp" class="form-text text-danger"></small>
            </div>

            <div class="d-flex mb-4">
                <button type="button" class="btn btn-lg btn-secondary w-100" id="submitButton">登录
                    <i class="icon iconfont icon-arrow-right"></i>
                </button>
            </div>
        </form>

        <p class="text-center">
            <a class="btn btn-link fs-16" href="register">免费注册</a>
        </p>

        <div class="divider">
            <span>使用其他账号登录</span>
        </div>
    </div>
</main>

<?php include VIEWS_PATH . 'layouts/_js.view.php'; ?>
<script src="/public/js/notie.min.js"></script>
<script>
    $(function() {
        let flagName = false;
        let flagPassword = false;
        let username, password, submitButton;

        // 验证用户名/邮箱
        $('#username').change(function() {
            let username = $('#username').val();
            if (username.length < 3) {
                $('#username').addClass('is-invalid');
                $('#usernameHelp').text('请输入 3~16 位的用户名');
                flagusername = false;
            } else {
                $('#username').removeClass('is-invalid');
                $('#usernameHelp').text('');
                flagName = true;
            }
        });
        // 验证密码
        $('#password').change(function() {
            let password = $('#password').val();
            if (password.length < 6) {
                $('#password').addClass('is-invalid');
                $('#passwordHelp').text('密码至少 6 位数');
                flagPassword = false;
            } else {
                $('#password').removeClass('is-invalid');
                $('#passwordHelp').text('');
                flagPassword = true;
            }
        });
        // 验证验证码
        // $('#captcha').change(function() {
        //     captcha = $('#captcha').val();
        //     if (captcha.length < 5) {
        //         $('#captcha').addClass('is-invalid');
        //         flagcaptcha = false;
        //     } else {
        //         $('#captcha').removeClass('is-invalid');
        //         flagCaptcha = true;
        //     }
        // });

        submitButton = $('#submitButton').html();
        // 点击注册按钮后验证
        $('#submitButton').click(function() {
            submitButton = $('#submitButton').html();
            if ($('#submitButton').html() != submitButton) {
                return false;
            }

            if (!flagName) {
                $('#username').addClass('is-invalid');
                $('#usernameHelp').text('请输入 3~16 位的用户名');
                return;
            }

            if (!flagPassword) {
                $('#password').addClass('is-invalid');
                $('#passwordHelp').text('请输入 6 位数及以上的密码');
                return;
            }

            // if (!flagCaptcha) {
            //     $('#captcha').addClass('is-invalid');
            //     return;
            // }

            let data = new FormData(document.getElementById('auth-form'));

            ajax('/login', data, function(res) {
                console.log(res.message);
                if (res.status == 'success') {
                    notie.alert({type: 1, text: res.message, time: 2})
                    setTimeout(function() {
                        location.href = '/';
                    }, 1500);
                } else {
                    notie.alert({type: 3, text: res.message, time: 2})
                    $('#submitButton').html(submitButton);
                }
            });
        });
    });
</script>
<?php include VIEWS_PATH . 'layouts/_footer.view.php'; ?>