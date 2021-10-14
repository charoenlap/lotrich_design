<?php  
	class LottoController extends Controller{
		public function index(){
			$data = array();
			$this->view('lotto/index',$data);
		}
	}
?>