<?php 
	class CronjobModel extends db {
		public function checkCreateDate($data = array()){
			$result = array(
				'status'	=>	'fail',
				'desc'		=>	'Not action'
			);
			$date = (isset($data['date'])?$data['date']:'');
			$date = $this->escape($date);
			if(!empty($date)){
				$sql = "SELECT * FROM b_yeekee_date WHERE date_yeekee = '".$date."'";
				$result_date = $this->query($sql);
				if($result_date->num_rows){
					$result = array(
						'status'	=>	'fail',
						'desc'		=>	'Not action'
					);
				}else{
					$data_insert = array(
						'date_create' 	=> date('Y-m-d H:i:s'),
						'date_yeekee'	=> $date
					);
					$id_yeekee_date = $this->insert('yeekee_date',$data_insert);
					$result_round = $this->getRound();
					foreach($result_round['yeekee'] as $val){
						$status = 0;
						$arr_insert = array(
							'code' 			=> $val['code'],
							'date_create'	=> date('Y-m-d H:i:s'),
							'status'		=> $status
						);
						$id_yeekee_date = $this->insert('yeekee',$arr_insert);
					}
				}
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

					if($text_hour=='24' AND $text_min=='00'){
						$text_hour 	= '23';
						$text_min 	= '59';
					}
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
		public function changeStatus($data = array()){
			$code = (isset($data['code'])?$data['code']:'');
			$code = $this->escape($code);
			if(!empty($code)){
				$sql_update = "UPDATE b_yeekee SET `status`=1 WHERE status = 0";
				$this->query($sql_update);

				$sql_select_last_code = "SELECT `code` FROM b_yeekee WHERE `code` < '".$code."' ORDER BY `code` DESC LIMIT 0,1";
				$result_last_code = $this->query($sql_select_last_code);

				if($result_last_code->num_rows){
					$last_code = $result_last_code->row['code'];
					// echo $last_code;
					$sql_update_new = "UPDATE b_yeekee 
					SET `status`=0 
					WHERE `code` = '".$last_code."'";
					$this->query($sql_update_new);
				}
			}
		}
		public function calculate($data = array()){
			// $date_end 		= $this->escape($data['date_end']);
			// $date_last_end 	= $this->escape($data['date_last_end']);
			// $id_round 			= $this->escape($data['id_round']);
			// กำหนดให้เจ้า ได้รับ 20%

			$master_config_host_receive = 20;
			$result = array();

			$sql_get_round = "SELECT id,code FROM b_yeekee WHERE date_create like '".date('Y-m-d')."%' AND `status` = 0";
			$result_round = $this->query($sql_get_round);
			// var_dump($result_round->rows);exit();
			foreach($result_round->rows as $round){
				$now_id = $round['id'];
				$id_round = $round['code'];

				$sum_text_current 	= date('ymdHi');
				$sum_text_round		= $id_round;
				// เวลาปัจจุบัน 
				// current_hour 09 current_min 46
				// เวลาที่เจอตามเงื่อนไขระบบ
				// round_hour 09 round_min 45

				
				if($sum_text_current>=$sum_text_round){
					$sql_update = "UPDATE b_yeekee SET `status`='1' WHERE `id` = '".$now_id."'";
					$this->query($sql_update);
				}else{
					continue;
				}
				// echo 'id_round: '.$id_round.'<br>';
				if(!empty($id_round)){
					$sql_bill = "SELECT * FROM b_lotto_bill 
									WHERE `status` = '0' 
									AND (id_round = '".$id_round."' AND `date_create` like '".date("Y-m-d")."%' AND id_category = 24)";
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


						// echo "<br>ราคาแทงทั้งหมด:".$sum_all_price."<br>";
						// echo "------<br>";
						foreach($arr_type_for_cal as $id_type => $val){
							// echo "รหัสประเภท: '".$type_text[$id_type]."' มียอดซื้อรวม: ".array_sum($val)."<br>";
						}
						// $avg_balance = $sum_all_price / $count_type;
						// echo "เลขที่แทงทั้งหมด <br>";
						$type_paid = array();
						foreach($arr_for_cal as $id_type => $arr_id_type){

							
							$sum_price = array_sum($arr_type_for_cal[$id_type]);
							$sum_price = $sum_price-($sum_price*$master_config_host_receive/100);
							// echo "- รหัสประเภท: '".$type_text[$id_type].' ยอดรวมหลังหักจากกำไรเจ้า '.$master_config_host_receive.'% ยอดที่จะไม่เกิน'.$sum_price."<br>" ;
							foreach($arr_id_type as $number => $arr_number){
								$sum_paid = array_sum($arr_number['paid']);
								

								// echo (String)$number.' '.$sum_paid."<br>";
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
							// echo "เลข ".$type_text[$id_type]." ตัว ที่มีโอกาสออก แล้วเจ้าคุ้มที่สุด <br>";
							$end_rand_3_digit = count($type_paid[$id_type])-1;
							foreach($type_paid[$id_type] as $no => $price){
								// echo $no.":".$price."<br>";
							}
							// echo "ทดสอบการสุ่มเลขในครั้งนี้ สุ่มเลข<br>";
							$result_rand_digit[$id_type] = array_rand($type_paid[$id_type],1);
						}

						$result_3_digit = str_pad(rand(0,999),3,"0", STR_PAD_LEFT);
						$result_2_digit = str_pad(rand(0,99),2,"0", STR_PAD_LEFT);
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
						
						// echo "เริ่มคำนวนบิล<br>";
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
													// echo 'No: '.$val." 2 โต๊ด เลขที่แทง ".$val."เลขที่ออก ".$result_2_digit." i_count ".$i_count++."<br>";
													$result_match_number = true;
													break;
												}
											}
										}else{
											if($number==$result_2_digit){
												// echo 'No: '.$number." 2 ล่าง, บน เลขที่แทง ".$number."<br>";
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
													// echo 'No: '.$val." 3 โต๊ด เลขที่แทง ".$val."เลขที่ออก ".$result_3_digit."<br>";
													$result_match_number = true;
													break;
												}
											}
										}else{
											if($number==$result_3_digit){
												// echo 'No: '.$number." 3 บน เลขที่แทง ".$number." <br>";
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
										// echo "receive: ".$receive."<br>";
										// echo "ปรับบิล: ".$id_bill." ยอด: ".$receive." เลข ".$number." total_receive: ".$total_receive."<br>";
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
								
									$sql_update_lotto_bill_status = "UPDATE b_lotto_bill SET `status`='1', `receive`='".$total_receive."' WHERE `id` = '".$id_bill."'";
									
									$query_update_lotto_bill_status = $this->query($sql_update_lotto_bill_status);

									$sql_update_balance_user = "UPDATE b_user SET `balance` = `balance` + ".$total_receive." 
																WHERE `id` = '".$id_user."'";
									$result_update_balance = $this->query($sql_update_balance_user);
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
						$this->insert('result_yeekee',$arr_insert);
						// echo "เจ้าจะต้องจ่ายในรอบนี้ ".$host_paid."<br>" ;
						// echo "จะมีกำไรทั้งหมด ".((float)$sum_all_price-$host_paid).' บาท <br>';


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
			}
			return $result;
			
		}
	}
?>