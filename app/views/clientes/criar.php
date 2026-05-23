<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente - Petshop System</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; display: flex; height: 100vh; background-color: #f4f6f9; }
        .sidebar { width: 260px; background-color: #2c3e50; color: white; display: flex; flex-direction: column; justify-content: space-between; }
        .sidebar-header { padding: 20px; text-align: center; background-color: #1a252f; font-size: 20px; font-weight: bold; }
        .menu { list-style: none; padding: 0; margin: 0; }
        .menu li a { display: block; padding: 15px 20px; color: #ecf0f1; text-decoration: none; }
        .menu li a:hover { background-color: #34495e; }
        .sidebar-footer { padding: 15px 20px; background-color: #1a252f; }
        .btn-sair { color: #e74c3c; text-decoration: none; font-weight: bold; }
        
        .main-content { flex-grow: 1; padding: 30px; overflow-y: auto; display: flex; justify-content: center; align-items: flex-start; }
        
        .form-container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); width: 100%; max-width: 600px; margin-top: 20px; }
        .form-container h2 { margin-top: 0; color: #2c3e50; border-bottom: 2px solid #f4f6f9; padding-bottom: 10px; margin-bottom: 20px;}
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #7f8c8d; font-weight: bold; font-size: 14px;}
        .form-group input { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; font-size: 14px;}
        .btn-submit { background-color: #3498db; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%; font-size: 16px; margin-top: 10px;}
        .btn-submit:hover { background-color: #2980b9; }
        .btn-voltar { display: inline-block; margin-bottom: 20px; color: #7f8c8d; text-decoration: none; font-weight: bold; font-size: 14px;}
        .btn-voltar:hover { color: #2c3e50; }
        .error-msg { background-color: #fce4e4; color: #e74c3c; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px;}
    </style>
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