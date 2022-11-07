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
        $output = array();
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
$array = explode(' ', file_get_contents('lorem.txt'));
$table = new tableTool($array);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
     />
     <meta name="author" content="Piotr Tomaszkiewicz">
    <title>Interaktywna Tabela</title>
    <style>
        h1{
            text-align: center;
            font-family:'Helveltica';
            font-weight: 800;
            margin-top: 20px;
        }
        .tabelka{
            border-radius: 15px ;
            border:2px black solid;
            margin: 20px 50px;
            box-shadow: 0px 0px 10px black;
        }
        #formularz{
            margin: 20px 50px;  
        }
        #formularz input{
            text-align: center;
            padding: 2px 10px;
            border-radius: 5px;
            display:block;
            margin: 20px auto;
            width: 70%;
        }
        #formularz input:focus{
            outline:none;
            border: solid green 2px;
            background-color: lightgreen ;
            color: white;
        }
        #formularz h2{
            text-align: center;
        }
        button{
            font-weight: 600;
            padding: 4px 7px;
            background: white;
            border: 2px solid black;
            border-radius: 5px;
            text-align: center;
        }
        #newRowButt{
            display:block;
            margin: 20px auto;
        }
        button:hover{
           color:white;
           border:green solid 2px;
           background-color: lightgreen; 
        }
        footer{
            margin-top: 50px;
            width: 100%;
            padding: 50px 60px;
            background-color:green;
            color: white;
            display: inline-flex
        }
        footer p{
            font-weight: 700;
            display:block;
            margin: auto auto
        }
        footer a{
            color:white;
            display:block;
            margin: auto auto 
        }
        footer a:hover{
            color:lightgreen;
        }
    </style>
