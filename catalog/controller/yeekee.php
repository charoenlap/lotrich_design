<?php 
    class YeekeeController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            // $data['descreption'] = "";
            // $this->view('contact',$data); 
            $result_round = $this->model('master')->getRound();
            $data['round'] = $result_round;
            
            $this->view('yeekee/home',$data);
        }
    }
?>