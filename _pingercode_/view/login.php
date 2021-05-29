<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pinger - Network Monitoring Tool</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center" style="margin-top:40px">
    <div><img src="/logo.png" width="300"></div>
    <div class="row" style="margin-top:30px">
        <div class="col-md-4 col-md-offset-4">
            <?php if( $data["error"] ){ ?>
            <div class="alert alert-danger text-center">
                <p><?php echo $data["error"]; ?></p>
            </div>
            <?php } ?>
            <form method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body text-left">
                        <div style="margin-top:7px"><label>Username:</label></div>
                        <div><input name="username" class="form-control"></div>
                        <div style="margin-top:7px"><label>Password:</label></div>
                        <div><input name="password" type="password" class="form-control"></div>
                        <div class="text-center" style="margin-top:10px"><input type="submit" class="btn btn-success" value="Login"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>