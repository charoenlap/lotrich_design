<?php 
    class YeekeeController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            // $data['descreption'] = "";
            $data['date'] 		= '';
            $result_round = $this->model('yeekee')->getRound();
            $this->view('yeekee/home',$data); 
        }
    }
?>