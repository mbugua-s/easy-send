<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <body>

       
            <div class="container w-75 p-1">
                <div class = "row no-pad">
                    <div class= "col-lg-3 ">
                        <img src="/profile_photos/dely.jpg" class="img-fluid" alt="">    
                    </div>
                    <div class="col-lg-7 px-1 pt-3 offset-1">
                        <h1 style="font-family: Roboto;" class="col-lg-11 text-center font-weight-bold py-1 ">Welcome</h1>

                <form method = 'POST' action = '/customer/register'>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <input type =  "text" placeholder="First Name" required class="form-control my-3 p-2" name="register_firstname">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <input type =  "text" placeholder="Last Name" required class="form-control my-3 p-2" name="register_lastname">           </div>
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">             
                    <input type =  "email" placeholder="Email Address" required class="form-control my-3 p-2" name="register_email">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <input type =  "password" placeholder="Password" required class="form-control my-3 p-2" name="register_password">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <input type =  "number" placeholder="Phone Number" required class="form-control my-3 p-2" name="register_number">
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <input type =  "text" placeholder="Your Address" required class="form-control my-3 p-2" name="register_location">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="offset-2 col-lg-7">
                    <button type = "submit" name = "register_submit" class="btn1 mt-2 mb-3" value = "REGISTER">Register</button>
                    </div>
                    </div>

                </form>

                    </div>

                </div>
            </div>


    </body>
        
        

<?= $this->endSection() ?>
