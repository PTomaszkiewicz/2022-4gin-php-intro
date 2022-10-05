<?php
require_once "tableTool.interface.php";

class tableTool implements tableToolInterface{
    
}

// NIE DOTYKAĆ KODU PONIŻEJ TEJ LINIJKI

$array = explode(' ', file_get_contents('lorem.txt'));

$table = new tableTool($array);

// Tests
echo $array->renderHTML(3);
echo $array->renderHTML(10);
echo $array->renderHTML(5,'id');
echo $array->renderCSV(3);
echo $array->renderCSV(10);
echo $array->renderCSV(5,'id');
echo $array->renderMD(3);
echo $array->renderMD(10);
echo $array->renderMD(5,'id');