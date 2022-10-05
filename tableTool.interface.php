<?php
interface tableToolInterface {
    public function __construct($data);
    public function renderHTML($cols, $filterString='');
    public function renderCSV($cols, $filterString='');
    public function renderMD($cols, $filterString='');
}