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
<h1>Converta metros para centímetros!</h1>
<form method="post">
<div class="row inline-row mb-3">
  <div class="col-md-3">
    <label for="primeiro" class="form-label">Insira a medida em metros:</label>
     <input type="number" id="primeiro" name="primeiro" class="form-control" required="">
  </div>
</div>
<button type="submit" class="btn btn-primary">Converter</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
    $primeiro = $_POST['primeiro'];
    $conversao = $primeiro * 100;
    echo "$primeiro metro(s) = $conversao centímetros";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>