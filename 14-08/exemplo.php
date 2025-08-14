
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro exemplo de PHP</title>
</head>
<body>
    <?php
        $dia = date("d") 
        /*aqui eu defini que a variavel dia será o valor dat usar php -S localhost:8080
        e depois abrir o localhost:8080/nomedapasta/nomearquivo.php*/
    ?>
    <h1> Hoje é dia <?= $dia ?> de Agosto de 2025 </h1>
</body>
</html>