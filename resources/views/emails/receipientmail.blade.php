<!DOCTYPE html>
<html>
<head>
    <title>ScheManaJR</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Hello <b>{{ $mailData['body'] }}!<b></p>
  
    <p>Your job request has been reviewed by Finance and verified to have available funds. 
    <br>It will now be estimated and await funds clearance.
    </p>
    <br><br><br>
    Regards, <br><br>
    <b>{{ strtoupper(($mailData['personnel'][0]->name)) }}</b><br>
    Financial Division
     
</body>
</html>