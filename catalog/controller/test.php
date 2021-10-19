<?php 
    class TestController extends Controller {
        public function index() {
            $data = array();
            $Geographies = $this->model('master')->getGeographies();
            var_dump($Geographies);
        }
    }
?>