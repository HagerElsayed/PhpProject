<?php ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <form class="form-horizontal">
            <br>
            <br>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>
            
            <div class="form-group">
                <label for="birthday" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="birthday" placeholder="Birthday">
                </div>
            </div>
            <div class="form-group">
                <label for="job" class="col-sm-2 control-label">Job</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="job" placeholder="Job">
                </div>
            </div>
            
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-4">
                    <input type="address" class="form-control" id="address" placeholder="Address">
                </div>
            </div>
            
            <div class="form-group">
                <label for="credit_limit" class="col-sm-2 control-label">Credit Limit</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="credit_limit" placeholder="Credit Limit">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
            
           
            
        </form>

    </body>
</html>