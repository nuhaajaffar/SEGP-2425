<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Dashboard</title>
    <style>

        .container{
            width: 1200px;
            min-width: 1200px;
            max-width: 100vw;
            margin:0 auto;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: white;
        }
        h2 {
            color: #6A5ACD;
            margin-left:10%;
        }
        .button {
            background-color: #f8caca;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-left:10%;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 40px;
            background-color: #fff;
            margin-left: 10%;
            border-radius: 10px;
           
            
        }
        th, td {
            border: 1px solid #ddd;
            padding: 18px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }

        col.id{
            width: 4%;
        }
        col.medical-specialist {
            width: 14%; 
        }

        col.hospital{
            width: 4%;
        }

        col.hospital-id{
            width: 14%;
        }

        col.activity{
            width: 15%;
        }
        col.patient-id{
            width: 12%;
        }

        @media (max-width:1366px){
            .container{
                width:95%;
                min-width:unset;

            }

            table{
                font-size:14px;

            }
            th,td{
                padding: 8px;
            }
        }
        tbody tr:hover {
    background-color: #d7d1d1; /* Light pink hover effect */
    transition: background-color 0.3s ease-in-out; /* Smooth transition */
}

      
    </style>
</head>
<body>
    <h2>Welcome back <strong>TERESA!</strong></h2>
    <button class="button">ACTIVITY</button>
    
    <table>
        <!-- Define column widths -->
        <colgroup>
            <col class="id">
            <col class="hospital-id">
            <col class="hospital">
            <col class="patient-id">
            <col class="activity">
            <col class="medical-specialist"> <!-- Making this column smaller -->
            <col>
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>ID</th>
                <th>HOSPITAL ID</th>
                <th>HOSPITAL</th>
                <th>PATIENT ID</th>
                <th>ACTIVITY</th>
                <th>MEDICAL SPECIALIST ID</th>
                <th>STATUS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0001</td>
                <td>20345683</td>
                <td>KPJ</td>
                <td>10000</td>
                <td>CONSULTATION</td>
                <td>30000</td>
                <td>COMPLETED</td>
                <td>17/11/2024</td>
            </tr>
            <tr>
                <td>0002</td>
                <td>20346584</td>
                <td>KPJ</td>
                <td>11000</td>
                <td>SCAN</td>
                <td>30001</td>
                <td>PENDING</td>
                <td>17/11/2024</td>
            </tr>
            <tr>
                <td>0003</td>
                <td>20445789</td>
                <td>SJMC</td>
                <td>12000</td>
                <td>REPORT</td>
                <td>30002</td>
                <td>PENDING</td>
                <td>17/11/2024</td>
            </tr>
            <tr>
                <td>0004</td>
                <td>20817346</td>
                <td>SJMC</td>
                <td>13000</td>
                <td>SCAN</td>
                <td>30003</td>
                <td>PENDING</td>
                <td>16/11/2024</td>
            </tr>
            <tr>
                <td>0005</td>
                <td>20297354</td>
                <td>SJMC</td>
                <td>14000</td>
                <td>CONSULTATION</td>
                <td>30004</td>
                <td>COMPLETED</td>
                <td>16/11/2024</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
