<?php
class renderTables
{
    var $wordstable;
    var $lookingfor;
    var $collumnsamount;
    //Sort text by search phrase and list it
    private function sortandsearch()
    {
        $output = array();
        $words = explode(' ', $this->wordstable);
        sort($words, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($words as $word) {
            if (strstr($word, $this->lookingfor) == true) {
                $output[] = $word;
            }
        }
        return $output;
    }
    public function renderHTMLTable()
    {
        $words = $this->sortandsearch();
        $e = 0;
        $htmltable = '<table>';
        $collumncount = $this->collumnsamount - 1;
        foreach ($words as $word) {
            if ($e % $this->collumnsamount == 0) {
                $htmltable .= '<tr>';
            }
            if ($e < $this->collumnsamount) {
                $htmltable .= '<th>' . $word . '</th>';
            } else {
                $htmltable .= '<td>' . $word . '</td>';
            }
            if ($e % $this->collumnsamount == $collumncount) {
                $htmltable .= '</tr>';
            }

            $e++;
        }
        if (count($words) % $this->collumnsamount !== 0) {
            $htmltable .= '</tr>';
        }
        $htmltable .= '</table>';
        return $htmltable;
    }
    //Render table.csv table out of given text
    public function renderCSV()
    {
        $words = $this->sortandsearch();
        $e = 0;
        $collumncount = $this->collumnsamount - 1;
        $csv = '';
        foreach ($words as $word) {
            $csv .= $word . ';';
            if ($e % $this->collumnsamount == $collumncount) {
                $csv .= "\n";
            }
            $e++;
        }
        return $csv;
    }
    //Render table.md table out of given text
    public function renderMD()
    {
        $words = $this->sortandsearch();
        $e = 0;
        $collumncount = $this->collumnsamount - 1;
        $md = '';
        foreach ($words as $word) {
            if ($e % $this->collumnsamount == 0) {
                $md .= "|";
            }
            $md .= $word . '|';
            if ($e % $this->collumnsamount == $collumncount) {
                $md .= "\n";
            }
            if ($e % $this->collumnsamount == $collumncount && $e < $this->collumnsamount) {
                $md .= '|';
                for ($i = 0; $i < $this->collumnsamount; $i++) {
                    $md .= '---|';
                }
                $md .= "\n";
            }
            $e++;
        }
        return $md;
    }
}
$ipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium turpis vel nisi dapibus, eget gravida urna maximus. Vivamus faucibus accumsan orci. Ut pulvinar aliquam lorem quis suscipit. Nunc est velit, condimentum sed nisi ac, egestas rhoncus nulla. Cras nec nisi nec neque ultrices vestibulum. Morbi eu libero gravida, aliquet sapien id, mollis nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin risus metus, feugiat quis felis quis, laoreet imperdiet turpis. Proin vulputate ultricies sem, vel tincidunt libero porttitor at. Nam eu mattis sapien, ac malesuada nisi. Aliquam condimentum, velit semper auctor interdum, enim.';
$search = 'l';
$collumn = 6;
$tabela = new renderTables();
$tabela->wordstable = $ipsum;
$tabela->lookingfor = $search;
$tabela->collumnsamount = $collumn;
//renderHTMLTable function test
echo $tabela->renderHTMLTable();
//renderCSB function test
$csvfile = 'table.csv';
if (!$handlecsv = fopen($csvfile, 'w+')) {
    echo 'Filed to open ' . $csvfile;
}
if (!fwrite($handlecsv, $tabela->renderCSV())) {
    echo 'Filed to write ' . $csvfile;
}
fclose($handlecsv);
//renderMD function test
$mdfile = 'table.md';
if (!$handlemd = fopen($mdfile, 'w+')) {
    echo 'Filed to open ' . $mdfile;
}
if (!fwrite($handlemd, $tabela->renderMD())) {
    echo 'Filed to write ' . $mdfile;
}
fclose($handlemd);
