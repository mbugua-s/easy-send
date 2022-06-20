<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Log In</h2>

    <form method = 'POST' action = '/user/logIn'>
        <label>Email Address: </label>
        <input type = "email" name = "login_email">
        <label>Password: </label>
        <input type = "password" name = "login_password">

        <input type = "submit" name = "login_submit" value = "LOGIN">
    </form>
    
<?= $this->endSection() ?>

    
