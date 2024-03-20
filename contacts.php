<?php
session_start();

// Inicia o array
if (!isset($_SESSION['contactos'])) {
    $_SESSION['contactos'] = [];
}

// Não entendi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Ação de apagar
    if (isset($data['action']) && $data['action'] === 'delete' && isset($data['index'])) {
        array_splice($_SESSION['contactos'], $data['index'], 1);
        echo "Deleted";
        exit;
    }

    // Ação de editar
    if (isset($data['action']) && $data['action'] === 'edit' && isset($data['index'], $data['contacto'])) {
        // Alteração dos dados
        $_SESSION['contactos'][$data['index']] = $data['contacto'];
        echo "Edited";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contactos</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Função de javascript para dizer ao php o que vai acontecer
        function deleteContact(index) {
            if (confirm('Tem certeza que deseja remover este contacto?')) {
                fetch('contacts.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ action: 'delete', index: index }),
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'Deleted') {
                        document.getElementById('row-' + index).remove();
                    }
                });
            }
        }
        // função para editar
        function editContact(index) {
            const row = document.getElementById('row-' + index);
            const cells = row.querySelectorAll('td');
            const contact = {
                nome: cells[0].textContent,
                sobrenome: cells[1].textContent,
                email: cells[2].textContent,
                telefone: cells[3].textContent,
                endereco: cells[4].textContent,
                localidade: cells[5].textContent,
                codigo_postal: cells[6].textContent,
                sexo: cells[7].textContent,
                data_nascimento: cells[8].textContent,
            };
                // Janelas de edição
            cells[0].innerHTML = `<input type='text' value='${contact.nome}' />`;
            cells[1].innerHTML = `<input type='text' value='${contact.sobrenome}' />`;
            cells[2].innerHTML = `<input type='text' value='${contact.email}' />`;
            cells[3].innerHTML = `<input type='text' value='${contact.telefone}' />`;
            cells[4].innerHTML = `<input type='text' value='${contact.endereco}' />`;
            cells[5].innerHTML = `<input type='text' value='${contact.localidade}' />`;
            cells[6].innerHTML = `<input type='text' value='${contact.codigo_postal}' />`;
            cells[7].innerHTML = `<input type='text' value='${contact.sexo}' />`;
            cells[8].innerHTML = `<input type='text' value='${contact.data_nascimento}' />`;
            cells[9].innerHTML = `<button onclick='saveContact(${index})'>Salvar</button> <button onclick='deleteContact(${index})'>Remover</button>`;
        }
        // função de guardar
        function saveContact(index) {
            const row = document.getElementById('row-' + index);
            const inputs = row.querySelectorAll('input');
            const contact = {
                nome: inputs[0].value,
                sobrenome: inputs[1].value,
                email: inputs[2].value,
                telefone: inputs[3].value,
                endereco: inputs[4].value,
                localidade: inputs[5].value,
                codigo_postal: inputs[6].value,
                sexo: inputs[7].value,
                data_nascimento: inputs[8].value,
            };

            fetch('contacts.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'edit', index: index, contacto: contact }),
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'Edited') {
                    row.cells[0].textContent = contact.nome;
                    row.cells[1].textContent = contact.sobrenome;
                    row.cells[2].textContent = contact.email;
                    row.cells[3].textContent = contact.telefone;
                    row.cells[4].textContent = contact.endereco;
                    row.cells[5].textContent = contact.localidade;
                    row.cells[6].textContent = contact.codigo_postal;
                    row.cells[7].textContent = contact.sexo;
                    row.cells[8].textContent = contact.data_nascimento;
                    row.cells[9].innerHTML = `<button onclick='editContact(${index})'>Editar</button> <button onclick='deleteContact(${index})'>Remover</button>`;
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Lista de Contactos</h2>
        <br>
        <a href="index.html" class="button">Voltar Ao Menu Principal</a>
        <br>
        <table>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>E-mail</th>
                <th>Número de Telefone</th>
                <th>Endereço</th>
                <th>Localidade</th>
                <th>Código Postal</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($_SESSION['contactos'] as $index => $contacto): ?>
                <tr id="row-<?php echo $index; ?>">
                    <td><?php echo $contacto['nome'] ?? ''; ?></td>
                    <td><?php echo $contacto['sobrenome'] ?? ''; ?></td>
                    <td><?php echo $contacto['email'] ?? ''; ?></td>
                    <td><?php echo $contacto['telefone'] ?? ''; ?></td>
                    <td><?php echo $contacto['endereco'] ?? ''; ?></td>
                    <td><?php echo $contacto['localidade'] ?? ''; ?></td>
                    <td><?php echo $contacto['codigo_postal'] ?? ''; ?></td>
                    <td><?php echo $contacto['sexo'] ?? ''; ?></td>
                    <td><?php echo $contacto['data_nascimento'] ?? ''; ?></td>
                    <td>
                        <button onclick="editContact(<?php echo $index; ?>)">Editar</button>
                        <button onclick="deleteContact(<?php echo $index; ?>)">Remover</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
