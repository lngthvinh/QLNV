<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
  <div class="wrapper">
    Welcome <?php echo $this->session->userdata('username'); ?>
    <br>
    <?php echo anchor('Login/signout', 'Sign Out'); ?> 
  </div>
</body>
</html>