<?php  
	class SystemController extends Controller{
		public function index(){
			$data = array();
			$data['setting'] = $this->model('system')->getSetting();
			$this->view('system/index',$data);
		}
	}
?>