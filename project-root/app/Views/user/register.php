<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasySend | Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method = 'POST' action = '/user/register'>
        <label>First Name: </label>
        <input type = "text" name = "register_firstname">
        <label>Last Name: </label>
        <input type = "text" name = "register_lastname">
        <label>Email Address: </label>
        <input type = "email" name = "register_email">
        <label>Phone Number: </label>
        <input type = "number" name = "register_number">
        <label>Your Address: </label>
        <input type = "text" name = "register_location">

        <input type = "submit" name = "register_submit" value = "REGISTER">
    </form>
</body>
</html>