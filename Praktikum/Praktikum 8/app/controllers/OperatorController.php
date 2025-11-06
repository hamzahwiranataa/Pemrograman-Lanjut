<?php
require_once '../app/models/OperatorModel.php';

class OperatorController {
    private $Operator;

    public function __construct() {
        $this->Operator = new Operator();
    }
    public function index() {
        $username = $_SESSION['username'];
        $row = $this->Operator->GetUserData($username);
        require_once  '../app/views/operator/home.php';
    }
}
?>