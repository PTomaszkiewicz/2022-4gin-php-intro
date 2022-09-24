<?php
$ipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium turpis vel nisi dapibus, eget gravida urna maximus. Vivamus faucibus accumsan orci. Ut pulvinar aliquam lorem quis suscipit. Nunc est velit, condimentum sed nisi ac, egestas rhoncus nulla. Cras nec nisi nec neque ultrices vestibulum. Morbi eu libero gravida, aliquet sapien id, mollis nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin risus metus, feugiat quis felis quis, laoreet imperdiet turpis. Proin vulputate ultricies sem, vel tincidunt libero porttitor at. Nam eu mattis sapien, ac malesuada nisi. Aliquam condimentum, velit semper auctor interdum, enim.';
$search = '';
$collumn = 6;
//Sort text by search phrase and list it
function sortandsearch($table, $lookingfor){
    $output=array();
    $words = explode(' ', $table);
    sort($words, SORT_NATURAL | SORT_FLAG_CASE);
    foreach($words as $word){
        if(strstr($word, $lookingfor) == true){
            $output[]=$word;
        }
    }
    return $output;
};
//Convert text to a HTML table
function renderHTMLTable($table, $lookingfor, $collumnsamount){
    $words = sortandsearch($table, $lookingfor);
    $e = 0;
    $htmltable= '<table>';
    $collumncount=$collumnsamount-1;
    foreach($words as $word){
        if($e%$collumnsamount==0){
            $htmltable .= '<tr>';
        }
        if($e<$collumnsamount){
            $htmltable .= '<th>'.$word.'</th>';
        } else {
            $htmltable .= '<td>'.$word.'</td>';
        }
        if($e%$collumnsamount==$collumncount){
            $htmltable .= '</tr>';
        }
        
        $e++;
    }
    if(count($words)%$collumnsamount!==0){
        $htmltable .= '</tr>';
    }
    $htmltable .= '</table>';
    return $htmltable;
};
//Render table.csv table out of given text
function renderCSV($table, $lookingfor, $collumnsamount){
    $words = sortandsearch($table, $lookingfor);
    $e = 0;
    $collumncount=$collumnsamount-1;
    $csv = '';
    foreach($words as $word){
        $csv .= $word.';';
        if($e%$collumnsamount==$collumncount){
            $csv .= "\n";
        }      
        $e++;
    }
    return $csv;
}
//Render table.md table out of given text
function renderMD($table, $lookingfor, $collumnsamount){
    $words = sortandsearch($table, $lookingfor);
    $e = 0;
    $collumncount=$collumnsamount-1;
    $md = '';
    foreach($words as $word){
        if($e%$collumnsamount==0){
            $md .= "|";
        } 
        $md .= $word.'|';
        if($e%$collumnsamount==$collumncount){
            $md .= "\n";
        }
        if($e%$collumnsamount==$collumncount && $e<$collumnsamount){
            $md .='|';
            for($i=0;$i<$collumnsamount;$i++){
                $md .='---|';
            }
            $md .="\n";
        }  
        $e++;
    }
    return $md;
}
//sortandsearch function test
foreach(sortandsearch($ipsum, $search) as $arrayel){
    echo $arrayel.'<br>';
}
//renderHTMLTable function test
echo renderHTMLTable($ipsum, $search, $collumn);
$csvfile='table.csv';
if(!$handlecsv =fopen($csvfile, 'w+')){
    echo 'Filed to open '.$csvfile;}
if(!fwrite($handlecsv, renderCSV($ipsum, $search, $collumn))){
echo 'Filed to write '.$csvfile;}
fclose($handlecsv);
//renderMD function test
$mdfile='table.md';
if(!$handlemd =fopen($mdfile, 'w+')){
    echo 'Filed to open '.$mdfile;}
if(!fwrite($handlemd, renderMD($ipsum, $search, $collumn))){
echo 'Filed to write '.$mdfile;}
fclose($handlemd);
?>