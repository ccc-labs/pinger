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
<div class="container text-center">
    <div><img src="/logo.png" width="150"></div>
    <div class="row" style="margin-top:30px">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Hosts</div>
                <div class="panel-body text-left" style="margin:0;padding:0">
                    <table class="table" style="margin:0;padding:0">
                        <tr>
                            <th>IP</th>
                            <th class="text-center">Packet Size</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php foreach( $data["hosts"] as $host ){ ?>
                        <tr>
                            <td><?php echo $host["ip"]; ?></td>
                            <td class="text-center"><?php echo $host["packet_size"]; ?></td>
                            <td class="text-center"><button class="btn btn-success btn-xs ping" data-id="<?php echo $host["id"]; ?>">Send Ping</button></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $('.ping').click( function(){
        $.getJSON('/api/ping?id=' + $(this).attr('data-id'),function(r){
            alert(r.result);
        }).fail(function(s){
            alert(s.responseJSON.error);
        });
    });
</script>
</body>
</html>