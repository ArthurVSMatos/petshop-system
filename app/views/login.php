<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop System - Login</title>
    <link rel="stylesheet" href="/petshop-system/public/assets/css/style.css">

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