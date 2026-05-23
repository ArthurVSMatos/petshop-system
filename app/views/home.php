<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop System - <?php echo $titulo; ?></title>
    <style>
        /* Layout Base com Flexbox (RNF02) */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f4f6f9;
        }

        /* Barra Lateral (Sidebar) */
        .sidebar {
            width: 260px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            background-color: #1a252f;
            font-size: 20px;
            font-weight: bold;
        }
        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }
        .menu li a {
            display: block;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background 0.3s;
        }
        .menu li a:hover {
            background-color: #34495e;
        }
        .sidebar-footer {
            padding: 15px 20px;
            background-color: #1a252f;
        }
        .btn-sair {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        /* Conteúdo Principal */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .header-main {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .cards-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-top: 4px solid #3498db;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-header">🐾 Petshop Control</div>
            <ul class="menu">
                <li><a href="http://localhost/petshop-system/public/home">🏠 Dashboard</a></li>
                <li><a href="#">👥 Clientes (Tutores)</a></li>
                <li><a href="#">🐶 Pets</a></li>
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