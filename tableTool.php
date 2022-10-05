<?php
require_once "tableTool.interface.php";

class tableTool implements tableToolInterface{
    var $wordstable;
    function __construct($data)
    {
        $this->wordstable=$data;
    }
    //Sort text by search phrase and list it
    private function sortandsearch($lookingfor)
    {
        $output = array();;
        sort($this->wordstable, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($this->wordstable as $word) {
            if (strstr($word, $lookingfor) == true) {
                $output[] = $word;
            }
        }
        return $output;
    }
    public function renderHTML($cols, $filterString='')
    {
        $words = $this->sortandsearch($filterString);
        $e = 0;
        $htmltable = '<table>';
        $collumncount = $cols - 1;
        foreach ($words as $word) {
            if ($e % $cols == 0) {
                $htmltable .= '<tr>';
            }
            if ($e < $cols) {
                $htmltable .= '<th>' . $word . '</th>';
            } else {
                $htmltable .= '<td>' . $word . '</td>';
            }
            if ($e % $cols == $collumncount) {
                $htmltable .= '</tr>';
            }

            $e++;
        }
        if (count($words) % $cols !== 0) {
            $htmltable .= '</tr>';
        }
        $htmltable .= '</table>';
        return $htmltable;
    }
    //Render table.csv table out of given text
    public function renderCSV($cols, $filterString='')
    {
        $words = $this->sortandsearch($filterString);
        $e = 0;
        $collumncount = $cols - 1;
        $csv = '';
        foreach ($words as $word) {
            $csv .= $word . ';';
            if ($e % $cols == $collumncount) {
                $csv .= "\n";
            }
            $e++;
        }
        return $csv;
    }
    //Render table.md table out of given text
    public function renderMD($cols, $filterString='')
    {
        $words = $this->sortandsearch($filterString);
        $e = 0;
        $collumncount = $cols - 1;
        $md = '';
        foreach ($words as $word) {
            if ($e % $cols == 0) {
                $md .= "|";
            }
            $md .= $word . '|';
            if ($e % $cols == $collumncount) {
                $md .= "\n";
            }
            if ($e % $cols == $collumncount && $e < $cols) {
                $md .= '|';
                for ($i = 0; $i < $cols; $i++) {
                    $md .= '---|';
                }
                $md .= "\n";
            }
            $e++;
        }
        return $md;
    }
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