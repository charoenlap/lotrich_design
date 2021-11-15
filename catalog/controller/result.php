<?php 
    class ResultController extends Controller {
        public function index() {
            $data = array();
            $arr = array();
            if(method_get()){
            	$date_lasted = $this->model('master')->getDateLastedResult();
	            $data['date'] = (get('date')?get('date'):$date_lasted);
	            $arr = array(
	            	'date' => $data['date']
	            );
	        }

	        $data['action'] = route('result&date='.$data['date']);
	        $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['category'] = $this->model('master')->getCategory($arr);
            $this->view('result',$data); 
        }
    }
?>