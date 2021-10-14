<?php
	class CustomerController extends Controller{
		public function index(){
			$data = array();
			$this->view('customer/index',$data);
		}
		public function edit(){
			$this->view('customer/edit');
		}
	}  
?>