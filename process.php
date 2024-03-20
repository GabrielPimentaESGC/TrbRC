<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contacto = [
        'nome' => $_POST['nome'],
        'sobrenome' => $_POST['sobrenome'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'endereco' => $_POST['endereco'],
        'localidade' => $_POST['localidade'],
        'codigo_postal' => $_POST['codigo_postal'],
        'sexo' => $_POST['sexo'],
        'data_nascimento' => $_POST['data_nascimento'],
    ];

    if (!isset($_SESSION['contactos'])) {
        $_SESSION['contactos'] = [];
    }

    $_SESSION['contactos'][] = $contacto;
    header("Location: contacts.php");
}
?>
