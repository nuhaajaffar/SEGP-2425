<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            width: 30%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #d1b3ff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: white;
            margin: 0 auto 15px;
            position: relative;
        }

        .edit-icon {
            width: 24px; 
            height: 24px;
            position: absolute;
            bottom: 2px;
            right: 2px;
            background: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 4px;
            cursor: pointer;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .edit-icon svg {
            width: 14px;  
            height: 14px;
            fill: #6A5ACD; 
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-size: 14px;
            color: #6A5ACD;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 95%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: #f0f0f0;
        }

        input:read-only {
            background-color: #f0f0f0;
            border-color: #ddd;
            cursor: not-allowed;
        }

        input:focus {
            border-color: #6A5ACD;
            box-shadow: 0px 0px 8px rgba(106, 90, 205, 0.3);
            outline: none;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            width: 48%;
            transition: 0.3s;
        }

        .button.primary {
            background-color: #6A5ACD;
            color: white;
        }

        .button.primary:hover {
            background-color: #5a4dbb;
        }

        .button.secondary {
            background-color: #ddd;
            color: #333;
        }

        .button.secondary:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="profile-pic">
            👤
            <div class="edit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1.004 1.004 0 0 0-1.41 0L15.13 3.12l3.75 3.75 1.83-1.83z"/>
                </svg>
            </div>
        </div>

        <form onsubmit="return false;">
            <div class="input-group">
                <input type="text" placeholder="Enter your username" value="JohnDoe123" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your name" value="John Doe" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your IC" value="040111107234" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your address" value="Semenyih" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your hospital ID" value="KPJ103" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your role" value="Doctor" readonly>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Enter your contact" value="01223234213" readonly>
            </div>

            <div class="button-group">
                <button type="button" class="button secondary">Manage Account</button>
                <button type="button" class="button primary" id="edit-btn">Edit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('edit-btn').addEventListener('click', function() {
    let inputs = document.querySelectorAll('input');
    let isEditing = inputs[0].readOnly === false;

    if (isEditing) {
        inputs.forEach(input => {
            input.readOnly = true;
            input.style.backgroundColor = 'white'; // Change back to white when saved
        });
        this.textContent = 'Edit';
    } else {
        inputs.forEach(input => {
            input.readOnly = false;
            input.style.backgroundColor = '#e7e2ec'; // Change to grey when editing
        });
        this.textContent = 'Save';
    }
});

    </script>

</body>
</html>
