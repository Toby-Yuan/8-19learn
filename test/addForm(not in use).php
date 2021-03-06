<?php

if (isset($_POST["submit"])){
  $firstName = $_POST["inputFirstName"];
  $lastName = $_POST["inputLastName"];
  $cityId = $_POST["cityRadio"];
  
  $sql = <<<sqlInsert
  INSERT INTO employee (firstName, lastName, cityId) 
  VALUES ('$firstName', '$lastName', $cityId)
  sqlInsert;
  require_once("connect.php");
  mysqli_query($link, $sql);
  header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- BS4 : CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- BS4 : JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
<body>
<div class="container mt-5">

<form method="POST" action="">
  <div class="form-group row">
    <label for="inputFirstName" class="col-4 col-form-label">FirstName</label> 
    <div class="col-8">
      <input id="inputFirstName" name="inputFirstName" type="text" class="form-control" value="<?= $userFirstName ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputLastName" class="col-4 col-form-label">LastName</label> 
    <div class="col-8">
      <input id="inputLastName" name="inputLastName" type="text" class="form-control" value="<?= $userLastName ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">City</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="cityRadio" id="cityRadio_0" type="radio" class="custom-control-input" value="1"> 
        <label for="cityRadio_0" class="custom-control-label">Taipei</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="cityRadio" id="cityRadio_1" type="radio" class="custom-control-input" value="2"> 
        <label for="cityRadio_1" class="custom-control-label">Taichung</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="cityRadio" id="cityRadio_2" type="radio" class="custom-control-input" value="3"> 
        <label for="cityRadio_2" class="custom-control-label">Tainan</label>
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</body>
</html>