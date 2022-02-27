<?php  
	class DepositController extends Controller{
		public function index(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$data = array();
				$data['date'] = $date = get('date');
				$deposit = $this->model('finance')->getDeposit(array('date'=>$date));
				
				$data['deposit'] = $deposit;
				$this->view('deposit/index',$data);
			}else{
				redirect('home/login');
			}
		}
		public function addDeposit(){
			$result = array(
				'status' => 'failed'
			);
			if(method_post()){
				$id_transection = decrypt(post('id_transection'));

				$arr = array(
					'id_transection'	=> $id_transection
				);
				$result_add_deposit = $this->model('finance')->addDeposit($arr);
				if($result_add_deposit['result']=="success"){
					$result = array(
						'status' 	=> 'success',
						'desc'		=> 'ระบบได้ทำการเพิ่มยอดเงินฝากไปยังผู้ใช้งานที่แจ้งเข้ามาเรียบร้อยแล้ว'
					);
				}else{
					$result = array(
						'status' => 'failed',
						'desc' 	=> $result_add_deposit['desc']
					);
				}
			}
			echo json_encode($result);
		}
		public function editDeposit(){
			$result = array(
				'status' => 'failed'
			);
			if(method_post()){
				$id_transection = decrypt(post('id_transection'));
				$amount = post('amount');
				$time 	= post('time');

				$arr = array(
					'id_transection'	=> $id_transection,
					'amount'			=> $amount,
					'time'				=> $time
				);
				$result_add_deposit = $this->model('finance')->editDeposit($arr);
				if($result_add_deposit['result']=="success"){
					$result = array(
						'status' 	=> 'success',
						'desc'		=> 'ระบบได้ทำการปรับเรียบร้อยแล้ว'
					);
				}else{
					$result = array(
						'status' => 'failed',
						'desc' 	=> $result_add_deposit['desc']
					);
				}
			}
			echo json_encode($result);
		}
		public function cancleDeposit(){
			$result = array(
				'status' => 'failed'
			);
			if(method_post()){
				$id_transection = decrypt(post('id_transection'));

				$arr = array(
					'id_transection'	=> $id_transection
				);
				$result_add_deposit = $this->model('finance')->cancleDeposit($arr);
				if($result_add_deposit['result']=="success"){
					$result = array(
						'status' 	=> 'success',
						'desc'		=> 'ระบบได้ทำการหักยอดเงินฝากของผู้ใช้งานที่แจ้งเข้ามาเรียบร้อยแล้ว'
					);
				}else{
					$result = array(
						'status' => 'failed',
						'desc' 	=> $result_add_deposit['desc']
					);
				}
			}
			echo json_encode($result);
		}
	}
?>