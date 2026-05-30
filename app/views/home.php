<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop System - <?php echo $titulo; ?></title>
    <link rel="stylesheet" href="/petshop-system/public/assets/css/style.css">
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-header">🐾 Petshop Control</div>
            <ul class="menu">
                <li><a href="http://localhost/petshop-system/public/home">🏠 Dashboard</a></li>
                <li><a href="http://localhost/petshop-system/public/clientes">👥 Clientes (Tutores)</a></li>
                <li><a href="http://localhost/petshop-system/public/pets">🐶 Pets</a></li>
                <li><a href="#">📅 Agendamentos</a></li>
                <li><a href="#">🛒 Vendas / Estoque</a></li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <a href="http://localhost/petshop-system/public/login/sair" class="btn-sair">🚪 Sair do Sistema</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header-main">
            <h2><?php echo $titulo; ?></h2>
            <p><?php echo $mensagem; ?></p>
        </div>

        <div class="cards-container">
            <div class="card">
                <h3>Clientes</h3>
                <p>0 cadastrados</p>
            </div>
            <div class="card" style="border-top-color: #2ecc71;">
                <h3>Pets</h3>
                <p>0 cadastrados</p>
            </div>
            <div class="card" style="border-top-color: #f1c40f;">
                <h3>Agendamentos Hoje</h3>
                <p>0 pendentes</p>
            </div>
        </div>
    </div>

</body>
</html>