<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
$weight = $height = '';
if (isset($_POST["height"]) && isset($_POST['weight'])) {
    $height = (float)$_POST["height"];
    $weight = (float)$_POST["weight"];
    $BMI = $weight / ($height * $weight);
    if ($BMI <= 18) {
        echo 'thin';
    } elseif ( $BMI <= 25) {
        echo 'normall';
    } else {
        echo "Fat";
    };
    echo $BMI;
};
?>
<h1>Tính chỉ số BMI</h1>
<form name="bmi" action="" method="post">
    <div class="form-group">
        <label>Chiều cao</label>
        <input type="text" placeholder="heght" name="height">
    </div>
    <div class="form-group">
        <label>Cân nặng</label>
        <input type="text" placeholder="Cân nặng" name="weight">
    </div>

    <button type="submit" class="btn btn-primary">BMI</button>
</form>
</body>
</html>
