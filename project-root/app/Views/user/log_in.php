<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" type="text/css" href="/CSS/reg.css">
    <link rel="stylesheet" type="text/css" href="/CSS/styles.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
    
<body>
    <div class="container w-75 p-1">
        <div class = "row no-pad">
            <div class= "col-lg-3 ">
                <img src="/profile_photos/dely.jpg" class="img-fluid" alt="">    
            </div>
        <div class="col-lg-7 px-1 pt-3 offset-1">
        <h1 style="font-family: Roboto;" class="col-lg-11 text-center font-weight-bold py-1 ">Log In</h1>

    <form method = 'POST' action = '/user/logIn'>
        <div class="form-row">
            <div class="offset-2 col-lg-7">
                <input type = "email" placeholder="Email Address" required class="form-control my-3 p-2" name="login_email">
            </div>
        </div>

        <div class="form-row">
            <div class="offset-2 col-lg-7">
                <input type = "password" placeholder="Password" required class="form-control my-3 p-2" name="login_password">
            </div>
        </div>

        <div class="form-row">
            <div class="offset-2 col-lg-7">
                <button type = "submit" name = "login_submit" class="btn1 mt-2 mb-3" value = "LOGIN">Login</button>
            </div>
        </div>

    </form>
        </div>
        </div>
    </div>
</body>
    
<?= $this->endSection() ?>

    
