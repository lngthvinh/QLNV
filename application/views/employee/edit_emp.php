<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form method="POST" action="<?php echo site_url('Employee/edit_action/'.$row["emp_id"]); ?>">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $row["fname"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $row["lname"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Job</label>
                            <input type="text" name="job" class="form-control" value="<?php echo $row["job"]; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="<?php echo base_url('Employee'); ?>" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>