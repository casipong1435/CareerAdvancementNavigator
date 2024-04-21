<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List Report</title>
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
            <span>List of Employees</span>
        </div>
        <table>
            <thead>
               <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Position</th>
                    <th>Female</th>
               </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ ucfirst($employee->first_name).' '.ucfirst($employee->middle_name). ' '.ucfirst($employee->last_name) }}</td>
                    <td>{{ $employee->category }}</td>
                    <td>{{ $employee->position}}</td>
                    <td>{{ ucfirst($employee->sex)}}</td>
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