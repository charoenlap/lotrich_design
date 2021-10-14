<?php  
	class DepositController extends Controller{
		public function index(){
			$data = array();
			$this->view('deposit/index',$data);
		}
	}
?>