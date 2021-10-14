<?php 
    class LoginController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $this->view('login',$data); 
        }
    }
?>