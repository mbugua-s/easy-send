<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Registration</h2>
    <form method = 'POST' action = '/customer/register'>
        
        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label class="order">First Name: </label>
        <input type = "text" name = "register_firstname">
        </div>
        </div>

        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label class="order">Last Name: </label>
        <input type = "text" name = "register_lastname">
        </div>
        </div>

        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label class="order">Email Address: </label>
        <input type = "email" name = "register_email">
        </div>
        </div>

        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label>Password: </label>
        <input type = "password" name = "register_password">
        </div>
        </div>

        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label>Phone Number: </label>
        <input type = "number" name = "register_number">
        </div>

        <div class="row justify-content-center">
        <div class="mb-3 col-4">
        <label>Your Address: </label>
        <input type = "text" name = "register_location">
        </div>
        </div>

        <div class="row justify-content-center">
        <div class="mb-3">
        <button type = "submit" name = "register_submit" class="btn btn-primary" value = "REGISTER">Register</button>
        </div>
        
    </form>

<?= $this->endSection() ?>
