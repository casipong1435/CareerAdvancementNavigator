<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conducted Training Report</title>
    <style>
        @font-face {
            font-family: 'Algerian';
            font-weight: normal;
            font-style: normal;
            src: url("../assets/font/Algerian.ttf") format("truetype");
        }
        body{
            margin: 1rem;
        }
        .title{
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: bold;
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
        .eclosure{
            text-align: left;
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
        <div class="enclosure"><i>Enclosure: A List of Participants</i></div>
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
            <span>LIST OF PARTICIPANTS</span>
        </div>
        <div class="info">
            <div>
                <span>Activity: </span>
                <span>{{ $training_info->training_title }}</span>
            </div>
            <div>
                <span>Venue: </span>
                <span>{{ $training_info->venue }}</span>
            </div>
            <div>
                <span>Date: </span>
                <span>{{ $training_info->start_of_conduct.' - '.$training_info->end_of_conduct }}</span>
            </div>
        </div>
        <table cellpadding="2" >
            <thead>
                <th>#</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Position</th>
                <th>District</th>
            </thead>
            <tbody>
                <?php $j = 1; ?>
                @foreach ($user_attended as $participant)
                <tr>
                    <td data-label="ID">{{ $j++ }}</td>
                    <td data-label="Employee ID">{{ $participant->employee_id }}</td>
                    <td data-label="Name">{{ ucfirst($participant->first_name)." ".ucfirst($participant->last_name) }}</td>
                    <td data-label="Sex">{{ ucfirst($participant->sex) }}</td>
                    <td data-label="Age">{{ ucfirst($participant->age) }}</td>
                    <td data-label="Position">{{ ucfirst($participant->position) }}</td>
                    <td data-label="District">{{ ucfirst($participant->district) }}</td>
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