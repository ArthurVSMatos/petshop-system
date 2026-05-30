<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Clientes</title>
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
        
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alerta alerta-sucesso">
                <?php 
                    if ($_GET['sucesso'] == '1') echo "🚀 Cliente cadastrado com sucesso!";
                    if ($_GET['sucesso'] == 'edicao') echo "✏️ Cadastro do tutor atualizado com sucesso!";
                    if ($_GET['sucesso'] == 'delecao') echo "💥 Tutor removido do sistema!";
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro'])): ?>
            <div class="alerta alerta-erro">
                <?php 
                    if ($_GET['erro'] == 'cliente_nao_encontrado') echo "Erro: Tutor não foi encontrado.";
                    if ($_GET['erro'] == 'delecao') echo "Erro: Não é possível excluir um tutor que possui pets vinculados.";
                ?>
            </div>
        <?php endif; ?>

        <div class="header-main">
            <div>
                <h2 style="margin: 0; color: #2c3e50;">👥 Gerenciamento de Clientes</h2>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Visualize e gerencie os tutores cadastrados no sistema.</p>
            </div>
            <div>
                <a href="http://localhost/petshop-system/public/clientes/novo" class="btn btn-principal">+ Cadastrar Novo Cliente</a>
            </div>
        </div>

        <div class="tabela-card">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Ações</th> </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #7f8c8d; padding: 20px;">Nenhum cliente cadastrado ainda.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><strong><?php echo $cliente['nome']; ?></strong></td>
                                <td>
                                    <?php 
                                        // Remove pontos e traços para contar os números certinho
                                        $cpfNumeros = preg_replace('/[^0-9]/', '', $cliente['cpf']);
                                        // Se o CPF estiver completo com 11 números, mostra só o finalzinho
                                        $ultimosDigitos = (strlen($cpfNumeros) === 11) ? substr($cpfNumeros, -3) : '***';
                                        echo "***.***.***-" . $ultimosDigitos;
                                    ?>
                                </td>
                                <td><?php echo $cliente['telefone']; ?></td>
                                <td><?php echo $cliente['email']; ?></td>
                                <td><?php echo $cliente['endereco']; ?></td>
                                <td>
                                    <a href="http://localhost/petshop-system/public/clientes/editar/<?php echo $cliente['id_cliente']; ?>" class="btn-acao btn-editar">Editar</a>
                                    <a href="http://localhost/petshop-system/public/clientes/deletar/<?php echo $cliente['id_cliente']; ?>" class="btn-acao btn-deletar" onclick="return confirm('Tem certeza que deseja excluir o tutor <?php echo $cliente['nome']; ?>?\n\nAtenção: Se ele tiver pets cadastrados, o banco de dados pode impedir a exclusão por segurança.');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>