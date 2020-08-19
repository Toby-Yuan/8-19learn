<?php
    require_once("connect.php");
    
    $commandText = <<<sqlCommand
    SELECT employeeId, firstName, lastName, e.cityId, cityName
    FROM city c JOIN employee e ON c.cityId = e.cityId
    sqlCommand;
    $result = mysqli_query($link, $commandText);
    // print_r($result);

    if(isset($_GET["delete"])){
        $employeeId = $_GET["delete"];
        $deleteSql = <<<deleteIt
        DELETE FROM employee WHERE employeeId = $employeeId;
        deleteIt;
        mysqli_query($link, $deleteSql);
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
<h1>Employee List</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">FirstName</th>
      <th scope="col">LastName</th>
      <th scope="col">City</th>
      <th scope="col">
        <span class="float-right">
            <a href="editForm.php" class="btn btn-md btn-outline-info">New</a>
        </span>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row["firstName"] ?></td>
      <td><?= $row["lastName"] ?></td>
      <td><?= $row["cityName"] ?></td>
      <td>
        <span class="float-right">
            <a href="editForm.php?edit=<?= $row["employeeId"] ?>" class="btn btn-sm btn-outline-success">Edit</a>
            |
            <a href="index.php?delete=<?= $row["employeeId"] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
        </span>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</body>
</html>