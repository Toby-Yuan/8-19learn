<?php
if(isset($_POST["cancel"])){
    header("location: index.php");
}

$userFirstName = "";
$userLastName = "";

require_once("connect.php");
$editId = $_GET["edit"];

$cityList = <<<citySql
SELECT * FROM city;
citySql;
$cityResult = mysqli_query($link, $cityList);

if(isset($editId)){
    $commandText = <<<sqlCommand
    SELECT employeeId, firstName, lastName, e.cityId, cityName
    FROM city c JOIN employee e ON c.cityId = e.cityId
    WHERE employeeId = $editId;
    sqlCommand;
    $result = mysqli_query($link, $commandText);
    $row = mysqli_fetch_assoc($result);
    $userFirstName = $row["firstName"];
    $userLastName = $row["lastName"];
    $userCity = $row["cityId"];
}

if(isset($_POST["submit"])){
    $firstName = $_POST["inputFirstName"];
    $lastName = $_POST["inputLastName"];
    $cityId = $_POST["cityRadio"];

    if(isset($editId)){
        $editSql = <<<editUpdate
        UPDATE employee SET
        firstName = '$firstName', lastName = '$lastName', cityId = '$cityId'
        WHERE employeeId = $editId;
        editUpdate;
        mysqli_query($link, $editSql);
        header("location: index.php");
    }else{
        $sql = <<<sqlInsert
        INSERT INTO employee (firstName, lastName, cityId) 
        VALUES ('$firstName', '$lastName', $cityId)
        sqlInsert;
        require_once("connect.php");
        mysqli_query($link, $sql);
        header("location: index.php");
    }
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
    
      <?php while($cityRow = mysqli_fetch_assoc($cityResult)){ ?>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="cityRadio" id="cityRadio_<?= $cityRow["cityId"] ?>" type="radio" class="custom-control-input" value="<?= $cityRow["cityId"] ?>" <?= ($userCity == $cityRow["cityId"])? "checked" : "" ?>> 
        <label for="cityRadio_<?= $cityRow["cityId"] ?>" class="custom-control-label"><?= $cityRow["cityName"] ?></label>
      </div>
      <?php } ?>

    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
      <button name="cancel" value="cancel" type="cancel" class="btn btn-secondary">Cancel</button>
    </div>
  </div>
</form>
</div>
</body>
</html>