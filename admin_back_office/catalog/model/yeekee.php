<?php 
	class YeekeeModel extends db {
		public function getConfigYeekeePercent(){
			$result = array();
			$yeekee_config_percent = 0;
			$sql = "SELECT * FROM b_setting WHERE `name` = 'yeekee_config_percent'";
			$result_percent = $this->query($sql);
			$yeekee_config_percent = $result_percent->row['val'];
			return $yeekee_config_percent;
		}
		public function getConfigYeekeeStartEnd(){
			$result = array();
			$sql_start = "SELECT * FROM b_setting WHERE `name`='yeekee_config_start'";
			$result_start = $this->query($sql_start)->row['val'];

			$sql_end = "SELECT * FROM b_setting WHERE `name`='yeekee_config_end'";
			$result_end = $this->query($sql_end)->row['val'];

			$result = array(
				'start' => $result_start,
				'end' 	=> $result_end
			);
			return $result;
		}
		public function setConfigYeekeePercent($data=array()){
			$result = array();
			$yeekee_config_percent = (isset($data['percent'])?$data['percent']:5);
			$sql = "UPDATE b_setting SET `val`='".$yeekee_config_percent."' WHERE `name` = 'yeekee_config_percent'";
			$result_percent = $this->query($sql);
			return true;
		}
		public function setConfigYeekeestart($data=array()){
			$result = array();
			$yeekee_config_start = (isset($data['start'])?$data['start']:5);
			$sql = "UPDATE b_setting SET `val`='".$yeekee_config_start."' WHERE `name` = 'yeekee_config_start'";
			$result_percent = $this->query($sql);
			return true;
		}
		public function setConfigYeekeeend($data=array()){
			$result = array();
			$yeekee_config_end = (isset($data['end'])?$data['end']:5);
			$sql = "UPDATE b_setting SET `val`='".$yeekee_config_end."' WHERE `name` = 'yeekee_config_end'";
			$result_end = $this->query($sql);
			return true;
		}
		public function getResult($data = array()){
			$date = (isset($data['date'])?$data['date']:date('Y-m-d'));
			$sql = "SELECT * FROM (SELECT * FROM b_yeekee WHERE date_create like '".$date."%')  b_yeekee 
					LEFT JOIN b_result_yeekee ON b_yeekee.`code` = b_result_yeekee.`id_round` 
					ORDER BY b_yeekee.id ASC 
					";
			$result_yeekee = $this->query($sql);
			$result = array(
				'rows' => $result_yeekee->rows
			);
			return $result;
		}
		public function calculate($data = array()){
			// $date_end 		= $this->escape($data['date_end']);
			// $date_last_end 	= $this->escape($data['date_last_end']);
			// $id_round 			= $this->escape($data['id_round']);
			// กำหนดให้เจ้า ได้รับ 20%
			// $result_3_digit = (isset($data['result_3_digit'])?$data['result_3_digit']:'');
			// $result_2_digit = (isset($data['result_2_digit'])?$data['result_2_digit']:'');
			$master_config_host_receive = 20;
			$result = array();

			
			$id_round = get('id_round');

			$sum_text_current 	= date('ymdHi');
			$sum_text_round		= $id_round;
			// เวลาปัจจุบัน 
			// current_hour 09 current_min 46
			// เวลาที่เจอตามเงื่อนไขระบบ
			// round_hour 09 round_min 45
			// echo 'id_round: '.$id_round.'<br>';
			if(!empty($id_round)){
				$sql_bill = "SELECT * FROM b_lotto_bill 
								WHERE `status` = '0' 
								AND (id_round = '".$id_round."'";
				$result_bill = $this->query($sql_bill);
				if( $result_bill->num_rows ){
					$arr_for_cal = array();
					$sum_all_paid = 0;
					$sum_all_price = 0;
					$arr_type_for_cal = array();
					$arr_type_text_for_cal = array();
					$type_text = array();
					foreach($result_bill->rows as $val_bill){
						$id_bill 			= $val_bill['id'];
						$id_category 		= $val_bill['id_category'];
						$id_user 			= $val_bill['id_user'];
						$sql_bill_detail 	= "SELECT * FROM b_lotto WHERE id_bill = '".$id_bill."' AND `status`='0'";
						$result_bill_detail = $this->query($sql_bill_detail);
						if( $result_bill_detail->num_rows ){
							$total_receive = 0;
							$sql_find_type = "SELECT count(id_type) AS count_type FROM b_ratio WHERE id_category = 24 AND price > 0";
							$result_type = $this->query($sql_find_type);
							$count_type = 0;
							if($result_type->num_rows > 0){
								$count_type = $result_type->row['count_type'];
							}
							
							foreach( $result_bill_detail->rows as $val ){
								$id 		= $val['id'];
								$id_type 	= $val['id_type'];
								if($id_type==7 OR $id_type ==2){
									$id_type = 999;
									$val['type'] = "รวม 2 ตัวบน กับ 3 ตัวบน และโต๊ต แยกตามอัตราต่อรองแล้ว";
								}
								// ให้กลับเลข 3 โต๊ดเข้าไปด้วย
								$number 	= $val['number'];
								$price 		= $val['price'];
								$ratio 		= $val['ratio'];
								$paid 		= $val['paid'];

								$sum_all_price += (float)$val['price'];
								$sum_all_paid += (float)$val['paid'];
								$arr_for_cal[$id_type][$number]['paid'][] = $paid;
								$arr_type_for_cal[$id_type][] = $price;
								$type_text[$id_type] = $val['type'];
							}

						} // end if b_lotto
					}// end foreach
					// echo "test";exit();
					// echo "<pre>";
					// var_dump($arr_for_cal[6]);
					// exit();
					if(isset($arr_for_cal[6])){
						foreach($arr_for_cal[6] as $number => $val){
							$result_3_split = getCombinations($number,3);
							foreach($result_3_split as $no_3_split){
								// ถ้ายังไม่มี ตัวเลข นี้ในโต๊ดให้ใส่ลงไป เพราะต้องเอาไปเลคด้วย มันเชื่อมกับ 3 เตง
								if(!isset($arr_for_cal[6][$no_3_split])){
									$arr_for_cal[6][$no_3_split]['paid'] = $val['paid'];
								}
								// เอา 3 ตัวโต๊ดที่กลับแล้วไปใส่ใน ตัวเลขชุดพิเศษ
								if(isset($arr_for_cal[999][$no_3_split]['paid'])){
									$default_paid = $arr_for_cal[999][$no_3_split]['paid'];
									$arr_for_cal[999][$no_3_split]['paid'] = array_merge(
										$default_paid,
										$val['paid']
									);
								}else{
									$arr_for_cal[999][$no_3_split]['paid'] = $val['paid'];
								}
								
							}
						}
						// ลบโต๊ดออก 
						unset($arr_for_cal[6]);
					}
					// echo "<pre>";
					// var_dump($arr_for_cal[999]);
					// exit();


					echo "<br>ราคาแทงทั้งหมด:".$sum_all_price."<br>";
					echo "------<br>";

					foreach($arr_type_for_cal as $id_type => $val){
						echo "รหัสประเภท: '".$type_text[$id_type]."' มียอดซื้อรวม: ".array_sum($val)."<br>";
					}
					// $avg_balance = $sum_all_price / $count_type;
					echo "เลขที่แทงทั้งหมด <br>";
					$type_paid = array();
					foreach($arr_for_cal as $id_type => $arr_id_type){

						if(isset($arr_type_for_cal[$id_type])){
							$sum_price = array_sum($arr_type_for_cal[$id_type]);
						}
						$sum_price = $sum_price-($sum_price*$master_config_host_receive/100);
						echo "- รหัสประเภท: '".$type_text[$id_type].' ยอดรวมหลังหักจากกำไรเจ้า '.$master_config_host_receive.'% ยอดที่จะไม่เกิน'.$sum_price."<br>" ;
						foreach($arr_id_type as $number => $arr_number){
							$sum_paid = array_sum($arr_number['paid']);
							

							echo (String)$number.' '.$sum_paid."<br>";
							if($sum_price>=$sum_paid){
								$type_paid[$id_type][(String)$number] = $sum_paid;
							}
						}
					}
					// หาเลข 2 ตัวกับ 3 ตัวบน มารวมกัน
					// ถ้ามีเลข 345 445 แต่ถ้ามี 2 ตัวที่มี 45 ก็ให้เอามารวมทั้ง 2 เลขเลย
					$re_cal_special_number = array();
					if(isset($type_paid[999])){
						foreach($type_paid[999] as $key => $val){
							if(strlen($key)==3){
								$index_2_number = substr($key,-2);
								if(isset($type_paid[999][$index_2_number])){
									$type_paid[999][$key] = $val+$type_paid[999][$index_2_number];
								}
							}
						}
						// ให้ลบเลข 2 ตัวทิ้ง
						foreach($type_paid[999] as $key => $val){
							if(strlen($key)==2){
								unset($type_paid[999][$key]);
							}
						}
					}
					// ให้เอาตัวเลขที่รวมไป เช็คใหม่อีกครั้ง
					foreach($type_paid as $id_type => $val){
						echo "เลข ".$type_text[$id_type]." ตัว ที่มีโอกาสออก แล้วเจ้าคุ้มที่สุด <br>";
						$end_rand_3_digit = count($type_paid[$id_type])-1;
						foreach($type_paid[$id_type] as $no => $price){
							echo $no.":".$price."<br>";
						}
						echo "ทดสอบการสุ่มเลขในครั้งนี้ สุ่มเลข<br>";
						$result_rand_digit[$id_type] = array_rand($type_paid[$id_type],1);
					}

					$result_3_digit = $result_3_digit;
					$result_2_digit = $result_2_digit;
					$host_paid = 0;
					if(!empty($result_rand_digit[999])){
						$result_3_digit = $result_rand_digit[999];
						// $host_paid = $type_paid[$id_type][$result_3_digit];
					}
					if(!empty($result_rand_digit[4])){
						$result_2_digit = $result_rand_digit[4];
						// $host_paid = $type_paid[$id_type][$result_2_digit];
					}

					// $result_3_digit = 674;
					$all_number = str_pad(rand(0,99),2,"0", STR_PAD_LEFT).$result_2_digit.$result_3_digit;
					
					echo "เริ่มคำนวนบิล<br>";
					foreach($result_bill->rows as $val_bill){
						$id_bill 			= $val_bill['id'];
						$id_category 		= $val_bill['id_category'];
						$id_user 			= $val_bill['id_user'];
						$sql_bill_detail 	= "SELECT * FROM b_lotto WHERE id_bill = '".$id_bill."' AND `status`='0'";
						$result_bill_detail = $this->query($sql_bill_detail);
						if( $result_bill_detail->num_rows ){
							$total_receive = 0;
							$sql_find_type = "SELECT count(id_type) AS count_type FROM b_ratio WHERE id_category = 24 AND price > 0";
							$result_type = $this->query($sql_find_type);
							$count_type = 0;
							if($result_type->num_rows > 0){
								$count_type = $result_type->row['count_type'];
							}
							
							$total_receive = 0;
							foreach( $result_bill_detail->rows as $val ){
								$result_match_number = false;
								$id 		= $val['id'];
								$id_type 	= $val['id_type'];
								$number 	= $val['number'];
								$price 		= $val['price'];
								$ratio 		= $val['ratio'];
								$paid 		= $val['paid'];

								$sql_get_type_detail = "SELECT * FROM b_type WHERE id = '".$id_type."'";
								$result_get_type_detail = $this->query($sql_get_type_detail);
								$digit = (isset($result_get_type_detail->row['digit'])?$result_get_type_detail->row['digit']:'');
								$i_count = 0;
								if($digit == 2){
									if($id_type==8){ // 2 โต๊ด
										$swarp_2_number = getCombinations($number,2);
										foreach($swarp_2_number as $val){
											// $sql_check_result_2 = "SELECT * FROM b_result 
											// 			WHERE `date` = '".$date."' 
											// 			AND id_cate_type = '".$id_type."' 
											// 			AND `result` LIKE '%".$val."%'";
											// $result_check_result_2 = $this->query($sql_check_result_2);
											if($val==$result_2_digit){
												echo 'No: '.$val." 2 โต๊ด เลขที่แทง ".$val."เลขที่ออก ".$result_2_digit." i_count ".$i_count++."<br>";
												$result_match_number = true;
												break;
											}
										}
									}else{
										if($number==$result_2_digit){
											echo 'No: '.$number." 2 ล่าง, บน เลขที่แทง ".$number."<br>";
											$result_match_number = true;
										}
									} 
								}else{
									if($id_type==6){ // 3 โต๊ด
										$swarp_3_number = getCombinations($number,3);
										foreach($swarp_3_number as $val){
											// $sql_check_result_3 = "SELECT * FROM b_result 
											// 			WHERE `date` = '".$date."' 
											// 			AND id_cate_type = '".$id_type."' 
											// 			AND `result` LIKE '%".$val."%'";
											// $result_check_result_3 = $this->query($sql_check_result_3);
											if($val==$result_3_digit){
												echo 'No: '.$val." 3 โต๊ด เลขที่แทง ".$val."เลขที่ออก ".$result_3_digit."<br>";
												$result_match_number = true;
												break;
											}
										}
									}else{
										if($number==$result_3_digit){
											echo 'No: '.$number." 3 บน เลขที่แทง ".$number." <br>";
											$result_match_number = true;
										}
									}
								}
								
								// $result_check_result = $this->query($sql_check_result);

								$status = 1;
								$receive = 0;
								
								if($result_match_number){
									$receive = ($price*$ratio);
									$total_receive += ($price*$ratio);
									echo "receive: ".$receive."<br>";
									echo "ปรับบิล: ".$id_bill." ยอด: ".$receive." เลข ".$number." total_receive: ".$total_receive."<br>";
								}
								$sql_update_lotto_status = "UPDATE b_lotto SET `status`='1', `receive`='".$receive."' WHERE `id` = '".$id."'";
								$query_update_lotto_status = $this->query($sql_update_lotto_status);

								$result[] = array(
									'id' 						=> $id,
									'id_type' 					=> $id_type,
									'number' 					=> $number,
									'price' 					=> $price,
									'ratio' 					=> $ratio,
									'status'					=> $status,
									'receive'					=> $receive
								);
							
								// $sql_update_lotto_bill_status = "UPDATE b_lotto_bill SET `status`='1', `receive`='".$total_receive."' WHERE `id` = '".$id_bill."'";
								
								// $query_update_lotto_bill_status = $this->query($sql_update_lotto_bill_status);

								// $sql_update_balance_user = "UPDATE b_user SET `balance` = `balance` + ".$total_receive." WHERE `id` = '".$id_user."'";
								// $result_update_balance = $this->query($sql_update_balance_user);
								// exit();
							}

						} // end if b_lotto
					}// end foreach
					$arr_insert = array(
						'date_create' 	=> date('Y-m-d H:i:s'),
						'id_round'		=> $id_round,
						'result_2_digit'=> $result_2_digit,
						'result_3_digit'=> $result_3_digit,
						'all_price'		=> $sum_all_price,
						'profit'		=> $sum_all_price-$total_receive,
						'paid'			=> $total_receive,//$host_paid,
						'result_no'		=> $all_number
					);
					// $this->insert('result_yeekee',$arr_insert);
					echo "เจ้าจะต้องจ่ายในรอบนี้ ".$host_paid."<br>" ;
					echo "จะมีกำไรทั้งหมด ".((float)$sum_all_price-$host_paid).' บาท <br>';


					// $index_rand_3_digit = rand(0,$end_rand_3_digit);
					// $type_paid[999]
				}else{
					$result_3_digit = str_pad(rand(0,999),3,"0", STR_PAD_LEFT);
					$result_2_digit = str_pad(rand(0,99),2,"0", STR_PAD_LEFT);
					$all_number = str_pad(rand(0,99),2,"0", STR_PAD_LEFT).$result_2_digit.$result_3_digit;
					$arr_insert = array(
						'date_create' 	=> date('Y-m-d H:i:s'),
						'id_round'		=> $id_round,
						'result_2_digit'=> $result_2_digit,
						'result_3_digit'=> $result_3_digit,
						'all_price'		=> 0,
						'profit'		=> 0,
						'paid'			=> 0,//$host_paid,
						'result_no'		=> $all_number
					);
					$this->insert('result_yeekee',$arr_insert);
				}
			}else{
				$result = array(
					'result' => 'Fail',
					'desc'	=> 'id_round Empty'
				);
			}
			
			return $result;
			
		}
		public function getRound($data = array()){
			$result = array(
				'status'	=>	'fail',
				'yeekee'	=> array()
			);
			$pre_code = date('ymd');
			$arr = array();
			$min = 0;
			$hour = 0;
			$fix_round = 15;
			$total_min = 24*60;
			for($i=0;$i<=$total_min;$i++){
				$var_mod = $i%15;
				if($var_mod==0){
					$hour 	= floor($i/60);
					$min 	= (($i/60) - $hour) * 60;

					$text_hour 	= str_pad($hour,2,"0", STR_PAD_LEFT);
					$text_min	= str_pad($min,2,"0", STR_PAD_LEFT);
					$arr[] = array(
						'hour'		=> $text_hour,
						'min' 		=> $text_min,
						'code'		=> $pre_code.$text_hour.$text_min,
					);
				}
			}
			$result = array(
				'status'	=>	'success',
				'yeekee'	=>	$arr
			);
			return $result;
		}
	}
?>