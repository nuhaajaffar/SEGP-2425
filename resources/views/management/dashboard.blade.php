<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .navigation a {
            color: black;
            text-decoration: none;
            margin: 0 15px;
        }
        .button {
            background-color: #dd6563;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-left:0.5%;
        }
        .button:hover {
            background: #ef9a9a;
        }
        .bttn {
            background-color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-left:0.5%;
        }        
        .bttn:hover {
            background: #ddd;
        }
        .container {
            margin: 4rem auto;
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #8174a0;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f5f6;
        }
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
            .navigation a {
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h2 class="logo">PIXELENCE</h2>
        <nav class="navigation">
            <a href="#">HOME</a>
            <a href="#">PATIENT</a>
            <a href="#">NOTIFICATIONS</a>
            <a href="#">LOGOUT</a>
            <a href="#">PROFILE</a>
        </nav> 
    </header>
    <div class="container">
        <h2 style="margin-top: 20px;">Welcome Back, SOPHIEA!</h2>
        <br>
        <button class="button">ACTIVITY</button>
        <bttn class="bttn">APPOINTMENTS</bttn>
        <bttn class="bttn">ADD PATIENT RECORD</bttn>
        <br>
        <table>
            <thead>
                <tr>
                    <th>HOSPITAL ID</th>
                    <th>HOSPITAL</th>
                    <th>NUMBER OF USERS</th>
                    <th>DOCTORS</th>
                    <th>RADIOLOGIST</th>
                    <th>RADIOGRAPHER</th>
                    <th>PATIENT</th>
                    <th>DATE ADDED</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>20345683</td>
                    <td>KPJ</td>
                    <td>--</td>
                    <td>10</td>
                    <td>2</td>
                    <td>2</td>
                    <td>14</td>
                    <td>17/11/2024</td>
                    <td>PENDING</td>
                </tr>
                <tr>
                    <td>20346584</td>
                    <td>GLENEAGLES</td>
                    <td>--</td>
                    <td>12</td>
                    <td>1</td>
                    <td>2</td>
                    <td>10</td>
                    <td>16/11/2024</td>
                    <td>PENDING</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
