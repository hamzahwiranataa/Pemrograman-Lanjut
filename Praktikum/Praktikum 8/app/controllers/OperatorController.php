<?php
require_once '../app/models/OperatorModel.php';

class OperatorController {
    private $Operator;

    public function __construct() {
        $this->Operator = new Operator();
    }
    public function index() {
        require_once  '../app/views/operator/home.php';
    }
}
?>