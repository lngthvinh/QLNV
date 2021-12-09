<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form method="POST" action="<?php echo site_url('Employee/add_action'); ?>">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Job</label>
                            <input type="text" name="job" class="form-control">
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