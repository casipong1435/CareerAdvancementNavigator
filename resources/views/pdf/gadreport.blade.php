<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GAD Report</title>
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
        th, .total{
            background: #ffd3e4;
            font-size: 13px;
            font-weight: bold;
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
            <span>GAD Report</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>GAD Activity</th>
                    <th>Date of Conduct</th>
                    <th>Number of Hours</th>
                    <th colspan="3">No. of Participants</th>
                    <th>Budget</th>
                    <th>Source of Budget</th>
                    <th>Responsible Unit</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_budget = 0;
                @endphp
                @foreach ($training_info as $training)
                    @php
                        $total_budget += $training->budget;
                    @endphp
    
                    <tr>
                        <td>{{ $training->training_title }}</td>
                        <td>{{ $training->start_of_conduct.' - '.$training->end_of_conduct }}</td>
                        <td>{{ $training->number_of_hours }} hours</td>
                        <td>{{ $training->male_count }}</td>
                        <td>{{ $training->female_count }}</td>
                        <td>{{ $training->attended_trainings_count }}</td>
                        <td>{{ $training->budget }}</td>
                        <td>GAD</td>
                        <td>{{ $training->responsible_unit }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="6" style="text-align: left">Total Budget Incurred for CY {{ $year }}</td>
                    <td>{{ $total_budget }}</td>
                    <td colspan="2"></td>
                </tr>
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