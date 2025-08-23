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
<h1>Calcule o perimetro de um retângulo (ou quadrado)!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="altura" class="form-label">Insira a altura:</label>
     <input type="number" id="altura" name="altura" class="form-control" required="">
  </div>
  <div class="col-md-3">
    <label for="largura" class="form-label">Insira a largura:</label>
    <input type="number" id="largura" name="largura" class="form-control" required="">
  </div>
  <div class="col-md-3" bis_skin_checked="1">
    <label for="unidade" class="form-label">unidade</label>
    <select id="unidade" name="unidade" class="form-select">
    <option value="centímetros (cm)">Centímetros</option>
    <option value="metros (m)">Metros</option>
    <option value="polegadas(pol)">Polegadas</option>
    </select>
  </div>
</div>
<button type="submit" class="btn btn-primary">Calcular</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $altura = $_POST['altura'];
    $largura = $_POST['largura'];
    $unidade = $_POST['unidade'];
    $perimetro = ($altura + $largura) * 2;
    echo "($altura + $largura) * 2 = $perimetro $unidade";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>