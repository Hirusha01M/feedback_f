<?php

$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root';
$password = '';


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedbackSubmitted = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $feedback = $conn->real_escape_string($feedback);


    $sql = "INSERT INTO feedbacks (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        $feedbackSubmitted = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: sans-serif;
            background-image: url('abc.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            color: #fff;
            text-align: left;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
            width: 300px;
            margin-right: 40px;
        }

        h2 {
            text-align: center;
            color: whitesmoke;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 300px;
            height: 20px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="button"] {
            width: 48%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="button"] {
            background-color: #f44336;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="button"]:hover {
            background-color: #d32f2f;
        }

        .modal {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, 0);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            color: white;
            text-align: top;
            width: 100px;
            height: px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        .modal.show {
            display: block;
        }


        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="form-container">
             <h2>test</h2> 
            <h3>Feedback</h3> <br>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="feedback">Feedback:</label>
                <textarea name="feedback" id="feedback" required></textarea>

                <div class="button-container">

                    <input type="submit" value="Submit">


                    <input type="button" value="Clear" onclick="document.getElementById('name').value='';document.getElementById('email').value='';document.getElementById('feedback').value='';">
                </div>
            </form>
        </div>



    </div>

    <div id="successModal" class="modal">
        <p>successfully!</p>
    </div>

    <script>
        <?php if ($feedbackSubmitted): ?>
            document.getElementById('successModal').classList.add('show');
            setTimeout(function() {
                document.getElementById('successModal').classList.remove('show');
            }, 3000);
        <?php endif; ?>
    </script>

</body>

</html>