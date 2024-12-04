<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .thank-you-container {
            max-width: 500px;
            background: #ffffff;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .checkmark-circle {
            width: 100px;
            height: 100px;
            position: relative;
            margin: 0 auto 2rem;
        }

        .checkmark {
            stroke: #4CAF50;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark-circle .circle {
            stroke: #4CAF50;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            animation: circle 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }

        @keyframes circle {
            100% { stroke-dashoffset: 0; }
        }

        .thank-you-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .thank-you-message {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #43A047;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }

        .footer {
            margin-top: 2rem;
            color: #a0aec0;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="thank-you-container">
        <div class="checkmark-circle">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="check" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>
        <h1 class="thank-you-title">Thank You for Voting!</h1>
        <p class="thank-you-message">Your vote has been successfully recorded. Thank you for participating in shaping our future.</p>
        <a href="login.php" class="btn btn-primary">Logout</a>
        <div class="footer">
            <p>© 2024 E-vote. All rights reserved.</p>
        </div>
    </div>
</body>
</html>