<?php
if (isset($data)) extract($data);
if (isset($dados)) extract($dados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Petshop System - Cadastrar Pet</title>
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
            <h2 style="margin: 0; color: #2c3e50;">🐾 Cadastrar Novo Pet</h2>
        </div>
        
        <?php if (isset($erro)): ?>
            <div class="alerta alerta-erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <div class="form-card">
            <form action="http://localhost/petshop-system/public/pets/salvar" method="POST">
                
                <div class="form-group">
                    <label for="nome">Nome do Pet</label>
                    <input type="text" id="nome" name="nome" required>
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
                    <input type="text" id="raca" name="raca" placeholder="Ex: Poodle, SRD" required>
                </div>

                <div class="form-group">
                    <label for="idade">Idade (em anos)</label>
                    <input type="number" id="idade" name="idade" min="0" required>
                </div>

                <div class="form-group">
                    <label for="porte">Porte</label>
                    <select id="porte" name="porte" required>
                        <option value="">Selecione o Porte...</option>
                        <option value="Pequeno">Pequeno</option>
                        <option value="Médio">Médio</option>
                        <option value="Grande">Grande</option>
                        <option value="Gigante">Gigante</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" step="0.01" min="0" placeholder="Ex: 12.50" required>
                </div>

                <div class="form-group">
                    <label for="cliente_id">Tutor / Dono Responsável</label>
                    <select id="cliente_id" name="cliente_id" required>
                        <option value="">Selecione o Dono...</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <?php 
                                $nomeLimpo = basename($cliente['nome']); 
                                $cpfNumeros = preg_replace('/[^0-9]/', '', $cliente['cpf']);
                                $ultimosDigitos = (strlen($cpfNumeros) === 11) ? substr($cpfNumeros, -3) : '***';
                                $cpfMascarado = "***.***.***-" . $ultimosDigitos;
                            ?>
                            <option value="<?php echo $cliente['id_cliente']; ?>">
                                <?php echo $nomeLimpo; ?> (CPF: <?php echo $cpfMascarado; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-botoes">
                    <button type="submit" class="btn btn-salvar">Cadastrar Pet</button>
                    <a href="http://localhost/petshop-system/public/pets" class="btn btn-cancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </div><script>
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