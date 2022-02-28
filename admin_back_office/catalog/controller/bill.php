<?php  
	class BillController extends Controller{
		public function index(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$data = array();
				$data['date'] 			= get('date');
				$data['date_end'] 		= get('date_end');
				if(empty($data['date']) AND empty($data['date_end'])){
					$data['date'] = $data['date_end'] = $this->model('master')->getLastDateCategory(1);
				}
				$data['id_category']	= (int)get('category');
				$data['id_type']		= (int)get('type');
				$data['order']			= get('order');

				$data['category'] 	= $this->model('master')->listCategory();
				$data['type'] 		= $this->model('master')->listType();
				$data['action'] 	= route('bill');
				// $data['category'] = $this->model('master')->listCategory();
				// $data['deposit'] = $this->model('finance')->getDeposit()['deposit'];
				$data_select = array(
					'date' 			=> $data['date'],
					'date_end' 		=> $data['date_end'],
					'id_category' 	=> $data['id_category'],
					'id_type' 		=> $data['id_type'],
					'order'			=> $data['order']
				);
				$data['lotto'] = $this->model('finance')->getLotto($data_select);
				$this->view('bill/index',$data);
			}else{
				redirect('home/login');
			}
		}
		public function submitBill(){
			$result = array();
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){ 
					$id_bill = decrypt(post('id_bill'));
					$date = post('date');
					$arr = array(
						'id_bill' 	=> $id_bill,
						'date'		=> $date
					);
					$result = $this->model('finance')->submitBill($arr);
					echo json_encode($result);
				}
			}
		}
		public function getBill(){
			$result = array();
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){ 
					$id_bill = decrypt(post('id_bill'));
					$result_bill = $this->model('finance')->getLottoDetail($id_bill);
					$result = array(
						'status' => 'success',
						'desc'	=> '',
						'result_bill' => $result_bill,
						'post'	=> $_POST,
						'id_bill' => $id_bill
					);
				}else{
					$result = array(
						'status' => 'failed',
						'desc'	=> 'Method not allow'
					);
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
	}
?>