<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Added Training</title>
    <style>
        body{
            margin: 1rem;
        }
        .title{
            text-align: center;
            font-style: italic;
            font-size: 16px;
            margin-bottom: 20px;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            
        }
        th,td{
            border: 1px solid black;
            padding: 5px;
            text-align: center
        }
        th{
            background: #d0eee4;
            font-size: 13px;
        }
        td{
            font-size: 13px;
        }
        .name{
            text-align: left;
            background: #f0e583;
        }
        .employee_id{
            text-align: left;
            background: #ffffff;
        }
        .header,
        .footer {
            width: 100%;
            position: fixed;
        }
        .header {
            top: 0px;
        }
        .footer {
            bottom: 0px;
            display: block;
        }
        .header-content{
            text-align: center;
        }
        .content{
            margin-top: 11rem;
        }
        .info{
            margin-bottom: 20px;
            font-weight: bold;
        }
        .deped{
            font-family: 'Algerian';
            font-size: 20px;
        }
        .footer-content{
            display: relative;
        }
        .deped-image{
            position: absolute;
        }
        .contact{
            position: absolute;
            left: 140px;
        }
        .matatag-image{
            margin-left: 530px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="assets/logo/depedlogo.png" width="70" height="70">
            <div class="republic">Republic of the Philippines</div>
            <div class="deped"><b>Department of Education</b></div>
            <div class="region">REGION X - NORTHERN MINDANAO</div>
            <div class="school"><b>SCHOOLS DIVISION OF OZAMIZ CITY</b></div>
        </div>
        <hr>
    </div>

    <div class="content">
        <div class="title">
            <span>Training Attendance</span>
        </div>
        <table>
            <tr>
                <th class="name">Title of Activity:</th>
                <th colspan="4" class="employee_id">{{ $training_info->training_title }}</th>
            </tr>
            <tr>
                <th class="name">Venue:</th>
                <th colspan="4" class="employee_id">{{ $training_info->venue }}</th>
            </tr>
            <tr>
                <th class="name">Date:</th>
                <th colspan="4" class="employee_id">{{ $from == $to ? $from:$from.' - '. $to}}</th>
            </tr>
            <thead>
               <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Position</th>
                    <th>District</th>
                    <th>School</th>
                    <th>Log time</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($user_attended as $attendance)
                @php
                    $i = 1;
                @endphp
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ ucfirst($attendance->first_name)." ".ucfirst($attendance->last_name) }}</td>
                    <td>{{ ucfirst($attendance->sex)  }}</td>
                    <td>{{ $attendance->position }}</td>
                    <td>{{ $attendance->district }}</td>
                    <td>{{ $attendance->school }}</td>
                    <td>{{ Carbon\Carbon::parse($attendance->logged_in)->format('d-M-Y  g:i A' ) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="deped-image">
                <img src="assets/logo/depedozamiz.png" width="70" height="70">
            </div>
            <div class="contact">
                <div>Address: IBJT Compound, Carangan, Ozamiz City</div>
                <div>Telephone: No: (088) 545-09-88</div>
                <div>Telefax: (088) 545-09-90</div>
                <div>Email Address: ozamiz.city@deped.gov.ph</div>
            </div>
            <div class="matatag-image">
                <img src="assets/logo/depedmatatag.png" width="170" height="90">
            </div>
        </div>
    </div>
    
</body>
</html>