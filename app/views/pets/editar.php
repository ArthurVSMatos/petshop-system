<?php
if (isset($data)) extract($data);
if (isset($dados)) extract($dados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Editar Pet</title>
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
            <h2 style="margin: 0; color: #2c3e50;">✏️ Editar Informações do Pet</h2>
        </div>
        
        <?php if (isset($pet) && isset($clientes)): ?>
            <div class="form-card">
                <form action="http://localhost/petshop-system/public/pets/atualizar/<?php echo $pet['id_pet']; ?>" method="POST">
                    
                    <div class="form-group">
                        <label for="nome">Nome do Pet</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $pet['nome']; ?>" required>
                    </div>

                   <div class="form-group">
                        <label for="especie_select">Espécie</label>
                        <select id="especie_select" required>
                            <option value="">Selecione...</option>
                            <option value="Cachorro">Cachorro</option>
                            <option value="Gato">Gato</option>
                            <option value="Pássaro">Pássaro</option>
                            <option value="Roedor">Roedor</option>
                            <option value="Outro">Outro (Especificar)</option>
                        </select>
                    </div>

                    <div class="form-group" id="grupo_outra_especie" style="display: none;">
                        <label for="especie_input">Digite a Espécie</label>
                        <input type="text" id="especie_input" placeholder="Ex: Furão, Iguana">
                    </div>

                    <input type="hidden" name="especie" id="especie_final">

                    <div class="form-group">
                        <label for="raca">Raça</label>
                        <input type="text" id="raca" name="raca" value="<?php echo $pet['raca']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="idade">Idade (em anos)</label>
                        <input type="number" id="idade" name="idade" value="<?php echo $pet['idade']; ?>" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="porte">Porte</label>
                        <select id="porte" name="porte" required>
                            <option value="Pequeno" <?php echo ($pet['porte'] == 'Pequeno') ? 'selected' : ''; ?>>Pequeno</option>
                            <option value="Médio" <?php echo ($pet['porte'] == 'Médio') ? 'selected' : ''; ?>>Médio</option>
                            <option value="Grande" <?php echo ($pet['porte'] == 'Grande') ? 'selected' : ''; ?>>Grande</option>
                            <option value="Gigante" <?php echo ($pet['porte'] == 'Gigante') ? 'selected' : ''; ?>>Gigante</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso (kg)</label>
                        <input type="number" id="peso" name="peso" value="<?php echo $pet['peso']; ?>" step="0.01" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="cliente_id">Tutor / Dono Responsável</label>
                        <select id="cliente_id" name="cliente_id" required>
                            <?php foreach ($clientes as $cliente): ?>
                                <?php 
                                    $nomeLimpo = basename($cliente['nome']); 
                                    $cpfNumeros = preg_replace('/[^0-9]/', '', $cliente['cpf']);
                                    $ultimosDigitos = (strlen($cpfNumeros) === 11) ? substr($cpfNumeros, -3) : '***';
                                    $cpfMascarado = "***.***.***-" . $ultimosDigitos;
                                    
                                    $selected = ($cliente['id_cliente'] == $pet['id_cliente']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo $selected; ?>>
                                    <?php echo $nomeLimpo; ?> (CPF: <?php echo $cpfMascarado; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-botoes">
                        <button type="submit" class="btn btn-salvar">Salvar Alterações</button>
                        <a href="http://localhost/petshop-system/public/pets" class="btn btn-cancelar">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="alerta alerta-erro">
                <p>Erro crônico: Os dados do pet ou dos clientes não foram repassados corretamente pelo controlador.</p>
                <a href="http://localhost/petshop-system/public/pets" class="btn btn-cancelar">Voltar para a Lista</a>
            </div>
        <?php endif; ?>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const selectEspecie = document.getElementById("especie_select");
    const grupoInput = document.getElementById("grupo_outra_especie");
    const inputEspecie = document.getElementById("especie_input");
    const hiddenEspecie = document.getElementById("especie_final");

    function atualizarEspecie() {
        if (selectEspecie.value === "Outro") {
            grupoInput.style.display = "flex"; // Mostra o campo de texto
            inputEspecie.required = true;
            hiddenEspecie.value = inputEspecie.value; // Pega o que o usuário digitou
        } else {
            grupoInput.style.display = "none"; // Esconde o campo de texto
            inputEspecie.required = false;
            hiddenEspecie.value = selectEspecie.value; // Pega o valor do Select (Cachorro, Gato...)
        }
    }

    // Escuta as mudanças no Select e no Input de texto
    selectEspecie.addEventListener("change", atualizarEspecie);
    inputEspecie.addEventListener("input", function() {
        if (selectEspecie.value === "Outro") {
            hiddenEspecie.value = inputEspecie.value;
        }
    });
});
</script>
</body>
</html>