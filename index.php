<?php
$ipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium turpis vel nisi dapibus, eget gravida urna maximus. Vivamus faucibus accumsan orci. Ut pulvinar aliquam lorem quis suscipit. Nunc est velit, condimentum sed nisi ac, egestas rhoncus nulla. Cras nec nisi nec neque ultrices vestibulum. Morbi eu libero gravida, aliquet sapien id, mollis nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin risus metus, feugiat quis felis quis, laoreet imperdiet turpis. Proin vulputate ultricies sem, vel tincidunt libero porttitor at. Nam eu mattis sapien, ac malesuada nisi. Aliquam condimentum, velit semper auctor interdum, enim.";
$words = explode(" ", $ipsum);
$i = 1;
$search = "";
sort($words, SORT_NATURAL | SORT_FLAG_CASE);
foreach($words as $word){

    if(preg_match("/\b(\w*$search\w*)\b/", $word, $match) == true){
    echo "[$i] $match[0] </br>";
    $i ++;
    }
}
