<?php 
	class MemberController extends Controller {
	    public function package(){
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$data = array();
		    	$data['title'] = "Package";
		    	$data['descreption'] = "";
		    	// $data['balance'] 	= $this->model('finance')->getBalance($id_user);
		    	
		    	$id_lotto = get('id');
		    	$id_lotto = decrypt($id_lotto);
		    	$data['id_lotto'] = $id_lotto;
		    	// echo $id_lotto.'<';
		    	$data['link_lotto'] = route('member/lottery');
		    	$data['package'] = $this->model('master')->getPackage($id_lotto);
		    	$data['detail'] = $this->model('master')->getCategoryDetail($id_lotto);
	 	    	$this->view('member/package',$data); 
	 	    }else{
	 	    	redirect('login');
	 	    }
	    }
	    public function lottery(){
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$data = array();
				$id_package = get('id_package');
		    	$id_package = decrypt($id_package);
		    	if(empty($id_package)){

			    	$data['title'] = "lottery";
			    	$data['descreption'] = "";
			    	$data['balance'] 	= $this->model('finance')->getBalance($id_user);
			    	
			    	$id_lotto = get('id');
			    	$id_lotto_session = $this->getSession('id_lotto');

			    	if($id_lotto != $id_lotto_session){
			    		$this->setSession('id_lotto',$id_lotto);
			    		$this->setSession('lotto',array());
			    	}
			    	$data['lotto'] = $this->getSession('lotto');
			    	$data['detail'] = $this->model('master')->getCategoryDetail(decrypt($id_lotto));
			    	$data['id_package'] = encrypt($id_package);
		 	    	$this->view('member/lottery',$data); 
		 	    }else{
		 	    	$this->redirect('member/dashboard&result=ไม่พบแพคเกจ');
		 	    }
	 	    }else{
	 	    	redirect('login');
	 	    }
	    }
	    public function delLotto(){
	    	$result = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
		    	if(method_post()){
		    		$new_lotto = array();

					$type 		= post('type');
					$id_type 	= (int)post('id_type');
					$number 	= (int)post('number');
					$price 		= (float)post('price');
					$ratio 		= (float)post('ratio');
					$paid 		= (float)post('paid');

					$lotto = $this->getSession('lotto');
					
					foreach($lotto as $val){
						if($val['type']==$type AND $val['id_type']==$id_type AND $val['number']==$number AND $val['price']==$price AND $val['ratio']==$ratio AND $val['paid']==$paid){
							continue;
						}else{
							$new_lotto[] = array(
								'type' => $val['type'],
								'id_type' => $val['id_type'],
								'number' => $val['number'],
								'price' => $val['price'],
								'ratio' => $val['ratio'],
								'paid' => $val['paid'],
							);
						}
					}
					// $this->setSession('lotto',array());
					$this->setSession('lotto',$new_lotto);
					$result = array(
		    			'status' 	=> 'success',
		    			'desc'		=> 'ลบเสร็จเรียบร้อย',
		    			'detail'	=> $new_lotto,
		    			'detail2'	=> $lotto,
						'type'		=> $type,
						'id_type'	=> $id_type,
						'number'	=> $number,
						'price'		=> $price,
						'ratio'		=> $ratio,
						'paid'		=> $paid,
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
	    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
	    		);
	 	    }
	 	    echo json_encode($result);
	    }
	    public function addLotto(){
	    	$result = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
		    	if(method_post()){
					$price 		= (float)post('price');
					if($price>0){
						$number 	= (int)post('number');
						$id_type 	= post('id_type');
						$id_category = decrypt(post('id_category'));
						$arr = array(
							'id_type' 	=> $id_type,
							'id_category'	=> $id_category
						);
						$lotto = $this->model('lotto')->getRatio($arr);
						if($lotto['ratio']>0){
							$result_lotto = array(
								'number' => $number,
								'price' => $price,
								'id_type' => $id_type,
								'ratio'	=> $lotto['ratio'],
								'paid'	=> (float)$lotto['ratio'] * $price ,
								'type'	=> $lotto['type']
							);
							$_SESSION['lotto'][] = $result_lotto;
							$result = array(
				    			'status' => 'success',
				    			'desc'	=> 'เพิ่มเรียบร้อย',
				    			'lotto' => $result_lotto
				    		);
						}else{
							$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'ระบบไม่สามารถเพิ่มรายนี้ให้กับท่านได้ เนื่องจากยังไม่มีการกำหนดราคา ratio '
				    		);
						}
					}else{
						$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'ระบบไม่สามารถเพิ่มรายในราคา 0 บาทได้'
			    		);
					}
		    	}else{
		    		$result = array(
	    			'status' => 'failed',
	    			'desc'	=> 'Method not allow'
	    		);
		    	}
	 	    }else{
	 	    	$result = array(
	    			'status' => 'failed',
	    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
	    		);
	 	    }
	 	    echo json_encode($result);
	    }
	    public function submitLotto(){
	    	$result = array();
	    	$result = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
		    	if(method_post()){
		    		$list_lotto = array();
					$id_type 		= post('id_type');
		    		$number 		= post('number');
		    		$paid 			= post('paid');
		    		$price 			= post('price');
		    		$ratio 			= post('ratio');
		    		$type 			= post('type');
		    		$id_category 	= decrypt(post('id_category'));
		    		$sum_price  = 0;
		    		$balance = $this->model('finance')->getBalance($id_user);
		    		foreach($id_type as $key => $val){
		    			if($price[$key]<=0){
		    				continue;
		    			}
		    			$list_lotto[] = array(
							'id_type' 	=> $val,
							'number' 	=> $number[$key],
							'paid' 		=> $paid[$key],
							'price' 	=> $price[$key],
							'ratio' 	=> $ratio[$key],
							'type' 		=> $type[$key],
							'status'	=> 0
		    			);
		    			$sum_price += (float)$price[$key];
		    		}
		    		if($sum_price<=$balance){
		    			$this->model('lotto')->addLotto($list_lotto,$id_user,$id_category,$sum_price);
		    			$this->model('finance')->widthdrawBalance($id_user,$sum_price);
			    		$this->setSession('lotto',array());
			    		$result = array(
			    			'status' => 'success',
			    			'desc'	=> 'ระบบได้เพิ่มโพยของท่านเรียบร้อยแล้ว'
			    		);
		    		}else{
		    			$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'ยอดคงเหลือของท่านไม่พอสำหรับการซื้อ'
			    		);
		    		}
	    		}else{
		    		$result = array(
		    			'status' => 'failed',
		    			'desc'	=> 'Method not allow'
		    		);
		    	}
	 	    }else{
	 	    	$result = array(
	    			'status' => 'failed',
	    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
	    		);
	 	    }
	 	    echo json_encode($result);
	    }
	    public function dashboard() {
	    	$data = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
		    	$data['title'] = "dashboard";
		    	$data['descreption'] = "";
		    	$data['category'] = $this->model('master')->getCategory();
		    	$data['link_package'] = route('member/package');
		    	$data['link_deposit'] = route('member/deposit');
				$data['link_widthdraw'] = route('member/widthdraw');
				$data['link_reward'] = route('member/reward');
				$data['link_ticket'] = route('member/ticket');
				$data['link_finance'] = route('member/finance');
				$data['name'] = $this->getSession('name');
				$data['lname'] = $this->getSession('lname');
				$data['balance'] 	= $this->model('finance')->getBalance($id_user);
	 	    	$this->view('member/dashboard',$data); 
	 	    }else{
	 	    	$this->redirect('login');
	 	    }
	    }
	    public function widthdraw(){
	    	$data = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$data['title'] = "widthdraw";
	    		$data['descreption'] = "";
	    		$data['balance'] 	= $this->model('finance')->getBalance($id_user);
	    		$data['bank']		= $this->model('setting')->getSetting()['bank'];
 	    		$this->view('member/widthdraw',$data); 
 	    	}else{
	 	    	$this->redirect('login');
	 	    }
	    }
	    public function submitWidthdraw(){
	    	$result = array(
	    		'result' => 'failed',
	    		'desc' 	 => 'Method not allow'
	    	);
	    	if(method_post()){
		    	$id_user = decrypt($this->getSession('id'));
				if(!empty($id_user)){
	 	    		$price = (float)post('price');
	 	    		if($price>=0){
		 	    		$balance = $this->model('finance')->getBalance($id_user);
		 	    		$min_widthdraw = $this->model('setting')->getSetting()['min_widthdraw'];
		 	    		if($price>=$min_widthdraw){
		 	    			if($balance>$price){
			 	    			$finance = $this->model('finance');
			 	    			$arr = array(
									'id_user'		=> $id_user,
									'amount'		=> $price,
									'type'			=> 1,
									'status'		=> 0,
									'hour'			=> 0,
									'minutes'		=> 0,
									'img'			=> '',
									'detail'		=> 'การถอน'	
			 	    			);
			 	    			$finance->widthdraw($arr);
			 	    			$result = array(
					    			'status' => 'success',
					    			'desc'	=> 'ระบบได้ข้อมูลการถอนของท่านแล้ว กำลังรอเจ้าหน้าที่ทำการอนุมัติ และโอนเงินไปยังบัญชีของท่าน'
					    		);
			 	    		}else{
			 	    			$result = array(
					    			'status' => 'failed',
					    			'desc'	=> 'การถอนยอด '.$price.' ของคุณน้อยกว่าจำนวนที่คุณมี '.$balance
					    		);
			 	    		}
		 	    		}else{
		 	    			$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'การถอนยอดขั้นต่ำ '.$min_widthdraw.' บาท'
				    		);
		 	    		}
		 	    	}else{
		 	    		$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'จำนวนเงิน '.$price.' ไม่สามารถถอนได้'
			    		);
		 	    	}
		 	    }else{
		 	    	$result = array(
		    			'status' => 'failed',
		    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
		    		);
		 	    }
		 	}
		 	echo json_encode($result);
	    }
		public function reward(){
			$data = array();
	    	$data['title'] = "reward";
	    	$data['descreption'] = "";
 	    	$this->view('member/reward',$data); 
		}
		public function ticket(){
			$data = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$data = array();
		    	$data['title'] = "ticket";
		    	$data['descreption'] = "";
		    	$data['lotto'] = $this->model('lotto')->getLotto($id_user)['bill'];
	 	    	$this->view('member/ticket',$data); 
	 	    }else{
	 	    	$this->redirect('login');
	 	    } 
		}
		public function finance(){
			$data = array();
			$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
		    	$data['title'] = "finance";
		    	$data['descreption'] = "";
		    	$finance = $this->model('finance');
		    	$data['transection'] = $finance->getTransection($id_user);
	 	    	$this->view('member/finance',$data); 
	 	    }else{
	 	    	$this->redirect('login');
	 	    }
		}
	    public function deposit(){
	    	$data = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$data['title'] = "deposit";
	    		$data['descreption'] = "";
	    		$data['balance'] 	= $this->model('finance')->getBalance($id_user);
	    		$data['bank_no']		= $this->getSession('bank_no');
	    		$data['bank_name']		= $this->getSession('bank_name');

	    		$data['bank_no_2']		= $this->getSession('bank_no_2');
	    		$data['bank_name_2']	= $this->getSession('bank_name_2');

	    		$data['name']			= $this->getSession('name');
 	    		$this->view('member/deposit',$data); 
 	    	}else{
	 	    	$this->redirect('login');
	 	    }
	    }
	    public function depositSubmit(){
	    	$result = array(
	    		'status' 	=> 'failed',
	    		'desc'		=> 'Method not allow'
	    	);
	    	if(method_post()){
	    		$id_user = decrypt($this->getSession('id'));
	    		if(!empty($id_user)){
		    		$price 		= (float)post('price');
					$hour 		= (int)post('hour');
					$minutes 	= (int)post('minutes');
					if($price>0){
						$file_name = (isset($_FILES['file']['name'])?$_FILES['file']['name']:'');
						if(!empty($file_name)){
							$info = getimagesize($_FILES['file']['tmp_name']);
							if ($info === FALSE) {
							   $result = array(
					    			'status' => 'failed',
					    			'desc'	=> 'ไม่สามารถตรวจสอบไฟล์รูปได้'
					    		);
							}else{
								if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
									$result = array(
						    			'status' => 'failed',
						    			'desc'	=> 'ระบบรองรับไฟล์นามสกุล jepg jpg png เท่านั้น'
						    		);
								}else{
									$image_name = time().'_'.rand(1000,9999).'_'.$_FILES['file']['name'];
									$path = PATH_UPLOAD;
									$result_upload = upload($_FILES['file'],$path,$image_name);
									if($result_upload){
										$finance = $this->model('finance');
										$arr = array(
											'id_user'		=> $id_user,
											'amount' 		=> $price,
											'type'			=> 'deposit',
											'status'		=> 0,
											'hour'			=> $hour,
											'minutes'		=> $minutes,
											'img'			=> $image_name,
											'detail'		=> 'ฝากเงิน'
										);
										$deposit = $finance->deposit($arr);
										$result = array(
							    			'status' => 'success',
							    			'desc'	=> 'แจ้งชำระเงินเสร็จเรียบร้อย กรุณารอซํกครู่ ทีมงานกำลังตรวจสอบ'
							    		);
									}
								}
							}
				    	}else{
				    		$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'ท่านไม่ได้แนบสลิป'
				    		);
				    	}
			    	}else{
			    		$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'กรุณารีโหลดหน้าเว็บใหม่อีกครั้ง แล้วกรอกตามคำแนะนำให้ถูกต้อง'
			    		);
			    	}
			    }else{
			    	$result = array(
		    			'status' => 'failed',
		    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
		    		);
			    }
	    	}
	    	echo json_encode($result);
	    }
	    public function check_file_upload(){
	    	$result = array(
	    		'status' 	=> 'failed',
	    		'desc'		=> 'Method not allow'
	    	);
	    	if(method_post()){
	    		$id_user = decrypt($this->getSession('id'));
	    		if(!empty($id_user)){
					$file_name = (isset($_FILES['file']['name'])?$_FILES['file']['name']:'');
					if(!empty($file_name)){
						$info = getimagesize($_FILES['file']['tmp_name']);
						if ($info === FALSE) {
						   $result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'ไม่สามารถตรวจสอบไฟล์รูปได้'
				    		);
						}else{
							if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
								$result = array(
					    			'status' => 'failed',
					    			'desc'	=> 'ระบบรองรับไฟล์นามสกุล jepg jpg png เท่านั้น'
					    		);
							}else{
								$result = array(
					    			'status' => 'success',
					    			'desc'	=> 'คุณสามารถใช้รูปภาพนี้ได้'
					    		);
							}
						}
			    	}else{
			    		$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'ท่านไม่ได้แนบสลิป'
			    		);
			    	}
			    }else{
			    	$result = array(
		    			'status' => 'failed',
		    			'desc'	=> 'การเข้าสู่ระบบของท่านไม่ถูกต้องกรุณาเข้าสู่ระบบใหม่อีกครั้ง'
		    		);
			    }
	    	}
	    	echo json_encode($result);
	    }
		public function password() {
	    	$data = array();
	    	$data['title'] = "password";
	    	$data['descreption'] = "";
	    	// $data['category'] = $this->model('master')->getCategory();
 	    	$this->view('member/password',$data); 
	    }
		public function logout() {
	    	$data = array();
	    	$this->setSession('id','');
            $this->setSession('email','');
            $this->setSession('name','');
            $this->setSession('lname','');
            $this->setSession('phone','');
            $this->setSession('bank_no','');
            $this->setSession('bank_name','');
 	    	$this->redirect('login'); 
	    }
	}
?>