<?php

const operator_priority = [
    "+" => 1,
    "-" => 1,
    "*" => 2,
    "/" => 2,
];

function simpleCalculate($val) {
    switch (true) {
        case is_numeric($val) && floor($val) != $val:
            return (float)$val;
        case is_numeric($val):
            return (int)$val;
        case $val[0] == "-":
            return - hardCalculate(substr($val, 1));
        default:
            return hardCalculate($val);
    }
};


function hardCalculate($expression) {
    $offset = 0;
    $result = 0;
    preg_match_all("/((?=[^0-9\-]|^)-)?([0-9\.]+|\((?:[^)(]+|(?R))*+\))/", $expression, $matches);
    $matches = $matches[0];
    if ($matches[0] == $expression) {
        while (preg_match_all("/^\(/", $expression) and preg_match_all("/\)$/", $expression)) {
            $expression = preg_replace("/(^\()|(\)$)/","", $expression);
        };
        
    }
    preg_match_all("/((?=[^0-9\-]|^)-)?([0-9\.]+|\((?:[^)(]+|(?R))*+\))/", $expression, $matches);
    $matches = $matches[0];
    
    $operators = str_split(preg_replace("/((?=[^0-9\-]|^)-)?([0-9\.]+|\((?:[^)(]+|(?R))*+\))/","", $expression));
    if (!$operators) {
        return simpleCalculate($matches[0]);
    }
    
    while ($operators) {
        if ($offset > count($operators) - 1) {
            $offset = 0;
        }
        if (count($operators) > $offset + 1 and operator_priority[$operators[$offset]] < operator_priority[$operators[$offset + 1]]) {
            $offset += 1;
            continue;
        };
        switch ($operators[$offset]) {
            case "+":
                $result = simpleCalculate($matches[$offset]) + simpleCalculate($matches[$offset+1]);
                break;
            case "-":
                $result = simpleCalculate($matches[$offset]) - simpleCalculate($matches[$offset+1]);
                break;
            case "*":
                $result = simpleCalculate($matches[$offset]) * simpleCalculate($matches[$offset+1]);
                break;
            case "/":
                $result = simpleCalculate($matches[$offset]) / simpleCalculate($matches[$offset+1]);
                break;
            default:
                $result = 0; 
                break;
        }
        
        array_splice($matches, $offset, 2);
        array_splice($matches, $offset, 0, $result);
        array_splice($operators, $offset, 1);
    };
    return $result;
    
};

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    $result = hardCalculate($expression);
    header("Content-Type: application/json");
    echo $result;
} else {
    echo "Ошибка: Не удалось получить выражение.";
}

?>
