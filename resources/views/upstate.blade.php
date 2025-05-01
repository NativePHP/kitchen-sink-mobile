<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🚀 Hello PHP Upstate!</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: #000;
            overflow: hidden;
            text-align: center;
            padding:2rem;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        p {
            font-size: 2rem;
        }
        .rocket {
            font-size: 5rem;
            animation: float 2s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .confetti {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: url('https://i.pinimg.com/originals/e5/83/3e/e5833e1bea7d379f0f4e4ae250b7cf81.gif');
            background-size: cover;
            opacity: 1;
            z-index: -1;
        }
    </style>
</head>
<body>
<div class="confetti"></div>
<div class="rocket">🚀</div>
<h1>Hello PHP Upstate!</h1>
<img style="width:30%;" src="https://upstatephp.com/logo.svg" />
<p>Laravel is ALIIIIVE inside your app 🎉</p>
</body>
</html>
