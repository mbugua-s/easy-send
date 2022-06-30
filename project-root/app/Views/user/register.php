<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Register Page</h2>
    <form method = 'POST' action = '/customer/register'>
        <label>First Name: </label>
        <input type = "text" name = "register_firstname">
        <label>Last Name: </label>
        <input type = "text" name = "register_lastname">
        <label>Email Address: </label>
        <input type = "email" name = "register_email">
        <label>Password: </label>
        <input type = "password" name = "register_password">
        <label>Phone Number: </label>
        <input type = "number" name = "register_number">
        <label>Your Address: </label>
        <input type = "text" name = "register_location">

        <input type = "submit" name = "register_submit" value = "REGISTER">
    </form>

<?= $this->endSection() ?>
