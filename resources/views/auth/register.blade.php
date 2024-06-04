<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Automobile Workshop Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/Car crash-amico (1).png'); /* Remplacez 'your-background-image.jpg' par le chemin de votre image de fond */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 800px;
            max-width: 90%;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #3e4da6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #110d90;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="form-title">Welcome to Automobile Workshop Management System</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input class="form-input" type="text" name="username" placeholder="Username" required>
            <input class="form-input" type="text" name="firstname" placeholder="First Name" required>
            <input class="form-input" type="text" name="lastname" placeholder="Last Name" required>
            <input class="form-input" type="email" name="email" placeholder="Email" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>
            <input class="form-input" type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <input class="form-input" type="text" name="address" placeholder="Address" required>
            <input class="form-input" type="tel" name="phone" placeholder="Phone Number" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>
