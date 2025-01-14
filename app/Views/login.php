<div class="container">
    <div class="split left"
        style="background: url('<?= base_url('img/' . esc($setting['iconlogin']) . '?' . time()) ?>') no-repeat center center/cover;">
    </div>
    <div class="split right">
        <div class="login-box">
            <!-- Nama Website -->
            <h1 class="app-title"><?= esc($setting['namawebsite']) ?></h1>

            <!-- Login text -->
            <p class="login-text">Login</p>

            <!-- Display error message if login fails -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message" style="color: red; text-align: center;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" action="<?= base_url('home/aksi_login') ?>" method="post">
                <?= csrf_field() ?> <!-- Menambahkan token CSRF -->

                <div class="user-box">
                    <input required name="username" type="text" value="<?= old('username') ?>">
                    <label>Username</label>
                </div>

                <div class="user-box">
                    <input required name="password" type="password">
                    <label>Password</label>
                </div>

                <!-- Tombol Submit -->
                <a href="javascript:void(0)" onclick="document.getElementById('loginForm').submit()">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </a>
            </form>

            <p>Don't have an account?
                <strong>MAKANYA MINTA ADMIN!</strong>
            </p>
        </div>
    </div>
</div>


<style>
    .login-box {
        width: 400px;
        padding: 40px;
        background: rgba(0, 0, 0, 0.9);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
        border-radius: 10px;
        text-align: center;
    }

    /* New styling for the app title */
    .app-title {
        font-size: 2rem;
        color: #fff;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .login-box p:first-child {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .login-box .user-box {
        position: relative;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: 0.5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
        top: -20px;
        left: 0;
        color: #fff;
        font-size: 12px;
    }

    .login-box form a {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        font-weight: bold;
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: 0.5s;
        margin-top: 40px;
        letter-spacing: 3px;
    }

    .login-box a:hover {
        background: #fff;
        color: #272727;
        border-radius: 5px;
    }

    .login-box a span {
        position: absolute;
        display: block;
    }

    .login-box a span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #fff);
        animation: btn-anim1 1.5s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    .login-box a span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #fff);
        animation: btn-anim2 1.5s linear infinite;
        animation-delay: 0.375s;
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }

        50%,
        100% {
            top: 100%;
        }
    }

    .login-box a span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, #fff);
        animation: btn-anim3 1.5s linear infinite;
        animation-delay: 0.75s;
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }

        50%,
        100% {
            right: 100%;
        }
    }

    .login-box a span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #fff);
        animation: btn-anim4 1.5s linear infinite;
        animation-delay: 1.125s;
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }

        50%,
        100% {
            bottom: 100%;
        }
    }

    .login-box p:last-child {
        color: #aaa;
        font-size: 14px;
    }

    .login-box a.a2 {
        color: #fff;
        text-decoration: none;
    }

    .login-box a.a2:hover {
        background: transparent;
        color: #aaa;
        border-radius: 5px;
    }

    body,
    html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        display: flex;
    }

    .container {
        display: flex;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }

    /* Split the container into two sections */
    .split {
        width: 50%;
        height: 100%;
    }

    /* Right Section with Login Box */
    .split.right {
        background-color: #111111;
        background-image: linear-gradient(32deg, rgba(8, 8, 8, 0.74) 30px, transparent);
        background-size: 60px 60px;
        background-position: -5px -5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-text {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 0 30px;
    }
</style>