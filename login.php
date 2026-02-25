<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
        }

        .login-box {
            background: #fff;
            padding: 40px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2e59d9;
        }

        .error {
            background: #ffe0e0;
            color: #b30000;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <div class="login-box">
        <h2>Login Admin</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error">
                Username atau Password salah!
            </div>
        <?php endif; ?>

        <form method="POST" action="proses_login.php">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>