</head>
<body>
    <h1>Interaktywna Tabela</h1>
    <div class='tabelka'>
    <?php
    echo $table->renderHTML(5);
    ?>
    </div>
    <div id='formularz'>
        <h2>Dodaj rząd</h2>
        <br>
        <button id="newRowButt" onclick="addNewRow()">Zapisz</button>
    </div>
    <footer>
        <p>Strona stworzona przez Piotra Tomaszkiwicza</p>
        <a href='https://github.com/PTomaszkiewicz/2022-4gin-php-intro' target='_blank'>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
            </svg>
        </a>
    </footer>
    <script>
        function changeOnEnterTr(selectedelement){
            if(selectedelement.style.backgroundColor !== 'lightgray'){
                selectedelement.style.backgroundColor = 'lightgray';
            }
        }
        function changeOnLeaveTr(selectedelement){
            if(selectedelement.style.backgroundColor == 'lightgray'){
                selectedelement.style.backgroundColor = '';
            }
        }
        function changeOnEnterTd(selectedelement){
            if(selectedelement.style.fontWeight !== '1000'){
                selectedelement.style.fontWeight = '1000';
            }
        }
        function changeOnLeaveTd(selectedelement){
            if(selectedelement.style.fontWeight == '1000'){
                selectedelement.style.fontWeight = '';
            }
        }
        function removeRow(selectedRow){
            selectedRow.closest('tr').className += 'animate__animated animate__backOutLeft';
            setTimeout(() => {  selectedRow.closest('tr').remove(); }, 500);
        }
        function addNewRow(){
            var newRow = document.createElement('tr');
            newRow.setAttribute( 'onMouseEnter', 'changeOnEnterTr(this)');
            newRow.setAttribute( 'onMouseLeave', 'changeOnLeaveTr(this)');
            for(i=0; i<kol; i++){
                var newKom = document.createElement('td');
                newKom.setAttribute( 'onMouseEnter', 'changeOnEnterTd(this)');
                newKom.setAttribute( 'onMouseLeave', 'changeOnLeaveTd(this)');
                newKom.innerHTML = document.getElementById('inputNr'+i).value;
                newRow.appendChild(newKom);
            }   
            var nextId=document.querySelector('table').rows.length;
            newRow.setAttribute('id', 'rowId'+nextId)
            newRow.innerHTML += '<td><button onclick="removeRow(this)">Kasuj</button></td><td><button onclick="moveUp(this)" class="upbutt">Wyżej</button></td><td><button onclick="moveDown(this)" class="lowerbutt" >Niżej</button></td>';
            document.querySelector('table tbody').appendChild(newRow);
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-1].disabled = true;
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-2].disabled = false;
            newRow.className += 'animate__animated animate__backInLeft';
        }
        function moveUp(selectedRow){
            var currentRow= selectedRow.closest('tr')
            var rowIndex
            var allRows = document.querySelector('table').rows;
            for(i=0; i<allRows.length; i++){
                if(allRows[i].id==currentRow.id){
                    rowIndex=i;
                }
            }
            var upperIndex=rowIndex-1
            var currHTML= currentRow.innerHTML;
            var upperHTML = allRows[upperIndex].innerHTML;
            currentRow.className = 'animate__animated animate__flipOutX'
            allRows[upperIndex].className = 'animate__animated animate__flipOutX'
            function endChangeUpAnimation(){
            currentRow.innerHTML = upperHTML
            allRows[upperIndex].innerHTML = currHTML; 
            currentRow.className = 'animate__animated animate__flipInX'
            allRows[upperIndex].className = 'animate__animated animate__flipInX'
            document.getElementsByClassName("upbutt")[0].disabled = true;
            document.getElementsByClassName("upbutt")[1].disabled = false;
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-1].disabled = true;
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-2].disabled = false;
            }
            setTimeout(() => {  endChangeUpAnimation() }, 500);
        }
        function moveDown(selectedRow){
            var currentRow= selectedRow.closest('tr')
            var rowIndex
            var allRows = document.querySelector('table').rows;
            for(i=0; i<allRows.length; i++){
                if(allRows[i].id==currentRow.id){
                    rowIndex=i;
                }
            }
            var lowerIndex=rowIndex+1
            var currHTML= currentRow.innerHTML;
            var lowerHTML = allRows[lowerIndex].innerHTML;
            currentRow.className = 'animate__animated animate__flipOutX table table-dark table-striped'
            allRows[lowerIndex].className = 'animate__animated animate__flipOutX'
            function endChangeDownAnimation(){
            currentRow.innerHTML = lowerHTML
            allRows[lowerIndex].innerHTML = currHTML; 
            currentRow.className = 'animate__animated animate__flipInX'
            allRows[lowerIndex].className = 'animate__animated animate__flipInX'
            document.getElementsByClassName("upbutt")[0].disabled = true;
            document.getElementsByClassName("upbutt")[1].disabled = false;
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-1].disabled = true;
            document.getElementsByClassName("lowerbutt")[document.querySelectorAll('tr').length-2].disabled = false;
            console.log('eo')
            }
            setTimeout(() => {  endChangeDownAnimation() }, 500);
        }
        var row = document.querySelectorAll('tr');
        var kol = document.querySelector('table').rows[0].cells.length;
        var formButt = document.getElementById('newRowButt');

        row.forEach((element, index) => {element.setAttribute('id', 'rowId'+index ),
        element.innerHTML += '<td><button onclick="removeRow(this)">Kasuj</button></td><td><button onclick="moveUp(this)" class="upbutt">Wyżej</button></td><td><button onclick="moveDown(this)" class="lowerbutt" >Niżej</button></td>', 
        element.setAttribute( 'onMouseEnter', 'changeOnEnterTr(this)'),
        element.setAttribute( 'onMouseLeave', 'changeOnLeaveTr(this)')});

        document.getElementsByClassName("upbutt")[0].disabled = true;
        document.getElementsByClassName("lowerbutt")[row.length-1].disabled = true;

        var kom = document.querySelectorAll('th, td');

        kom.forEach(element => {element.setAttribute( 'onMouseEnter', 'changeOnEnterTd(this)'),
        element.setAttribute( 'onMouseLeave', 'changeOnLeaveTd(this)')});

        for (i=0; i<kol; i++){
            var newInput = document.createElement('input');
            newInput.setAttribute('id', 'inputNr'+i);
            document.getElementById('formularz').insertBefore(newInput, formButt);
        }
        document.querySelector('table').className += 'table table-striped';
    </script>
</body>
</html>