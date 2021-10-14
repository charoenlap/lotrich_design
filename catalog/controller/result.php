<?php 
    class ResultController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['category'] = $this->model('master')->getCategory();
            $this->view('result',$data); 
        }
    }
?>