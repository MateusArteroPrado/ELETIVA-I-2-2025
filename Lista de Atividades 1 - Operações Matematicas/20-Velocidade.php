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
<h1>Calcule a velocidade média!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="primeiro" class="form-label">Insira a distância:</label>
     <input type="number" id="primeiro" name="primeiro" class="form-control" required="">
  </div>
  <div class="col-md-3" bis_skin_checked="1">
    <label for="unidadedistancia" class="form-label">Unidade</label>
    <select id="unidadedistancia" name="unidadedistancia" class="form-select">
    <option value="metros (m)">Metros</option>
    <option value="quilômetros (km)">Quilômetros</option>
    </select>
  </div>
</div>
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="segundo" class="form-label">Insira o tempo:</label>
    <input type="number" id="segundo" name="segundo" class="form-control" required="">
  </div>
    <div class="col-md-3" bis_skin_checked="1">
    <label for="unidadetempo" class="form-label">Unidade</label>
    <select id="unidadetempo" name="unidadetempo" class="form-select">
    <option value="segundo (s)">Segundos</option>
    <option value="hora (h)">Horas</option>
    </select>
  </div>
</div>
<button type="submit" class="btn btn-primary">Somar</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $primeiro = $_POST['primeiro'];
    $segundo = $_POST['segundo'];
    $unidadedistancia = $_POST['unidadedistancia'];
    $unidadetempo = $_POST['unidadetempo'];
    $media = $primeiro / $segundo;
    echo "A velocidade média é de $media $unidadedistancia por $unidadetempo.";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>