<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome <?php echo $this->session->userdata('username'); ?>
    <br>
    <?php echo anchor('Login/logout', 'Logoutaa'); ?>
</body>
</html>