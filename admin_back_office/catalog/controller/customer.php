<?php
	class CustomerController extends Controller{
		public function index(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$data = array();
				// $data['deposit'] = $this->model('finance')->getDeposit()['deposit'];
				$data['customer'] = $this->model('user')->listUser();
				$this->view('customer/index',$data);
			}else{
				redirect('home/login');
			}
		}
		public function edit(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$id = decrypt(get('id'));
				$data['cus'] = $this->model('user')->getUser($id)['row'];
				$data['action'] = route('customer/editSubmit&id='.get('id'));
				$this->view('customer/edit',$data);
			}
		}
		public function editSubmit(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$input = $_POST;
					$id = decrypt(get('id'));
					unset($input['route']);
					$this->model('user')->editProfile($input,$id);
					redirect('customer');
				}
			}
		}
		public function del(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$id = decrypt(get('id'));
				$data['customer'] = $this->model('user')->del($id);
				redirect('customer');
			}
		}
		public function undel(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$id = decrypt(get('id'));
				$data['customer'] = $this->model('user')->undel($id);
				redirect('customer');
			}
		}
		// public function editPhone(){
		// 	$id_admin = $this->getSession('id_admin');
		// 	if($id_admin){
		// 		$id = decrypt(get('id'));
		// 		$val = get('val');
		// 		$data['customer'] = $this->model('user')->editPhone($id);
		// 		redirect('customer');
		// 	}
		// }
	}  
?>