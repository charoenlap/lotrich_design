<?php 
    class ResultController extends Controller {
        public function index() {
            $data = array();
            $arr = array();
            if(method_get()){
            	// $date_lasted = $this->model('master')->getDateLastedResult();
	            $data['date'] = (get('date')?get('date'):date('Y-m-d'));
	            $arr = array(
	            	'date' => $data['date']
	            );
	        }

	        $data['action'] = route('result&date='.$data['date']);
	        $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['category'] = $this->model('master')->getCategory($arr);
            $data['yeekee'] = $this->model('master')->getLastResultYeekee();
            // echo "<pre>";
            // var_dump($data['category']);
            $this->view('result',$data); 
        }
    }
?>