<?php 
    class ForgotController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['link_line'] = route('contact');
            $this->view('forgot',$data); 
        }
    }
?>