<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign In</h2>
        <p>Please fill in your credentials to login.</p>

        <?php echo isset($error) ? $error : ''; ?>

        <form method="POST" action="<?php echo site_url('Login/signin_action'); ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Sign In">
            </div>
            <p>Don't have an account? <?php echo anchor('Login/signup', 'Sign Up'); ?>.</p>
        </form>
    </div>
</body>
</html>