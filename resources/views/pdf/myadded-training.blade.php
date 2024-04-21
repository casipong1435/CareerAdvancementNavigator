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
            background: #579df8;
        }
        .employee_id{
            text-align: right;
            background: #579df8;
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
        <div class="enclosure"><i>Enclosure: A List of Added Training</i></div>
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
            <span>Outside Training Attended</span>
        </div>
        <div class="info">
            <div>
                <span>Employee ID: </span>
                <span>{{ $user_info->employee_id }}</span>
            </div>
            <div>
                <span>Name: </span>
                <span>{{ ucfirst($user_info->first_name).' '.ucfirst($user_info->last_name) }}</span>
            </div>
            <div>
                <span>Position: </span>
                <span>{{ $user_info->position }}</span>
            </div>
        </div>
        <table>
            <thead>
               <tr>
                    <th>Title of Training</th>
                    <th>Inclusive Dates of Attendance</th>
                    <th>Number of Hours</th>
                    <th>Type of LD</th>
                    <th>Source of Budget</th>
                    <th>Conducted By</th>
                    <th>Venue</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($added_training as $training)
                <tr>
                    <td>{{ $training->training_title }}</td>
                    <td>{{ $training->start_of_conduct.' - '.$training->end_of_conduct }}</td>
                    @if ($training->number_of_hours)
                        <td>{{ $training->number_of_hours }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if ($training->type_of_ld)
                        <td>{{ $training->type_of_ld }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if ($training->source_of_budget)
                        <td>{{ $training->source_of_budget }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if ($training->conducted_by)
                        <td>{{ $training->conducted_by }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    <td>{{ $training->venue }}</td>
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