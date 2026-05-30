<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Gerenciamento de Pets</title>
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
            <div>
                <h2 style="margin: 0; color: #2c3e50;">🐶 Gerenciamento de Pets</h2>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Visualize e gerencie os animais cadastrados no sistema.</p>
            </div>
            <div>
                <a href="http://localhost/petshop-system/public/pets/novo" class="btn btn-principal">+ Cadastrar Novo Pet</a>
            </div>
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alerta alerta-sucesso">
                <?php
                    if ($_GET['sucesso'] == '1') echo "Pet cadastrado com sucesso!";
                    if ($_GET['sucesso'] == 'edicao') echo "Dados do pet atualizados com sucesso!";
                    if ($_GET['sucesso'] == 'delecao') echo "Pet removido do sistema!";
                ?>
            </div>
        <?php endif; ?>

        <div class="tabela-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Raça</th>
                        <th>Idade</th>
                        <th>Porte</th>
                        <th>Peso (kg)</th>
                        <th>Tutor / Dono</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pets)): ?>
                        <?php foreach ($pets as $pet): ?>
                            <tr>
                                <td><?php echo $pet['id_pet']; ?></td>
                                <td><strong><?php echo $pet['nome']; ?></strong></td>
                                <td><?php echo $pet['especie']; ?></td>
                                <td><?php echo $pet['raca']; ?></td>
                                <td><?php echo $pet['idade']; ?> anos</td>
                                <td><?php echo $pet['porte']; ?></td>
                                <td><?php echo number_format($pet['peso'], 2, ',', '.'); ?></td>
                                <td><?php echo basename($pet['dono_nome']); ?></td>
                                <td>
                                    <a href="http://localhost/petshop-system/public/pets/editar/<?php echo $pet['id_pet']; ?>" class="btn-acao btn-editar">Editar</a>
                                    <a href="http://localhost/petshop-system/public/pets/deletar/<?php echo $pet['id_pet']; ?>" class="btn-acao btn-deletar" onclick="return confirm('Tem certeza que deseja excluir o pet <?php echo $pet['nome']; ?>?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center; color: #7f8c8d; padding: 20px;">Nenhum pet cadastrado até o momento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>