<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP List</title>
</head>
<body>
    <table>
        @foreach ($otp_list as $otp)
            <tr>
                <td>{{ $otp->otp }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>