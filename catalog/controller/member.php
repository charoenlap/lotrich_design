<?php 
	class MemberController extends Controller {
	    public function package(){
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$id_lotto_encrypt = get('id');
		    	$id_lotto = decrypt($id_lotto_encrypt);

		    	$id_round = (int)decrypt(get('id_round'));
		    	// echo $id_lotto.'/'.$id_round.'<br>';
		    	// จับยี่กี
		    	if($id_lotto=="24"){
		    		if(empty($id_round)){
		    			redirect('yeekee&id='.$id_lotto_encrypt);
		    		}else{
		    			$result_lock = $this->model('lotto')->checkTimeover(array('id_category'=>$id_lotto));
						if($result_lock){
							$data = array();
					    	$data['title'] = "Package";
					    	$data['descreption'] = "";
					    	// $data['balance'] 	= $this->model('finance')->getBalance($id_user);
					    	// $data['id_round'] = (int)decrypt(get('id_round'));
					    	$data['id_lotto'] = $id_lotto;
					    	// echo $id_lotto.'<';
					    	$para = '';
					    	if($id_round){
					    		$para = "&id_round=".encrypt($id_round);
					    	}
					    	$data['link_lotto'] = route('member/lotteryNew'.$para);
					    	$data['package'] = $this->model('master')->getPackage($id_lotto);
					    	$data['detail'] = $this->model('master')->getCategoryDetail($id_lotto);
				 	    	$this->view('member/package',$data);  
				 	    }else{
				 	    	redirect('member/dashboard'); 
				 	    }
		    		}
		    	}else{
					$result_lock = $this->model('lotto')->checkTimeover(array('id_category'=>$id_lotto));
					if($result_lock){
						$data = array();
				    	$data['title'] = "Package";
				    	$data['descreption'] = "";
				    	// $data['balance'] 	= $this->model('finance')->getBalance($id_user);
				    	
				    	
				    	$data['id_lotto'] = $id_lotto;
				    	// echo $id_lotto.'<';
				    	$data['link_lotto'] = route('member/lotteryNew');
				    	$data['package'] = $this->model('master')->getPackage($id_lotto);
				    	$data['detail'] = $this->model('master')->getCategoryDetail($id_lotto);
			 	    	$this->view('member/package',$data);  
			 	    }else{
			 	    	redirect('member/dashboard'); 
			 	    }
			 	}
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
	    public function lotteryNew(){
	    	$data = array();
	    	$id_user = decrypt($this->getSession('id'));
			if(!empty($id_user)){
				$id_encrypt = get('id');
		    	$id = decrypt($id_encrypt);

		    	$data['id_round'] = $id_round = get('id_round');
		    	if($id_round){
					$decrypt_id_round = decrypt(get('id_round'));
					$time_current = date('ymdHi');
					if($time_current>$decrypt_id_round){
						redirect('yeekee&id='.$id_encrypt);
					}
				}
				$result_lock = $this->model('lotto')->checkTimeover(array('id_category'=>$id));
				if($result_lock){
					$data = array();
					$id_package = get('package');
					
					// var_dump($_GET);

			    	$id_package = decrypt($id_package);
			    	// echo $id_package;
			    	

			    	if(!empty($id_package)){
				    	$data['title'] = "lottery";
				    	$data['descreption'] = "";
				    	$data['balance'] 	= $this->model('finance')->getBalance($id_user);
				    	$arr = array(
				    		'id_category' => $id,
							'id_package' => $id_package
				    	);
				    	$data['listType'] = $this->model('lotto')->listType($arr);

				    	$id_lotto = get('id');
				    	$id_lotto_session = $this->getSession('id_lotto');

				    	if($id_lotto != $id_lotto_session){
				    		$this->setSession('id_lotto',$id_lotto);
				    		$this->setSession('id_lotto',$id_lotto);
				    		$this->setSession('lotto',array());
				    	}
				    	$data['lotto'] = $this->getSession('lotto');
				    	$data['detail'] = $this->model('master')->getCategoryDetail(decrypt($id_lotto));
				    	$data['id_package'] = encrypt($id_package);


				    	$n_000_249 = array();
						$n_250_499 = array();
						$n_000_499 = array();
						$n_500_749 = array();
						$n_750_999 = array();

						$n_000_499 = array();
						$n_500_999 = array();
						$n_000_999 = array();

				    	$n_00_49 = array();
				    	$n_50_99 = array();
				    	$n_00_99 = array();

				    	$n_odd = array();
				    	$n_even = array();

				    	for($i=0;$i<=999;$i++){
				    		if($i<=249){
					    		$n_000_249[] = $i;
					    	}
					    	if($i<=499){
					    		$n_000_499[] = $i;
					    	}
					    	if($i>=250 and $i<=499){
					    		$n_250_499[] = $i;
					    	}
					    	if($i>=500 and $i<=749){
					    		$n_500_749[] = $i;
					    	}
					    	if($i>=750 and $i<=999){
					    		$n_750_999[] = $i;
					    	}
					    	if($i<=49){
					    		$n_00_49[] = $i;
					    	}
					    	if($i>=50 and $i<=99){
					    		$n_50_99[] = $i;
					    	}
					    	if($i>=500 and $i<=999){
					    		$n_500_999[] = $i;
					    	}
					    	// if($i<=999){
					    	// 	$n_000_999[] = $i;
					    	// }
					    	if($i>=0 and $i<=99){
					    		$n_00_99[] = $i;
					    		if($i%2==0){
						    		$n_odd[] = $i;
						    	}else{
						    		$n_even[] = $i;
						    	}
					    	}

					    	
				    	} 
						$data_lotto = array(
							'3' => array(
								// '000-249' => array(
								// 	'data' => $n_000_249
								// ),
								// '250-499' => array(
								// 	'data' => $n_250_499,
								// ),
								// '500-749' => array(
								// 	'data' => $n_500_749,
								// ),
								// '750-999' => array(
								// 	'data' => $n_750_999,
								// ),
								// '000-499' => array(
								// 	'data' => $n_000_499,
								// ),
								// '500-999' => array(
								// 	'data' => $n_500_999,
								// ),
								// 'ตอง' => array(
								// 	'data' => array(000,111,222,333,444,555,666,777,888,999),
								// ),
								// '000-999' => array(
								// 	'data' => $n_000_999
								// ),						
							),
							'2' => array(
								'เลขเบิ้ล' => array(
									'data' => array(00,11,22,33,44,55,66,77,88,99)
								),
								'19 ประตู' => array(
									'digit' => 1
								),
								'รูดหน้า' => array(
									'digit' => 1,
									'data' => array(1,2,3,4,5,6,7,8,9,0)
								),
								'รูดหลัง' => array(
									'digit' => 1,
									'data' => array(1,2,3,4,5,6,7,8,9,0)
								),
								'00-49' => array(
									'data' => $n_00_49
								),
								'50-99' => array(
									'data' => $n_50_99
								),
								// 'สองตัวคู่' => array(
								// 	'data' => $n_odd
								// ),
								// 'สองตัวคี่' => array(
								// 	'data' => $n_even
								// ),
								// 'พี่น้อง' => array(
								// 	'data' => array('01',12,23,34,45,56,67,78,89,90)
								// ),
								// 'น้องพี่' => array(
								// 	'data' => array(10,21,32,43,54,65,76,87,98,'09')
								// ),
								// 'เลขคู่คู่' => array(
								// 	'data' => array('02','04','06','08',24,26,28,46,48,68,'00',22,44,66,88)
								// ),
								// 'เลขคี่คี่' => array(
								// 	'data' => array(13,15,17,19,35,37,39,57,59,79,11,33,55,77,99)
								// ),
								// 'เลขคู่คี่' => array(
								// 	'data' => array(13,15,17,19,35,37,39,57,59,79,11,33,55,77,99)
								// ),
								// '00-99' => array(
								// 	'data' => $n_00_99
								// ),
							)
						);

						$data['data_lotto'] = $data_lotto;

						$data['id_category'] = get('id');

						$date = $date_close = $data['detail']['date_close'];
						$date_last_close = $data['detail']['date_last_end'];
						$date = date_create($date);
						$date = date_format($date,"Y-m-d");
						// echo $date;
						$data['blockNumber'] = $this->model('lotto')->getBlockNumber($id,$date_close,$date_last_close);
						// echo $data['id_round'];
						$data['id_round'] = get('id_round');
			 	    	$this->view('member/lotteryNew',$data); 
			 	    }else{
			 	    	$this->redirect('member/dashboard&result=ไม่พบแพคเกจ');
			 	    }
			 	}else{
			 		$this->redirect('member/dashboard');
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
						$number = $number_default 	= array( (int)post('number') );
						$number = array_unique($number);
						$number_default = array_unique($number_default);
						
						$id_type_arr = $id_type = (array)post('id_type');
						$rdoType 	= post('rdoType');
						$digit 		= post('digit');
						$condition 	= post('condition');
						$chkType 	= post('chkType');
						// var_dump($id_type);
						// exit();
						$rows = array();
						if($id_type){
							if($rdoType == "19 ประตู"){
								$new_arr_number = array();
								for($i=0;$i<=9;$i++){
									$new_arr_number[] = $number[0].''.$i;
									$new_arr_number[] = $i.''.$number[0];
								}
								$number = array_unique($new_arr_number);
								sort($number);
								// var_dump($number);
							}else if($rdoType == "รูดหน้า"){
								$new_arr_number = array();
								for($i=0;$i<=9;$i++){
									$new_arr_number[] = $number[0].''.$i;
								}
								$number = array_unique($new_arr_number);
								sort($number);
								// var_dump($number);
							}else if($rdoType == "รูดหลัง"){
								$new_arr_number = array();
								for($i=0;$i<=9;$i++){
									$new_arr_number[] = $i.''.$number[0];
								}
								$number = array_unique($new_arr_number);
								sort($number);
								// var_dump($number);
							}else if($rdoType == "ปักหลักหน่วย" || $rdoType == "ปักหลักสิบ" || $rdoType == "ปักหลักร้อย"){
								$new_arr_number = array($number[0]);
								$id_type = array();
								if($rdoType=="ปักหลักหน่วย"){
									$id_type[] = 39;
								}else if($rdoType=="ปักหลักสิบ"){
									$id_type[] = 40;
								}else {
									$id_type[] = 41;
								}
								$number = $new_arr_number;
							}else if($rdoType == "4 ตัวโต๊ด" || $rdoType == "5 ตัวโต๊ด" || $rdoType == "4 ตัวบน"){
								$new_arr_number = array($number[0]);
								$id_type = array();
								if($rdoType=="4 ตัวโต๊ด"){
									$id_type[] = 42;
								}else if($rdoType=="5 ตัวโต๊ด"){
									$id_type[] = 43;
								}else {
									$id_type[] = 44;
								}
								$number = $new_arr_number;
							}
							
							// $number = $number_default;
							if(in_array(9,$id_type)){
								$id_type = array();
								$new_arr_number = str_pad($number[0],3,"0", STR_PAD_LEFT);
								$number = getCombinations($new_arr_number,3);
								
								if(in_array(3,$id_type_arr) and in_array(2,$id_type_arr)){
									$id_type[] = 3; // สามตัวล่าง
								}else if(in_array(3,$id_type_arr)){
									$id_type[] = 3; // สามตัวล่าง
								}else{
									$id_type[] = 2; // สามตัวบน
								}
							}
							
							if(in_array(32,$id_type)){
								$id_type = array();
								$new_arr_number = str_pad($number[0],2,"0", STR_PAD_LEFT);
								$number = getCombinations($new_arr_number,2);
								if(in_array(4,$id_type_arr) and in_array(7,$id_type_arr)){
									$id_type[] = 4; // สองตัวล่าง
									$id_type[] = 7; // สองตัวบน
								}else if(in_array(4,$id_type_arr)) {
									$id_type[] = 4; // สองตัวล่าง
								}else{
									$id_type[] = 7; // สองตัวบน
								}
							}
							// var_dump($id_type);
							$number = array_unique($number);
							sort($number);
							// var_dump($number);exit();
							$id_category = decrypt(post('id_category'));
							$id_package = decrypt(post('id_package'));

							$arr = array(
								'id_type' 		=> $id_type,
								'id_category'	=> $id_category,
								'id_package'	=> $id_package,
								'number'		=> $number,
								'price'			=> $price,
							);
							// var_dump($arr);
							$type = $this->model('lotto')->getRatio($arr);
							if(empty($type)){
								$result = array(
					    			'status' => 'failed',
					    			'desc'	=> 'เลขที่ท่านเลือกเป็นเลขอั้น'
					    		);
							}else{
								$result = array(
									'status' 	=> 'success',
									'data' 		=> $type,
									'desc'		=> 'เรียบร้อย'
								);
							}
						}else{
							$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'ท่านยังไม่เลือกประเภท'
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
		    		$decrypt_id_round = $id_round = decrypt(get('id_round'));
		    		// $decrypt_id_round = str_pad($decrypt_id_round,4,"0", STR_PAD_LEFT);
		    		
		    		if($id_round){
						$decrypt_id_round = decrypt(get('id_round'));
						$time_current = date('ymdHi');
						if($time_current>$decrypt_id_round){
							$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'หมดเวลาสำหรับการซื้อ'
				    		);
						}
					}
					// $time_current = date('Hi');
					// if($time_current>$decrypt_id_round){
					// 	if($time_current=="0000"){
					// 		$result = array(
				 //    			'status' => 'failed',
				 //    			'desc'	=> 'หมดเวลาสำหรับการซื้อ'
				 //    		);
				 //    		exit();
					// 	}
					// }
		    		$id_round = '';
		    		$list_lotto_not_buy 			= array();
		    		$list_lotto_not_buy_limit_type 	= array();
					$list_lotto_not_buy_total_over 	= array();
		    		$list_lotto 					= array();
					$id_type 						= post('id_type');
		    		$number 						= post('number');
		    		$paid 							= post('paid');
		    		$price 							= post('price');
		    		$ratio 							= post('ratio');
		    		$type 							= post('type');
		    		$id_round 						= (!empty(post('id_round'))?decrypt(post('id_round')):'');
		    		$id_round 						= str_pad($id_round,4,"0", STR_PAD_LEFT);

		    		$id_category 					= decrypt(post('id_category'));
		    		$id_package 					= decrypt(post('id_package'));
		    		$sum_price  					= 0;
		    		$sum_price_run_number  			= 0;
		    		$balance 						= $this->model('finance')->getBalance($id_user);

		    		$arr_select = array(
		    			'id_category' => $id_category
		    		);
		    		$result_check_closed = $this->model('lotto')->checkTimeover($arr_select);
		    		
		    		if($result_check_closed){
		    			$select_discount = array(
			    			'id_category' => $id_category,
							'id_package' => $id_package
			    		);
			    		$discount 				= (float)$this->model('lotto')->getDiscount($select_discount);

			    		foreach($id_type as $key => $val){
			    			// echo $key.'/';
			    			// if(isset($price[$key])){

			    				// ?????
			    			// echo $price[$key].'_'.$key.' ';
				    			if($price[$key]<=0){
				    				continue;
				    			}

				    			$number_ = $number[$key];
				    			$result_ratio = $this->model('lotto')->getLottoRatio($number_,$id_category,$val,$id_package);
				    			// var_dump($result_ratio);
				    			$price_ = $price[$key];
				    			$ratio_ = $result_ratio['ratio'];
				    			$paid = $price_ * $ratio_ ;//* $result_ratio['condition'];
				    			// echo $price_.' '.$ratio_;exit();
				    			$result_check_price_over = $this->model('lotto')->checkPriceOver($number_,$val,$id_category,$price_);
								if($result_check_price_over['status']=="success"){
									$result_check_price_type_over = $this->model('lotto')->checkPriceTypeOver($val,$id_category,$price_,$number_);
									if($result_check_price_type_over['status']=="success"){
										$result_check_price_total_over = $this->model('lotto')->checkPriceCustomerOver($val,$id_user,$price_,$id_category,$number_);
										if($result_check_price_total_over['status']=="success"){
							    			$list_lotto[] = array(
												'id_type' 	=> $val,
												'number' 	=> $number_,
												'paid' 		=> $paid,
												'price' 	=> $price_,
												'ratio' 	=> $ratio_,
												'type' 		=> $result_ratio['type'],
												'status'	=> 0
							    			);
							    			if($discount>0){
								    			// เลขวิ่ง
								    			if($val == 35 OR $val == 36){
								    				$sum_price_run_number += (float)$price[$key];
								    			}else{
								    				$sum_price += (float)$price[$key];
								    			}
								    		}else{
								    			$sum_price += (float)$price[$key];
								    		}
							    		}else{
							    			$list_lotto_not_buy_total_over[] = array(
							    				'desc'		=> 'checkPriceCustomerOver',
							    				'desc_code'	=> $val.' '.$id_user.' '.$price_.' '.$id_category,
							    				'desc_thai'	=> 'ประเภทการแทง '.$result_check_price_total_over['type_name'].' มียอดการแทงเกินที่กำหนด'
							    			);
							    		}
						    		}else{
						    			$list_lotto_not_buy_limit_type[] = array(
						    				'desc'		=> 'checkPriceTypeOver',
						    				'desc_code'	=> $val.' '.$id_category.' '.$price_,
						    				'desc_thai'	=> 'ประเภทการแทง '.$result_check_price_type_over['type_name'].' มียอดการแทงเกินที่กำหนด'
						    			);
						    		}
					    		}else{
					    			$list_lotto_not_buy[] = array(
					    				'desc'		=> 'checkPriceOver',
					    				'desc_code' => $number_,
					    				'desc_thai'	=> 'ตัวเลข '.$number_.' มียอดการแทงเกินที่กำหนด'
					    			);
					    		}
			    			// }
			    		}
			    		
			    		

			    		$sum_price 				= $sum_price - ($sum_price*$discount/100);
			    		if($sum_price_run_number){
			    			$select_discount = array(
				    			'id_category' => $id_category,
								'id_package' => $id_package
				    		);
			    			$discount_run_number 	= (float)$this->model('lotto')->getDiscountRunNumber($select_discount);
				    		$sum_price_run_number	= $sum_price_run_number - ($sum_price_run_number*$discount_run_number/100);
				    		$sum_price = $sum_price + $sum_price_run_number;
				    	}
						

			    		if($sum_price<=$balance){
			    			$result_add_lotto = $this->model('lotto')->addLotto($list_lotto,$id_user,$id_category,$sum_price,$discount,$id_round);
			    			if($result_add_lotto['status']=="success"){
				    			$this->model('finance')->widthdrawBalance($id_user,$sum_price);
					    		$this->setSession('lotto',array());
					    		$result = array(
					    			'status' 						=> 'success',
					    			'desc'							=> 'ระบบได้เพิ่มโพยของท่านเรียบร้อยแล้ว',
					    			'list_lotto_not_buy' 			=> $list_lotto_not_buy,
					    			'list_lotto_not_buy_limit_type'	=> $list_lotto_not_buy_limit_type,
					    			'list_lotto_not_buy_total_over' => $list_lotto_not_buy_total_over
					    		);
					    	}else{
					    		$result = array(
					    			'status' 						=> 'failed',
					    			'desc'							=> $result_add_lotto['desc'],
					    			'list_lotto_not_buy' 			=> $list_lotto_not_buy,
					    			'list_lotto_not_buy_limit_type'	=> $list_lotto_not_buy_limit_type,
					    			'list_lotto_not_buy_total_over' => $list_lotto_not_buy_total_over
					    		);
					    	}
			    		}else{
			    			$result = array(
				    			'status' => 'failed',
				    			'desc'	=> 'ยอดคงเหลือของท่านไม่พอสำหรับการซื้อ'
				    		);
			    		}
			    	}else{
			    		$result = array(
			    			'status' => 'failed',
			    			'desc'	=> 'หมดเวลาสำหรับการซื้อ'
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
	    		$data['balance'] 		= $this->model('finance')->getBalance($id_user);
	    		// $data['bank']		= $this->model('setting')->getSetting()['bank'];
	    		// var_dump($_SESSION);
	    		$data['bank_no']		= $this->getSession('bank_no');
	    		$data['bank_name']		= $this->getSession('bank_name');
	    		$data['bank_logo'] 		= $this->model('master')->getLogoBank($data['bank_name']);

	    		$data['bank_no_2']		= $this->getSession('bank_no_2');
	    		$data['bank_name_2']	= $this->getSession('bank_name_2');
	    		$data['bank_logo_2'] 	= $this->model('master')->getLogoBank($data['bank_name_2']);

	    		$data['name']			= $this->getSession('name').' '.$this->getSession('lname');
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
		 	    		$setting_widthdraw = $this->model('setting')->getSetting();
		 	    		$min_widthdraw = (float)$setting_widthdraw['min_widthdraw'];
		 	    		$max_widthdraw = (float)$setting_widthdraw['max_widthdraw'];
		 	    		if($price>=$min_widthdraw){
		 	    			if($price<=$max_widthdraw){
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
						    			'desc'	=> 'ระบบได้ข้อมูลการถอนของท่านแล้ว กำลังรอเจ้าหน้าที่ทำการอนุมัติ และโอนเงินไปยังบัญชีของท่าน ระบบจะโอนเงินเข้าบัญชีภายใน 15 นาที'
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
					    			'desc'	=> 'การถอนยอดขั้นสูงสุด '.$max_widthdraw.' บาท'
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

				$data['date'] 			= $date 	= get('date');
				$data['date_end'] 		= $date_end = get('date_end');

				if(empty($data['date'])){
					$data['date'] = date('Y-m-d');
				}
				if(empty($data['date_end'])){
					$data['date_end'] = date('Y-m-d');
				}

				$data['action']	= route('member/ticket');
		    	$data['title'] = "ticket";
		    	$data['descreption'] = "";
		    	$bill = $this->model('lotto')->getLotto($id_user,$date,$date_end);
		    	$data['lotto'] = (isset($bill['bill'])?$bill['bill']:array());
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
	    		$data['descreption'] 	= "";
	    		$data['balance'] 		= $this->model('finance')->getBalance($id_user);
	    		$data['bank_no']		= $this->getSession('bank_no');
	    		$data['bank_name']		= $this->getSession('bank_name');
	    		$data['bank_logo'] 		= $this->model('master')->getLogoBank($data['bank_name']);

	    		$data['bank_no_2']		= $this->getSession('bank_no_2');
	    		$data['bank_name_2']	= $this->getSession('bank_name_2');
	    		$data['bank_logo_2'] 	= $this->model('master')->getLogoBank($data['bank_name_2']);

	    		$data['name']			= $this->getSession('name').' '.$this->getSession('lname');
	    		$data['bankList'] = $this->model('master')->bankList();
	    		// $data['bank']		= $this->model('setting')->getSetting()['bank'];
	    		
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