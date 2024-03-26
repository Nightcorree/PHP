<?php
$equal = $_POST['equal'];

function calculateExpression($equal) {
    $equal = str_replace(' ', '', $equal);

    while (strpos($equal, '(') !== false) {
        $start = strrpos($equal, '(');
        $end = strpos($equal, ')', $start);
        $innerExpression = substr($equal, $start + 1, $end - $start - 1);
        $innerResult = calculateExpression($innerExpression);

        $equal = substr_replace($equal, $innerResult, $start, $end - $start + 1);
    }

    $result = 0;
    preg_match_all('/(-?\d+|\+|-|\*|\/)/', $equal, $matches);
    $parts = $matches[0];
    
    foreach ($parts as $key => $part) {
        if ($part === '*' || $part === '/') {
            $left = $parts[$key - 1];
            $right = $parts[$key + 1];
            switch ($part) {
                case '*':
                    $result = calculateExpression($left) * calculateExpression($right);
                    break;
                case '/':
                    $result = calculateExpression($left) / calculateExpression($right);
                    break;
            }
            array_splice($parts, $key - 1, 3, $result);
            return calculateExpression(implode('', $parts));
        }
    }

    foreach ($parts as $key => $part) {
        if ($part === '+' || $part === '-') {
            $left = $parts[$key - 1];
            $right = $parts[$key + 1];
            switch ($part) {
                case '+':
                    $result = calculateExpression($left) + calculateExpression($right);
                    break;
                case '-':
                    $result = calculateExpression($left) - calculateExpression($right);
                    break;
            }
            array_splice($parts, $key - 1, 3, $result);
            return calculateExpression(implode('', $parts));
        }
    }
    return (float)$equal;
}

$result = calculateExpression($equal);
echo json_encode($result);
?>
