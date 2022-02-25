<?php include VIEWS_PATH . 'layouts/_header.view.php'; ?>

<main class="container">
    <?php include VIEWS_PATH . 'layouts/_nav.view.php'; ?>

    <div class="mt-5 mb-5">
        <div class="auth-logo mx-auto"></div>
    </div>

    <div class="auth-form">
        <div class="alert alert-danger mb-0 fade" role="alert">
            <p class="alert-text"></p>
        </div>

        <form id="auth-form" method="POST" autocomplete="off">
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="name" id="name" value="" placeholder="用户名" autocomplete="off" autofocus>
                <label for="name">用户名</label>
                <span id="nameHelp" class="form-text text-danger"></span>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="email" id="email" value="" placeholder="邮箱" autocomplete="off" required>
                <label for="email">邮箱</label>
                <span id="emailHelp" class="form-text text-danger"></span>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="密码" autocomplete="off" required>
                <label for="password">密码</label>
                <span id="passwordlHelp" class="form-text text-danger"></span>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" name="accept_terms" id="accept_terms" onchange="activateButton(this)">
                <label class="form-check-label" for="accept_terms">同意使用条款和隐私政策</label>
            </div>

            <div class="form-floating mb-3">
                <button type="button" class="btn btn-lg btn-secondary w-100" id="submitButton" disabled>
                    注册 <i class="icon iconfont icon-arrow-right"></i>
                </button>
            </div>
        </form>
        <p class="text-center">
            <a class="btn btn-link fs-16" href="login">登录</a>
        </p>
    </div>
</main>

<?php include VIEWS_PATH . 'layouts/_js.view.php'; ?>
<script src="/public/js/notie.min.js"></script>
<script>
    function activateButton(element) {
        if (element.checked) {
            document.getElementById("submitButton").disabled = false;
        } else {
            document.getElementById("submitButton").disabled = true;
        }
    };

    $(function() {
        let flagName = false;
        let flagEmail = false;
        let flagPassword = false;
        // let name, email, reg, password, submitButton;

        // 验证用户名
        $('#name').change(function() {
            let name = $('#name').val();
            if (name.length < 3) {
                $('#name').addClass('is-invalid');
                $('#nameHelp').text('请输入 3~16 位的用户名');
                flagName = false;
            } else {
                $('#name').removeClass('is-invalid');
                $('#nameHelp').text('');
                flagName = true;
            }
        });
        // 验证邮箱
        $('#email').change(function() {
            let email = $('#email').val();
            let reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            if (!reg.test(email)) {
                $('#email').addClass('is-invalid');
                $('#emailHelp').text('邮箱格式错误');
                flagEmail = false;
            } else {
                $('#email').removeClass('is-invalid');
                $('#emailHelp').text('');
                flagEmail = true;
            }
        });
        // 验证密码
        $('#password').change(function() {
            let password = $('#password').val();
            if (password.length < 3) {
                $('#password').addClass('is-invalid');
                $('#passwordlHelp').text('密码至少 6 位数');
                flagPassword = false;
            } else {
                $('#password').removeClass('is-invalid');
                $('#passwordlHelp').text('');
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

            if (!flagName) {
                $('#name').addClass('is-invalid');
                $('#nameHelp').text('请输入 3~16 位的用户名');
                return;
            }
            if (!flagEmail) {
                $('#email').addClass('is-invalid');
                $('#emailHelp').text('邮箱格式错误');
                return;
            }
            if (!flagPassword) {
                $('#password').addClass('is-invalid');
                $('#passwordlHelp').text('密码至少 6 位数');
                return;
            }

            // if (!flagCaptcha) {
            //     $('#captcha').addClass('is-invalid');
            //     return;
            // }

            let data = new FormData(document.getElementById('auth-form'));

            ajax('/register', data, function(res) {
                console.log(res.status);
                if (res.status === 'success') {
                    notie.alert({type: 1, text: res.message, time: 2})
                    setTimeout(function() {
                        location.href = '/user/home';
                    }, 1500);
                } else {
                    notie.alert({type: 3, text: res.message, time: 2})
                    $('#submitButton').html(submitButton);
                    // $('#captcha').attr('src', res.captcha);
                    // $('input[name="captcha"]').val('');
                }
            });
        });
    });
</script>
<?php include VIEWS_PATH . 'layouts/_footer.view.php'; ?>