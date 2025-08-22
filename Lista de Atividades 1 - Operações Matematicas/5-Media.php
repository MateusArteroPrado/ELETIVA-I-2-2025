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
<h1>Calcule a média de 3 notas!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="primeiro" class="form-label">Insira a primeira nota:</label>
    <input type="number" id="primeiro" name="primeiro" class="form-control" required="">
  </div>
  <div class="col-md-3">
    <label for="segundo" class="form-label">Insira a segunda nota:</label>
    <input type="number" id="segundo" name="segundo" class="form-control" required="">
  </div>
    <div class="col-md-3">
    <label for="terceiro" class="form-label">Insira a terceira nota:</label>
    <input type="number" id="terceiro" name="terceiro" class="form-control" required="">
  </div>
</div>
<button type="submit" class="btn btn-primary">Somar</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $primeiro = $_POST['primeiro'];
    $segundo = $_POST['segundo'];
    $terceiro = $_POST['terceiro'];
    $media = ($primeiro + $segundo + $terceiro)/3;
    echo "A média das notas $primeiro, $segundo e $terceiro é $media";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>