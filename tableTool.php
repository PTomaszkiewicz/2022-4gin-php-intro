<?php
require_once "tableTool.interface.php";

class tableTool implements tableToolInterface{
    
}

// NIE DOTYKAĆ KODU PONIŻEJ TEJ LINIJKI

$array = explode(' ', file_get_contents('lorem.txt'));

$table = new tableTool($array);

// Tests
echo $table->renderHTML(3);
echo $table->renderHTML(10);
echo $table->renderHTML(5,'id');
echo $table->renderCSV(3);
echo $table->renderCSV(10);
echo $table->renderCSV(5,'id');
echo $table->renderMD(3);
echo $table->renderMD(10);
echo $table->renderMD(5,'id');