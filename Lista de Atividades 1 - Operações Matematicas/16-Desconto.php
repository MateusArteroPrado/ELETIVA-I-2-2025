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
<h1>Calcule um desconto!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="primeiro" class="form-label">Insira o preço do produto:</label>
     <input type="number" id="primeiro" name="primeiro" class="form-control" required="">
  </div>
  <div class="col-md-3">
    <label for="segundo" class="form-label">Insira o % de desconto:</label>
    <input type="number" id="segundo" name="segundo" class="form-control" required="">
  </div>
</div>
<button type="submit" class="btn btn-primary">Calcular desconto</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $primeiro = $_POST['primeiro'];
    $segundo = $_POST['segundo'];
    $desconto = $primeiro * ((100-$segundo)/100);
    echo "$primeiro - $segundo % = $desconto";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>