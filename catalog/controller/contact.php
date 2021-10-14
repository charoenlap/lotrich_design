<?php 
    class ContactController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $this->view('contact',$data); 
        }
    }
?>