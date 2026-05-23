<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop System - Login</title>
    <style>
        /* Flexbox para centralizar tudo na tela (RNF02) */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #eef2f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }
        .login-container h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            color: #7f8c8d;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background-color: #2980b9;
        }
        .error-msg {
            color: #e74c3c;
            background-color: #fce4e4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>🐾 Petshop Login</h2>

        <?php if (isset($erro)): ?>
            <div class="error-msg"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="http://localhost/petshop-system/public/login/autenticar" method="POST">
            <div class="form-group">
                <label for="email">E-mail Corporativo</label>
                <input type="email" id="email" name="email" required placeholder="seu@email.com">
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">Entrar no Sistema</button>
        </form>
    </div>

</body>
</html>