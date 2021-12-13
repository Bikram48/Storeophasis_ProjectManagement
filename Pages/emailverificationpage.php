<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/emailverification.css">
</head>

<body style="background-color:#000;">
<div class="line line-height line-colors-5"></div>
    <div style="width:30%;" class="box">
        <h1>Enter Verification Code</h1>

        <p>We just sent an email with a verification code. Enter that code below.</p>

        <form action="../backend/emailverificationbackend.php?mail&" method="GET">
            <div>
                <input type="text"  name="code" required="required">
                    <label>VERIFICATION CODE</label>
                    
                    </div>    
                <div>
            <div>
			<input class="btn" type="submit" name="submit">
		</div>
        </form>
    </div>
</body>
</html>