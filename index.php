<?php
$ipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium turpis vel nisi dapibus, eget gravida urna maximus. Vivamus faucibus accumsan orci. Ut pulvinar aliquam lorem quis suscipit. Nunc est velit, condimentum sed nisi ac, egestas rhoncus nulla. Cras nec nisi nec neque ultrices vestibulum. Morbi eu libero gravida, aliquet sapien id, mollis nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin risus metus, feugiat quis felis quis, laoreet imperdiet turpis. Proin vulputate ultricies sem, vel tincidunt libero porttitor at. Nam eu mattis sapien, ac malesuada nisi. Aliquam condimentum, velit semper auctor interdum, enim.";

$search = "";
function sortandsearch($text, $look){
    $words = explode(" ", $text);
$i = 1;

sort($words, SORT_NATURAL | SORT_FLAG_CASE);
foreach($words as $word){

    if(preg_match("/\b(\w*$look\w*)\b/", $word, $match) == true){
    echo "[$i] $match[0] </br>";
    $i ++;
    }
}
};
// sortandsearch($ipsum, $search);
$collumn = 5;
function renderHTMLTable($text2, $cl){
    $words = explode(" ", $text2);
    $e = 1;
    $table= "<table>";
    foreach($words as $word){
        if($e<=$cl){
        if ($e%$cl==1){
            $table .= "<tr><th>$word</th>";
        } else if ($e%$cl==0){
            $table .= "<th>$word</th></tr>";
        } else {
            $table .= "<th>$word</th>";
        }} else {
        if ($e%$cl==1){
            $table .= "<tr><td>$word</td>";
        } else if ($e%$cl==0){
            $table .= "<td>$word</td></tr>";
        } else {
            $table .= "<td>$word</td>";
        }}
        $e ++;
    }
    $table .= "</table>";
    echo $table;
};
function rednderCSV($text2, $cl){
    ob_start();
    renderHTMLTable($text2, $cl);
    $table = ob_get_clean();
    $csv = array();
preg_match('/<table(>| [^>]*>)(.*?)<\/table( |>)/is',$table,$b);
$table = $b[2];
preg_match_all('/<tr(>| [^>]*>)(.*?)<\/tr( |>)/is',$table,$b);
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
$file= "table.csv";
if(!$handle = fopen($file, "w")){
    echo "error1";};
if(!fwrite($handle, $csv)){
echo "error2";};
fclose($handle);
}
function renderMD($text2, $cl){
    ob_start();
    renderHTMLTable($text2, $cl);
    $table = ob_get_clean();
    $csv = array();
preg_match('/<table(>| [^>]*>)(.*?)<\/table( |>)/is',$table,$b);
$table = $b[2];
preg_match_all('/<tr(>| [^>]*>)(.*?)<\/tr( |>)/is',$table,$b);
$rows = $b[2];
foreach ($rows as $row) {
    //cycle through each row
    if(preg_match('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row)) {
        
        //match for table headers
        preg_match_all('/<th(>| [^>]*>)(.*?)<\/th( |>)/is',$row,$b);
        
        $csv[] = strip_tags(implode('|',$b[2]));

    } elseif(preg_match('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row)) {
        //match for table cells
        preg_match_all('/<td(>| [^>]*>)(.*?)<\/td( |>)/is',$row,$b);
        $csv[] = strip_tags(implode('|',$b[2]));
    }
}
$csv[0]=$csv[0]."|\n";
for($i=0;$i<$cl;$i++){
$csv[0]= $csv[0]."|---";
}
$csv = implode("|\n|",$csv);
$csv = "|".$csv."|";
$file= "table.md";
if(!$handle = fopen($file, "w")){
    echo "error1";};
if(!fwrite($handle, $csv)){
echo "error2";};
fclose($handle);
}
renderMD($ipsum, $collumn);
