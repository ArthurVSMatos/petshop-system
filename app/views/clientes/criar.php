<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente - Petshop System</title>
    <link rel="stylesheet" href="/petshop-system/public/assets/css/style.css">
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-header">🐾 Petshop Control</div>
            <ul class="menu">
                <li><a href="http://localhost/petshop-system/public/home">🏠 Dashboard</a></li>
                <li><a href="http://localhost/petshop-system/public/clientes">👥 Clientes (Tutores)</a></li>
                <li><a href="#">🐶 Pets</a></li>
                <li><a href="#">📅 Agendamentos</a></li>
                <li><a href="#">🛒 Vendas / Estoque</a></li>
            </ul>
        </div>
        <div class="sidebar-footer"><a href="http://localhost/petshop-system/public/login/sair" class="btn-sair">🚪 Sair do Sistema</a></div>
    </div>

    <div class="main-content">
        <div class="form-container">
            <a href="http://localhost/petshop-system/public/clientes" class="btn-voltar">← Voltar para a lista</a>
            
            <h2>Cadastro de Novo Cliente</h2>

            <?php if (isset($erro)): ?>
                <div class="error-msg"><?php echo $erro; ?></div>
            <?php endif; ?>

            <form action="http://localhost/petshop-system/public/clientes/salvar" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: João da Silva">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" required placeholder="000.000.000-00">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone / WhatsApp</label>
                    <input type="text" id="telefone" name="telefone" required placeholder="(00) 00000-0000">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="joao@email.com">
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço Completo</label>
                    <input type="text" id="endereco" name="endereco" required placeholder="Rua, Número, Bairro, Cidade">
                </div>

                <button type="submit" class="btn-submit">Salvar Cliente</button>
            </form>
        </div>
    </div>

</body>
</html>