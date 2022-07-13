<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" type="text/css" href="/CSS/reg.css">
    <link rel="stylesheet" type="text/css" href="/CSS/styles.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
    <h2>Register</h2>
    <form method = 'POST' action = '/deliveryperson/register' enctype = "multipart/form-data">
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
        <label>Your Profile Photo: </label>
        <input type = "file" name = "register_photo">
        <label>Your City of Operation: </label>
        <input type = "text" name = "register_city">

        <input type = "submit" name = "register_submit" value = "REGISTER">
    </form>

<?= $this->endSection() ?>
