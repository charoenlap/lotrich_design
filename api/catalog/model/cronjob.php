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
						$status = 1;
						if($val['hour']=="00" AND $val['min']=="00"){
							$status = 0;
						}
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
					echo $last_code;
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
			$id_round 			= $this->escape($data['id_round']);
			
			$result = array();
			if(!empty($id_round)){
				$sql_bill = "SELECT * FROM b_lotto_bill 
								WHERE `status` = '0' 
								AND (id_round = '".$id_round."' AND id_category = 24)";
				$result_bill = $this->query($sql_bill);
				if( $result_bill->num_rows ){
					foreach($result_bill->rows as $val_bill){
						$id_bill 			= $val_bill['id'];
						$id_category 		= $val_bill['id_category'];
						$id_user 			= $val_bill['id_user'];
						$sql_bill_detail 	= "SELECT * FROM b_lotto WHERE id_bill = '".$id_bill."' AND `status`='0'";
						$result_bill_detail = $this->query($sql_bill_detail);
						if( $result_bill_detail->num_rows ){
							$total_receive = 0;
							// var_dump($result_bill_detail->rows);
							foreach( $result_bill_detail->rows as $val ){
								$id 		= $val['id'];
								$id_type 	= $val['id_type'];
								$number 	= $val['number'];
								$price 		= $val['price'];
								$ratio 		= $val['ratio'];

								$sql_get_type_detail = "SELECT * FROM b_type WHERE id = '".$id_type."'";
								$result_get_type_detail = $this->query($sql_get_type_detail);
								$digit = (isset($result_get_type_detail->row['digit'])?$result_get_type_detail->row['digit']:'');
								if($digit == 2){
									if($id_type==8){ // 2 โต๊ด
										$swarp_2_number = getCombinations($number,2);
										foreach($swarp_2_number as $val){
											$sql_check_result_2 = "SELECT * FROM b_result 
														WHERE `date` = '".$date."' 
														AND id_cate_type = '".$id_type."' 
														AND `result` LIKE '%".$val."%'";
											$result_check_result_2 = $this->query($sql_check_result_2);
											if($result_check_result_2->num_rows){
												$sql_check_result = $sql_check_result_2;
												break;
											}
										}
									}else{
										$sql_check_result = "SELECT * FROM b_result 
														WHERE `date` = '".$date."' 
														AND id_cate_type = '".$id_type."' 
														AND `result` = '".$number."'";
									}
								}else{
									if($id_type==6){ // 3 โต๊ด
										$swarp_3_number = getCombinations($number,3);
										foreach($swarp_3_number as $val){
											$sql_check_result_3 = "SELECT * FROM b_result 
														WHERE `date` = '".$date."' 
														AND id_cate_type = '".$id_type."' 
														AND `result` LIKE '%".$val."%'";
											$result_check_result_3 = $this->query($sql_check_result_3);
											if($result_check_result_3->num_rows){
												$sql_check_result = $sql_check_result_3;
												break;
											}
										}
									}else{
										$sql_check_result = "SELECT * FROM b_result 
														WHERE `date` = '".$date."' 
														AND id_cate_type = '".$id_type."' 
														AND `result` LIKE '%".$number."%'";
									}
								}
								
								// echo $sql_check_result;
								$result_check_result = $this->query($sql_check_result);

								$status = 1;
								$receive = 0;
								
								if($result_check_result->num_rows > 0){
									$receive = ($price*$ratio);
									$total_receive += ($price*$ratio);
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
									'receive'					=> $receive,
									'sql_check_result'			=> $sql_check_result,
									'sql_update_lotto_status'	=> $sql_update_lotto_status
								);
							
								$sql_update_lotto_bill_status = "UPDATE b_lotto_bill SET `status`='1', `receive`='".$total_receive."' WHERE `id` = '".$id_bill."'";
								$query_update_lotto_bill_status = $this->query($sql_update_lotto_bill_status);

								$sql_update_balance_user = "UPDATE b_user SET `balance` = `balance` + ".$total_receive." 
															WHERE `id` = '".$id_user."'";
								$result_update_balance = $this->query($sql_update_balance_user);
							}
							$result = array(
								'result' => 'Success',
								'desc'	=> ''
							);
						}else{
							$result = array(
								'result' => 'Fail',
								'desc'	=> 'Record Empty'
							);
						}
					}
				}else{
					$result = array(
						'result' => 'Fail',
						'desc'	=> 'Bill Empty'
					);
				}
			}else{
				$result = array(
					'result' => 'Fail',
					'desc'	=> 'id_round Empty'
				);
			}
			return $result;
			
		}
	}
?>