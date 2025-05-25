<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🚀 Hello PHP Upstate!</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
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
            background-size: cover;
            opacity: 1;
            z-index: -1;
        }
    </style>
</head>
<body>
<img style="width:80%;" src="https://2025.phptek.io/assets/images/phptek-2025.svg" />
<p style="color:white;font-size: 4rem">Thanks for having me!</p>
<script>
    var duration = 100 * 1000;
    var animationEnd = Date.now() + duration;
    var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    var interval = setInterval(function() {
        var timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        var particleCount = 50 * (timeLeft / duration);
        // since particles fall down, start a bit higher than random
        confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } });
        confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } });
    }, 250);
</script>
</body>
</html>
