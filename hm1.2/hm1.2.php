<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $equation = "4 * X = 36";

    $parts = explode(' ', $equation);

    $coefficient = $parts[0];
    $result = $parts[4];

    $X = $result / $coefficient;

    echo "Значение переменной X = $X";
    ?> 
</body>
</html>