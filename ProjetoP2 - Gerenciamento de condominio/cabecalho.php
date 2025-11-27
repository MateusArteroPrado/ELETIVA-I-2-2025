<?php
session_start();
if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] !== true) {
    header('location: index.php');
    exit;
}

$nome_usuario = $_SESSION['nome'] ?? 'Usuário';
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CondControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            /* Valor que compensa a altura da Navbar */
            padding-top: 70px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="principal.php">
                <img src="condcontrol_logo.png" alt="CondControl Logo" height="30" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'principal.php' || $pagina_atual == 'index.php') ? 'active' : '' ?>"
                            href="principal.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pessoas & Ativos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                            <li><a class="dropdown-item <?= ($pagina_atual == 'moradores.php') ? 'active' : '' ?>" href="moradores.php">Moradores</a></li>
                            <li><a class="dropdown-item <?= ($pagina_atual == 'unidades.php') ? 'active' : '' ?>" href="unidades.php">Unidades</a></li>
                            <li><a class="dropdown-item <?= ($pagina_atual == 'veiculos.php') ? 'active' : '' ?>" href="veiculos.php">Veículos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'ocorrencias.php') ? 'active' : '' ?>"
                            href="ocorrencias.php">Ocorrências</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'movimentacoes.php') ? 'active' : '' ?>"
                            href="movimentacoes.php">Movimentações</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bem-vindo(a), <?= htmlspecialchars($nome_usuario) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-danger" href="sair.php">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>