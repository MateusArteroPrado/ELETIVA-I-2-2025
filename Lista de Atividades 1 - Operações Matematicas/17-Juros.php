<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Calcule um juros simples!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="capital" class="form-label">Insira o valor do capital:</label>
     <input type="number" id="capital" name="capital" class="form-control" required="">
  </div>
  <div class="col-md-3">
    <label for="taxa" class="form-label">Insira a taxa de juros (%):</label>
    <input type="number" id="taxa" name="taxa" class="form-control" required="">
  </div>
    <div class="col-md-3">
    <label for="periodo" class="form-label">Insira o periodo:</label>
    <input type="number" id="periodo" name="periodo" class="form-control" required="">
  </div>
</div>
<button type="submit" class="btn btn-primary">Calcular</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $capital = $_POST['capital'];
    $taxa = $_POST['taxa'];
    $periodo = $_POST['periodo'];
    $juros = $capital * ($taxa/100) * $periodo;
    $valor2 = $juros + $capital;
    echo "<p>$capital * $taxa % * $periodo = $juros de juros</p>";
    echo "<p>O valor com a taxa aplicada é $valor2</p>";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>