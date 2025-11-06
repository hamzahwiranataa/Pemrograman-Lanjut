<?php
require_once  '../app/models/SuperAdminModel.php';

class SuperAdminController {
    private $SuperAdmin;

    public function __construct() {
        $this->SuperAdmin = new SuperAdmin();
    }

    public function index() {
        require_once  '../app/views/superadmin/home.php';
    }
}
?>