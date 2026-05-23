<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Clientes</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; display: flex; height: 100vh; background-color: #f4f6f9; }
        .sidebar { width: 260px; background-color: #2c3e50; color: white; display: flex; flex-direction: column; justify-content: space-between; }
        .sidebar-header { padding: 20px; text-align: center; background-color: #1a252f; font-size: 20px; font-weight: bold; }
        .menu { list-style: none; padding: 0; margin: 0; }
        .menu li a { display: block; padding: 15px 20px; color: #ecf0f1; text-decoration: none; }
        .menu li a:hover { background-color: #34495e; }
        .sidebar-footer { padding: 15px 20px; background-color: #1a252f; }
        .btn-sair { color: #e74c3c; text-decoration: none; font-weight: bold; }
        .main-content { flex-grow: 1; padding: 30px; overflow-y: auto; }
        .header-main { background-color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        
        /* Botão Novo Cliente */
        .btn-novo { background-color: #2ecc71; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; }
        .btn-novo:hover { background-color: #27ae60; }
        
        /* Tabela Estilizada */
        .table-container { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #2c3e50; }
        tr:hover { background-color: #f1f2f6; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
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
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert-success">🚀 Cliente cadastrado com sucesso!</div>
        <?php endif; ?>

        <div class="header-main">
            <div>
                <h2>👥 Gerenciamento de Clientes (Tutores)</h2>
                <p>Visualize e cadastre os donos dos pets.</p>
            </div>
            <a href="http://localhost/petshop-system/public/clientes/novo" class="btn-novo">+ Novo Cliente</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #7f8c8d;">Nenhum cliente cadastrado ainda.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><strong><?php echo $cliente['nome']; ?></strong></td>
                                <td><?php echo $cliente['cpf']; ?></td>
                                <td><?php echo $cliente['telefone']; ?></td>
                                <td><?php echo $cliente['email']; ?></td>
                                <td><?php echo $cliente['endereco']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>