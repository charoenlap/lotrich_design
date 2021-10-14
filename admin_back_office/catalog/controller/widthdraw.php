<?php  
	class WidthdrawController extends Controller{
		public function index(){
			$data = array();
			$this->view('widthdraw/index',$data);
		}
	}
?>