<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="<?= base_url() ?>assets/images/background.jpg" alt="">
                <div class="text">
                    <span class="text-1">E-Loker <br> Perpustakaan</span>
                    <span class="text-2">Universitas Maritim Raja Ali Haji</span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="<?= base_url() ?>images/bg_login.jpg" alt="">
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                    <form action="<?= base_url("auth/login") ?>" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your username" maxlength="16" name="username" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" maxlength="16" name="password" required>
                            </div>
                          
                            <!-- If login failed -->
                            <?php if(isset($this->session->error)): ?>
                                <span class="text-danger my-2" style="color:crimson"><?= $this->session->error ?></span>
                            <?php endif ?>

                            <div class="button input-box">
                                <input type="submit" value="Login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>