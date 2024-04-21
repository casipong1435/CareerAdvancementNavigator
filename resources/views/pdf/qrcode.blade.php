<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance QR Code</title>
</head>
<body>
    <h1 style="text-align: center">Attendance QR Code</h1>
    <div class="container d-flex justify-content-center align-items-center">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(route('downloadQR'))) !!} " width="700" height="700">
    </div>
</body>
</html>