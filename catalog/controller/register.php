<?php 
    class RegisterController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $this->view('register',$data); 
        }
    }
?>