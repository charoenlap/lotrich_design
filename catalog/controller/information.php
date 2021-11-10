<?php 
    class InformationController extends Controller {
        public function condition() {
            $data = array();
            $data['title'] = "เงื่อนไข";
            $data['descreption'] = "";
            $this->view('information/condition',$data); 
        }
        public function rule() {
            $data = array();
            $data['title'] = "กฎข้อบังคับ";
            $data['descreption'] = "";
            $this->view('information/rule',$data); 
        }
    }
?>