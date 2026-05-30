<?php
// Garantia de extração das variáveis enviadas pelo Controller
if (isset($data)) extract($data);
if (isset($dados)) extract($dados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Editar Cliente</title>
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
            <h2 style="margin: 0; color: #2c3e50;">✏️ Editar Cadastro do Tutor</h2>
        </div>
        
        <?php if (isset($cliente)): ?>
            <div class="form-card">
                <form action="http://localhost/petshop-system/public/clientes/atualizar/<?php echo $cliente['id_cliente']; ?>" method="POST">
                    
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cpf_visual">CPF (Não editável)</label>
                        <input type="text" id="cpf_visual" value="<?php 
                            $cpfNumeros = preg_replace('/[^0-9]/', '', $cliente['cpf']);
                            $ultimosDigitos = (strlen($cpfNumeros) === 11) ? substr($cpfNumeros, -3) : '***';
                            echo "***.***.***-" . $ultimosDigitos;
                        ?>" disabled style="background-color: #e9ecef; cursor: not-allowed; color: #6c757d;">
                        
                        <input type="hidden" name="cpf" value="<?php echo $cliente['cpf']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone / WhatsApp</label>
                        <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" placeholder="(00) 00000-0000" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="endereco">Endereço Completo</label>
                        <input type="text" id="endereco" name="endereco" value="<?php echo $cliente['endereco']; ?>" placeholder="Rua, Número, Bairro, Cidade">
                    </div>

                    <div class="form-botoes">
                        <button type="submit" class="btn btn-salvar">Salvar Alterações</button>
                        <a href="http://localhost/petshop-system/public/clientes" class="btn btn-cancelar">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="alerta alerta-erro">
                <p>⚠️ Erro: Os dados do cliente não foram encontrados ou não foram enviados corretamente pelo controlador.</p>
                <a href="http://localhost/petshop-system/public/clientes" class="btn btn-cancelar">Voltar para a Lista</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>