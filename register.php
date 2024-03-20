<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar Novo Contacto</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body{
            background-color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
            color: white;
        }
        </style>
</head>
<body>
    <div class="container">
        <h2>Registar Novo Contacto</h2>
        <form action="process.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="telefone">Número de Telefone (9 dígitos):</label>
            <input type="tel" id="telefone" name="telefone" pattern="\d{9}" title="Deve ter 9 dígitos" required><br><br>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco"><br><br>

            <label for="localidade">Localidade:</label>
            <input type="text" id="localidade" name="localidade"><br><br>

            <label for="codigo_postal">Código Postal (NNNN-NNN):</label>
            <input type="text" id="codigo_postal" name="codigo_postal" pattern="\d{4}-\d{3}" title="Formato esperado: 1234-567" required><br><br>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
            </select><br><br>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" max="<?php echo date('Y-m-d'); ?>" required><br><br>

            <button type="submit">Registar</button>
            <br><br>
            <a href="index.html" class="button">Cancelar</a>
        </form>
    </div>
</body>
</html>
