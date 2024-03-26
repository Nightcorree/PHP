
<?php

//1
$file = 'test.txt';
$content = '12345';

file_put_contents($file, $content);

//7
$file = 'test.txt';

$content = file_get_contents($file);
$content .= '!';

file_put_contents($file, $content);

//11
$file = 'test.txt';

$filesize = filesize($file);

echo "Размер файла $file составляет $filesize байт.";

//16
$file = 'test.txt';

if (file_exists($file)) {
    echo "Файл $file существует";
} else {
    echo "Файл $file не существует";
}
?>

