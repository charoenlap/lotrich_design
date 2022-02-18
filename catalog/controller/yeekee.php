<?php 
    class YeekeeController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            // $data['descreption'] = "";
            // $this->view('contact',$data); 
            $result_round = $this->model('master')->getRoundShow();
            $data['round'] = $result_round;
            $data['id'] = get('id');
            
            $this->view('yeekee/home',$data);
        }
    }
?>