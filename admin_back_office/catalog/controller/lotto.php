<?php  
	class LottoController extends Controller{
		public function index(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$data = array();
				$data['category'] = $this->model('master')->listCategory();
				// $data['deposit'] = $this->model('finance')->getDeposit()['deposit'];
				$this->view('lotto/index',$data);
			}else{
				redirect('home/login');
			}
		}
		public function categoryDetail(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$data = array();
				$id_category = (int)decrypt(get('id_category'));
				$id_package = (int)get('id_package');

				$data['id_package'] = $id_package;
				$data['category'] 	= $this->model('master')->getCategory($id_category,'',$id_package);
				$data['listType']	= $this->model('master')->listType();
				$data['listPackage']= $this->model('master')->listPackage($id_category);

				$data['getBlockNo'] = $this->model('master')->getBlockNo();
				// var_dump($data['getBlockNo']);
				$data['id_category']	= get('id_category');
				$data['date_close'] 	= $data['category']['date_close'];
				$data['date_last_end'] 	= $data['category']['date_last_end'];
				$data['max_total'] 		= (float)$data['category']['max_total'];
				// echo "<pre>";
				// var_dump($data['category']);
				// $data['deposit'] = $this->model('finance')->getDeposit()['deposit'];
				$this->view('lotto/detail',$data);
			}else{
				redirect('home/login');
			}
		}
		public function getResultBlockNo(){
			$result = array(
				'status' => 'failed',
				'desc'	=> ''
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$id_category 	= (int)decrypt(post('id_category'));
				$date 			= post('date');
				$data['listBlockNo']= $this->model('master')->listBlockNo($id_category,$date);
				// $result = $this->model('master')->getCategory($id_category,$date);
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function getResultRatio(){
			$result = array(
				'status' => 'failed',
				'desc'	=> ''
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				$id_category 	= (int)decrypt(post('id_category'));
				$date 			= post('date');
				$result = $this->model('master')->getCategory($id_category,$date);
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function submitLotto(){ 
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$result_text_type = '';
					$id_category 	= (int)decrypt(get('id_category'));
					$date 			= post('date');
					$date_end 		= post('date_end');
					$date_last_end 	= post('date_last_end');
					$max_total 		= post('max_total');
					$ratio 			= post('ratio');
					$id_package 	= (int)post('id_package');
					$chkCalculate 	= (int)post('chkCalculate'); 

					$result_edit_date_end 	= $this->model('master')->saveDateEnd($date_end,$date_last_end,$id_category,$max_total);
					$result_ratio 			= $this->model('master')->addRatio($ratio,$id_category,$id_package);
					$result_text_type .= 'เพิ่มอัตราการต่อรองเรียบร้อย ';
					if(!empty($date)){
						$result = post('result');
						$result_type = $this->model('master')->addType($result,$date,$id_category);
						if($chkCalculate){
							$arr_calculate = array(
								'date_end' 		=> $date_end,
								'date_last_end' => $date_last_end,
								'date'			=> $date
							);
							$result_calculate_rollback = $this->model('master')->calculateRollbackAllBill($arr_calculate);
							$result_calculate = $this->model('master')->calculateAllBill($arr_calculate);
						}
						$result_text_type .= ' เพิ่มประเภทเรียบร้อย';
					}
					$result = array(
						'status' 		=> 'success',
						'desc'			=> $result_text_type,
						'post'			=> $_POST,
						'id_category'	=>$id_category
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
		public function addPackage(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category = (int)decrypt(post('id_category'));
					$package = post('package');
					$discount = post('discount');
					$result_insert_package = $this->model('package')->addPackage($package,$id_category,$discount);
					if($result_insert_package['result']=="success"){
						$result = array(
							'status' => 'success',
							'desc'	=> 'เพิ่มแพคเกจเรียบร้อย'
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function delType(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category 	= (int)decrypt(post('id_category'));
					$id_type 		= post('id_type');
					$date 			= post('date');

					$result_insert_package = $this->model('master')->delResultType($id_type,$id_category,$date);
					if($result_insert_package['result']=="success"){
						$result = array(
							'status' => 'success',
							'desc'	=> 'ลบแพคเกจเรียบร้อย'
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function delPackage(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category = (int)decrypt(post('id_category'));
					$id_package = post('id_package');
					$result_insert_package = $this->model('package')->delPackage($id_package,$id_category);
					if($result_insert_package['result']=="success"){
						$result = array(
							'status' => 'success',
							'desc'	=> 'ลบแพคเกจเรียบร้อย'
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function delRatio(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					// $id_category = (int)decrypt(post('id_category'));
					$id_ratio = post('id_ratio');
					$result_insert_package = $this->model('master')->delRatio($id_ratio);
					if($result_insert_package['result']=="success"){
						$result = array(
							'status' => 'success',
							'desc'	=> 'ลบอัตราการต่อรองเรียบร้อย',
							'id_ratio' => $id_ratio
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function getBlockNo(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category = (int)decrypt(post('id_category'));
					$date 		= post('date');
					$result_block_no = $this->model('master')->listBlockNo($id_category,$date);
					$result = array(
						'status' => 'success',
						'rows'	=> $result_block_no,
						'desc'	=> 'เรียบร้อย'
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
		public function getBlockNoAll(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category = (int)decrypt(post('id_category'));
					$date 		= post('date');
					$result_block_no = $this->model('master')->listBlockNoAll($id_category,$date);
					$result = array(
						'status' => 'success',
						'rows'	=> $result_block_no,
						'desc'	=> 'เรียบร้อย'
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
		public function getBlockNoType(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id_category = (int)decrypt(post('id_category'));
					$date 		= post('date');
					$result_block_no = $this->model('master')->listBlockNoType($id_category,$date);
					$result = array(
						'status' => 'success',
						'rows'	=> $result_block_no,
						'desc'	=> 'เรียบร้อย'
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
		public function delBlockNoType(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id 		= post('id');
					$result_block_no = $this->model('master')->delBlockNoType($id);
					$result = array(
						'status' => 'success',
						'desc'	=> 'เรียบร้อย'
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
		public function delBlockNoTypeAll(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id 		= post('id');
					$result_block_no = $this->model('master')->delBlockNoTypeAll($id);
					$result = array(
						'status'=> 'success',
						'desc'	=> 'เรียบร้อย'
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
		public function delBlockNo(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id 		= post('id');
					$result_block_no = $this->model('master')->delBlockNo($id);
					$result = array(
						'status' => 'success'
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
		public function addBlockNo(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					// $id_category = (int)decrypt(post('id_category'));
					$num = post('num');
					$ratio_price = (int)post('ratio_price');
					$max_price = post('max_price');
					$date_block = post('date_block');
					$id_category = (int)decrypt(post('id_category'));
					$id_type = (int)post('id_type');
					

					$date = explode(' ',$date_block);
					if(!empty($date[0])){
						$data_insert = array(
							'num' => $num,
							'ratio_price' => $ratio_price,
							'max_price' => $max_price,
							'date_block' => $date[0],
							'id_category' => $id_category,
							'id_type' => $id_type,
						);

						$result_insert_package = $this->model('master')->addBlockNo($data_insert);
						if($result_insert_package['result']=="success"){
							$result = array(
								'status' => 'success',
								'desc'	=> 'เพิ่มตัวเลขอั้นเข้าสู่ระบบเรียบร้อย',
								'data_insert' => $data_insert
							);
						}
					}else{
						$result = array(
							'status' => 'failed',
							'desc'	=> 'กรุณาเลือกวันที่ ที่ต้องการเพิ่มเลขอั้นก่อน'
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function delBlockNoAll(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id 		= post('id');
					$result_block_no = $this->model('master')->delBlockNoAll($id);
					$result = array(
						'status' => 'success'
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
		public function editDiscountPackage(){
			$result = array(
				'status' => 'failed'
			);
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					$id 		= post('id');
					$val 		= post('val');
					$result 	= $this->model('master')->editDiscountPackage($id,$val);
					$result = array(
						'status' => 'success'
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
		public function addBlockNoAll(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					// $id_category = (int)decrypt(post('id_category'));
					$num = post('num');
					$id_condition_detail = (int)post('id_condition_detail');
					$max_price = post('max_price');
					$date_block = post('date_block');
					$id_category = (int)decrypt(post('id_category'));
					$id_type = (int)post('id_type');

					$date = explode(' ',$date_block);
					if(!empty($date[0])){
						$data_insert = array(
							'num' => $num,
							'id_condition_detail' => $id_condition_detail,
							'max_price' => $max_price,
							'date_block' => $date[0],
							'id_category' => $id_category,
							'id_type' => $id_type,
						);

						$result_insert_package = $this->model('master')->addBlockNoAll($data_insert);
						if($result_insert_package['result']=="success"){
							$result = array(
								'status' => 'success',
								'desc'	=> 'เพิ่มตัวเลขอั้นเข้าสู่ระบบเรียบร้อย',
								'data_insert' => $data_insert
							);
						}
					}else{
						$result = array(
							'status' => 'failed',
							'desc'	=> 'กรุณาเลือกวันที่ ที่ต้องการเพิ่มเลขอั้นก่อน'
						);
					}
				}
			}else{
				$result = array(
					'status' => 'failed',
					'desc'	=> 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง'
				);
			}
			echo json_encode($result);
		}
		public function addBlockNoType(){
			$id_admin = $this->getSession('id_admin');
			if($id_admin){
				if(method_post()){
					// $id_category = (int)decrypt(post('id_category'));
					$num = post('num');
					$id_condition_detail = (int)post('id_condition_detail');
					$max_price = post('max_price');
					$date_block = post('date_block');
					$id_category = (int)decrypt(post('id_category'));
					$id_type = (int)post('id_type');

					$date = explode(' ',$date_block);
					if(!empty($date[0])){
						$data_insert = array(
							// 'num' => $num,
							// 'id_condition_detail' => $id_condition_detail,
							'max_price' => $max_price,
							'date_block' => $date[0],
							'id_category' => $id_category,
							'id_type' => $id_type,
						);

						$result_insert_package = $this->model('master')->addBlockNoType($data_insert);
						if($result_insert_package['result']=="success"){
							$result = array(
								'status' => 'success',
								'desc'	=> 'เพิ่ม ประเภทเลขอั้นเข้าสู่ระบบเรียบร้อย',
								'data_insert' => $data_insert
							);
						}
					}else{
						$result = array(
							'status' => 'failed',
							'desc'	=> 'กรุณาเลือกวันที่ ที่ต้องการเพิ่มเลขอั้นก่อน'
						);
					}
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