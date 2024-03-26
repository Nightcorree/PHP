<?php
    //1
    $array = ['a', 'b', 'c', 'b', 'a'];

    $counts = array_count_values($array);


    foreach ($counts as $letter => $count) {
        echo "Буква '$letter' встречается $count раз(а) <br>";
    }


    //7
    $array1 = [1, 2, 3];
    $array2 = ['a', 'b', 'c'];

    $mergedArray = array_merge($array1, $array2);

    print_r($mergedArray);

    //12
    $array = ['a', '-', 'b', '-', 'c', '-', 'd'];

    $position = array_search('-', $array);

    echo "Позиция первого элемента '-' в массиве: $position";


    //16
    $array = [1, 2, 3, 4, 5, 6, 7, 8];

    $result = '';

    while (!empty($array)) {
        $result .= array_shift($array);

        if (!empty($array)) {
            $result .= array_pop($array);
        }
    }

    echo $result;


    //42
    $arr = [
        'Коля' => '200',
        'Вася' => '300',
        'Петя' => '400'
    ];
    
    foreach ($arr as $name => $salary) {
        echo "$name - зарплата $salary долларов.<br>";
    }
?>
