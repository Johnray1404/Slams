<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - SLAMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/userStyles/homepage.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 20px;
        }

        .login-form {
            background-color: #8B0039;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-form h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #FFD700;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background-color: #fff;
            color: #4A154B;
            padding-right: 40px; 
        }

        .login-form input::placeholder {
            color: #999;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4A154B;
        }

        .login-form button {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: #FF5722;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .login-form button:hover {
            background-color: #E64A19;
        }

        .login-form p {
            margin-top: 20px;
            color: #D1C4E9;
        }

        .login-form p a {
            color: #FFD700;
            text-decoration: none;
        }

        .login-form p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-form {
                padding: 20px;
            }

            .login-form h2 {
                font-size: 28px;
            }

            .login-form input {
                font-size: 14px;
            }

            .login-form button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
    <div class="logo">
            <a href="/homepage" style="text-decoration: none;">
                <h1>SLAMS</h1>
            </a>
        </div>
        <nav class="nav">
            <a href="/login" class="login-btn">Log In</a>
            <a href="/signup" class="signup-btn">Sign Up</a>
        </nav>
    </header>
    <main class="login-container">
        <div class="login-form">
            <h2>Log In</h2>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <ul class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
                </div>
                <button type="submit">Log In</button>
            </form>
            <p>Don't have an account? <a href="/signup">Sign up</a></p>
        </div>
    </main>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.nextElementSibling;

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>