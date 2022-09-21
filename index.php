<?php
$ipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium turpis vel nisi dapibus, eget gravida urna maximus. Vivamus faucibus accumsan orci. Ut pulvinar aliquam lorem quis suscipit. Nunc est velit, condimentum sed nisi ac, egestas rhoncus nulla. Cras nec nisi nec neque ultrices vestibulum. Morbi eu libero gravida, aliquet sapien id, mollis nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin risus metus, feugiat quis felis quis, laoreet imperdiet turpis. Proin vulputate ultricies sem, vel tincidunt libero porttitor at. Nam eu mattis sapien, ac malesuada nisi. Aliquam condimentum, velit semper auctor interdum, enim.";
$search = "";
$collumn = 5;
//Sort text by search phrase and list it
function sortandsearch($table, $lookingfor){
    $output=array();
    $words = explode(" ", $table);
    sort($words, SORT_NATURAL | SORT_FLAG_CASE);
    foreach($words as $word){
        if(preg_match("/\b(\w*$lookingfor\w*)\b/", $word, $match) == true){
            $output[]=$match[0];
        }
    }
    return $output;
};
//Convert text to a HTML table
function renderHTMLTable($table, $lookingfor, $collumnsamount){
    $words = sortandsearch($table, $lookingfor);
    $e = 1;
    $table= "<table>";
    foreach($words as $word){
        if($e<=$collumnsamount){
        if ($e%$collumnsamount==1){
            $table .= "<tr><th>$word</th>";
        } else if ($e%$collumnsamount==0){
            $table .= "<th>$word</th></tr>";
        } else {
            $table .= "<th>$word</th>";
        }} else {
        if ($e%$collumnsamount==1){
            $table .= "<tr><td>$word</td>";
        } else if ($e%$collumnsamount==0){
            $table .= "<td>$word</td></tr>";
        } else {
            $table .= "<td>$word</td>";
        }}
        $e ++;
    }
    $table .= "</table>";
    return $table;
};
//Render table.csv table out of given text
function rednderCSV($table, $lookingfor, $collumnsamount){
    
    $htmltable = renderHTMLTable($table, $lookingfor, $collumnsamount);
    $csv = array();
    preg_match('/<table(>| [^>]*>)(.*?)<\/table( |>)/is',$htmltable,$b);
    $htmltable = $b[2];
    preg_match_all('/<tr(>| [^>]*>)(.*?)<\/tr( |>)/is',$htmltable,$b);
    $rows = $b[2];
    foreach ($rows as $row) {
        //cycle through each row
        if(preg_match('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row)) {
            //match for table headers
            preg_match_all('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row,$b);
            $csv[] = strip_tags(implode(';',$b[2]));
        } elseif(preg_match('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row)) {
            //match for table cells
            preg_match_all('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row,$b);
            $csv[] = strip_tags(implode(';',$b[2]));
        }
    }
    $csv = implode("\n", $csv);
    return $csv;
}
//Render table.md table out of given text
function renderMD($table, $lookingfor, $collumnsamount){
    $htmltable = renderHTMLTable($table, $lookingfor, $collumnsamount);
    $md = array();
    preg_match('/<table(>| [^>]*>)(.*?)<\/table( |>)/is',$htmltable,$b);
    $htmltable = $b[2];
    preg_match_all('/<tr(>| [^>]*>)(.*?)<\/tr( |>)/is',$htmltable,$b);
    $rows = $b[2];
    foreach ($rows as $row) {
        //cycle through each row
        if(preg_match('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row)) {      
            //match for table headers
            preg_match_all('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row,$b);
            $md[] = strip_tags(implode('|',$b[2]));
        } elseif(preg_match('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row)) {
            //match for table cells
            preg_match_all('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row,$b);
            $md[] = strip_tags(implode('|',$b[2]));
        }
    }
    $md[0]=$md[0]."|\n";
    for($i=0;$i<$collumnsamount;$i++){
        $md[0]= $md[0]."|---";
    }
    $md = implode("|\n|",$md);
    $md = "|".$md."|";
    return $md;
}
?>