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
<h1>Calcule a área de um circulo!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3" bis_skin_checked="1">
    <label for="medida" class="form-label">O valor é referente a:</label>
    <select id="medida" name="medida" class="form-select">
    <option value="a">Raio</option>
    <option value="b">Diâmetro</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="valor" class="form-label">Insira o valor:</label>
    <input type="number" id="valor" name="valor" class="form-control" required="">
  </div>
  <div class="col-md-3" bis_skin_checked="1">
    <label for="unidade" class="form-label">unidade</label>
    <select id="unidade" name="unidade" class="form-select">
    <option value="centímetros quadrados (cm²)">Centímetros</option>
    <option value="metros quadrados (m²)">Metros</option>
    <option value="polegadas quadradas (pol²)">Polegadas</option>
    </select>
  </div>
</div>
<button type="submit" class="btn btn-primary">Calcular</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $medida = $_POST['medida'];
    $valor = $_POST['valor'];
    $unidade = $_POST['unidade'];
      if ($medida == 'a')
      {$area = 3.14159265 * ($valor ** 2);
        echo "  π * $valor ² = $area $unidade";
      }
      elseif ($medida == 'b')
      {$area = ((3.14159265 * ($valor ** 2))/4);
        echo " ( π * $valor ²)/4 = $area $unidade";
      }

    //$area = $altura * $valor;
    //echo "$altura * $valor = $area $unidade";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>