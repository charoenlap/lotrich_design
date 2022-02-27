<?php 
	class MasterModel extends db {
		public function listReportAllBill($data=array()){
			$date 			= $this->escape($data['date']);
			$date_end 		= $this->escape($data['date_end']);
			$id_type		= $this->escape($data['id_type']);
			$number			= $this->escape($data['number']);
			$id_category	= $this->escape($data['id_category']);
			$bill       	= array();
			$result 		= array();
			$sql = "SELECT * FROM b_lotto 
					LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto.id 
					WHERE (b_lotto.date_create BETWEEN '".$date." 00:00:00' AND '".$date_end." 23:59:59') 
					AND b_lotto.`number` = '".$number."'
					AND b_lotto.id_type = '".$id_type."' 
					";
			$query = $this->query($sql);
			if($query->num_rows){

				foreach($query->rows as $val){
					$sql_bill = "SELECT *,b_lotto_bill.date_create AS date_create FROM b_lotto_bill 
						LEFT JOIN b_lotto ON b_lotto_bill.id = b_lotto.id_bill 
						LEFT JOIN b_user ON b_lotto_bill.id_user = b_user.id 
						WHERE b_lotto_bill.id = ".$val['id_bill'];
					$query_bill = $this->query($sql_bill);
					if($query_bill->rows){
						foreach($query_bill->rows as $v){
							$result[$val['id_bill']]['rows'][] = $v;
						}
					}
				}
			}
			return $result;
		}
		public function calculateRollbackAllBill($data=array()){
			$date_end 		= $this->escape($data['date_end']);
			$date_last_end 	= $this->escape($data['date_last_end']);
			$date 			= $this->escape($data['date']);
			if(!empty($date_end) AND !empty($date_last_end) AND !empty($date)){
				$result = array();
				if(!empty($date)){

					$sql_rollback_transection = "SELECT * FROM b_transection 
					WHERE `type` = 1 AND date_create LIKE '".date('Y-m-d')."%'";
					$result_rollback_transection = $this->query($sql_rollback_transection);
					if( $result_rollback_transection->num_rows ){
						foreach($result_rollback_transection->rows as $val_transection){
							$amount 			= $val_transection['amount'];
							$id_transection 	= $val_transection['id'];
							$sql_update_user 	= "UPDATE b_user SET `balance` = `balance` + ".$amount." WHERE `id` = ".$id_transection;
							$result_update_user = $this->query($sql_update_user);
						}
						$sql_delete_transection = "DELETE FROM b_transection WHERE date_create LIKE '".date('Y-m-d')."%'";
						$result_delete_transection = $this->query($sql_delete_transection);
					}

					$sql_bill = "SELECT * FROM b_lotto_bill 
									WHERE `status` = '1' 
									AND (date_create BETWEEN '".$date_last_end."' AND '".$date_end."')";
					$result_bill = $this->query($sql_bill);

					if( $result_bill->num_rows ){
						foreach($result_bill->rows as $val_bill){
							$id_bill 			= $val_bill['id'];
							$id_category 		= $val_bill['id_category'];
							$id_user 			= $val_bill['id_user'];

							$sql_update_lotto_bill_status = "UPDATE b_lotto_bill SET `status`='0', `receive`='0' WHERE `id` = '".$id_bill."'";
							$query_update_lotto_bill_status = $this->query($sql_update_lotto_bill_status);

							$sql_bill_detail 	= "SELECT * FROM b_lotto WHERE id_bill = '".$id_bill."' AND `status`='1'";
							$result_bill_detail = $this->query($sql_bill_detail);
							if( $result_bill_detail->num_rows ){
								foreach( $result_bill_detail->rows as $val ){
									$id 		= $val['id'];
									$receive 	= (int)$val['receive'];

									$sql_update_lotto_status = "UPDATE b_lotto SET `status`='0', `receive`='0' WHERE `id` = '".$id."'";
									$query_update_lotto_status = $this->query($sql_update_lotto_status);
									if($receive){
										$sql_update_user = "UPDATE b_user SET `balance`=`balance`-".$receive." WHERE `id` = '".$id_user."'";
										$query_update_user = $this->query($sql_update_user);
										// echo $sql_update_user;
									}
								}
							}
						}
					}
				}
			}
		}
		public function calculateAllBill($data=array()){
			$date_end 		= $this->escape($data['date_end']);
			$date_last_end 	= $this->escape($data['date_last_end']);
			$date 			= $this->escape($data['date']);
			if(!empty($date_end) AND !empty($date_last_end) AND !empty($date)){
				$result = array();
				if(!empty($date)){
					$sql_bill = "SELECT * FROM b_lotto_bill 
									WHERE `status` = '0' 
									AND (date_create BETWEEN '".$date_last_end."' AND '".$date_end."')";
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
						'desc'	=> 'Date Empty'
					);
				}
				return $result;
			}
		}
		public function listCategory($data=array()){
			// $date = "2021-10-01";
			// $result = array();
			// $path_json = PATH_JSON.'/getCategory.json';
			// if(!isset($data['db'])){
				$sql = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = 0";
				$category = $this->query($sql)->rows;

				foreach($category as $val){
					// $sub = array();

					// $sql_ratio = "SELECT *,b_type.type AS name FROM b_ratio LEFT JOIN b_type ON b_ratio.id_type = b_type.id WHERE id_category = '".$val['id']."' ";
					// 	$ratio = $this->query($sql_ratio)->rows;

					// $sql_sub = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = '".$val['id']."'";
					// $category_sub = $this->query($sql_sub)->rows;
					// $result_cate_sub = array();
					// foreach($category_sub as $cs){
					// 	$sql_sub_in = "SELECT * FROM b_category_type 
					// 	LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
					// 	WHERE `status`=0 
					// 	AND id_category = '".$cs['id']."' 
					// 	ORDER BY b_category_type.`order` ASC";
					// 	$type_sub = $this->query($sql_sub_in)->rows;
					// 	$result_cate_sub[] = array(
					// 		'name' => $cs['name'],
					// 		'type' => $type_sub
					// 	);
					// }
					// $type = array();
					// $sql_sub = "SELECT * FROM b_category_type 
					// LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
					// LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
					// WHERE `status`=0 
					// AND id_category = '".$val['id']."' 
					// ORDER BY b_category_type.`order` ASC";
					// $type = $this->query($sql_sub)->rows;

					$result[] = array(
						'id' 	=> $val['id'],
						'name' 	=> $val['name'],
						'flag' 	=> $val['flag'],
						// 'sub'	=> $result_cate_sub,
					// 	'type'	=> $type,
					// 	'ratio' => $ratio
					);
				}
				// echo "<pre>";
				// var_dump($result);exit();
				// $fp = fopen($path_json, 'w');
				// fwrite($fp, json_encode($result));
				// fclose($fp);
			// }else{
			// 	$result = json_decode(file_get_contents($path_json), true);
			// }
			return $result;
		}
		public function getCategory($id_category=0,$date='',$id_package=0){
			// if($date==''){
			// 	$date = date('Y-m-d');
			// }

			$result = array();
			// $path_json = PATH_JSON.'/getCategory.json';
			// if(!isset($data['db'])){
			$id_category = (int)$id_category;
			$sql = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = 0 AND id = ".$id_category;
			$val = $this->query($sql)->row;


			$sub = array();
			$sql_ratio = "SELECT *,b_type.type AS name,b_ratio.id AS id 
							FROM b_ratio 
								LEFT JOIN b_type ON b_ratio.id_type = b_type.id 
							WHERE 
								b_ratio.id_category = '".$id_category."' 
								AND id_package = ".$id_package;
			// echo $sql_ratio;
			$ratio = $this->query($sql_ratio)->rows;

			$sql_sub = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = '".$id_category."'";
			$category_sub = $this->query($sql_sub)->rows;
			$result_cate_sub = array();
			foreach($category_sub as $cs){
				$sql_sub_in = "SELECT *,b_category_type.id AS id FROM b_category_type 
				
				LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
				LEFT JOIN b_type ON b_type.id = result.id_type
				WHERE `status`=0 
				AND id_category = '".$cs['id']."' 
				ORDER BY b_category_type.`order` ASC";
				$type_sub = $this->query($sql_sub_in)->rows;
				// var_dump($type_sub);exit();
				$result_cate_sub[] = array(
					'id_type' => $cs['id'],
					'name' => $cs['name'],
					'type_sub' => $type_sub
				);
			}
			$type = array();
			// $sql_sub = "SELECT *, b_category_type.id AS id FROM b_category_type 
			// LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
			// LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
			// WHERE `status`=0 
			// AND id_category = '".$id_category."' 
			// ORDER BY b_category_type.`order` ASC";
			$sql_sub = "SELECT *, b_category_type.id as id_cate_type, b_result.id as id FROM b_result 
			LEFT JOIN b_category_type ON b_result.id_cate_type = b_category_type.id 
			LEFT JOIN b_type ON b_type.id = b_result.id_cate_type 
			WHERE  b_result.`date` = '".$date."' AND b_result.id_category = '".$id_category."'";
			$query_type = $this->query($sql_sub);
			$type = $query_type->rows;
			if($query_type->num_rows==0){
				// รางวัลที่ 1 
				// 3 ตัวบน
				// 3 ตัวโต๊ด
				// 2 ตัวโต๊ด
				// 2 ตัวบน 
				// วิ่งบน
				// 3 ตัวล่าง
				// 2 ต้วล่าง
				// วิ่งล่าง
				if(!empty($date)){
					$type_id = array(1=>2,2=>2,6=>2,8=>2,7=>2,35=>2,4=>2,3=>2,2=>2,36=>2);
					foreach($type_id as $id_type => $column){
						$insert = array(
							'id_category' 	=> $id_category,
							'id_type'		=> $id_type,
							'status'		=> 0,
							'order'			=> 0,
							'column'		=> $column,
						);
						$id_category_type = $this->insert('category_type',$insert);
						$insert = array(
							'id_cate_type' 	=> $id_type,
							'date'			=> $date,
							'result'		=> '',
							'id_category'	=> $id_category,
							'id_type'		=> $id_type
						);
						$this->insert('result',$insert);
					}
				}
				$sql_sub = "SELECT *, b_category_type.id as id_cate_type, b_result.id as id FROM b_result 
				LEFT JOIN b_category_type ON b_result.id_cate_type = b_category_type.id 
				LEFT JOIN b_type ON b_type.id = b_result.id_cate_type 
				WHERE  b_result.`date` = '".$date."' AND b_result.id_category = '".$id_category."'";
				$type = $this->query($sql_sub)->rows;
			}
			// var_dump($sql_sub);
			// exit();
			// var_dump($sql_sub);
			$result = array(
				'status'		=> 'success',
				'desc'			=> 'ค้นหาสำเร็จ',
				'id' 			=> $id_category,
				'name' 			=> $val['name'],
				'flag' 			=> $val['flag'],
				'date_close' 	=> $val['date_close'],
				'date_last_end' => $val['date_last_end'],
				'max_total' 	=> $val['max_total'],
				'sub'			=> $result_cate_sub,
				'type'			=> $type,
				'ratio' 		=> $ratio
			);
				// echo "<pre>";
				// var_dump($result);exit();
				// $fp = fopen($path_json, 'w');
				// fwrite($fp, json_encode($result));
				// fclose($fp);
			// }else{
			// 	$result = json_decode(file_get_contents($path_json), true);
			// }
			return $result;
		}
		public function listReportNo($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$date_end 			= $this->escape($data['date_end']);
			$id_category 	= $data['id_category'];
			$id_type 		= $data['id_type'];
			$order = ' ORDER BY number ASC';
			if($data['order']=='sum_price'){
				$order = ' ORDER BY sum_price DESC';
			}else if($data['order']=='date_create'){
				$order = ' ORDER BY date_create DESC';
			}
			$sql = "
			SELECT `number`,`sum_price`,date_create FROM (
				SELECT b_lotto.`number`,SUM(`b_lotto`.`price`) AS sum_price,b_lotto_bill.`date_create` AS date_create FROM b_lotto 
				LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto_bill.`id` 
				WHERE 
					( b_lotto_bill.`date_create` BETWEEN '".$date_close." 00:00:00' AND '".$date_end." 23:59:59')  
					AND b_lotto.id_type = '".$id_type."'
					AND b_lotto_bill.id_category = '".$id_category."'
				GROUP BY b_lotto.`number` ) t ".$order; 
			// echo $sql;
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function listReportAll($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$date_end 			= $this->escape($data['date_end']);
			$id_category 	= $data['id_category'];
			// $id_type 		= $data['id_type'];
			$order = ' ORDER BY number ASC';
			if($data['order']=='sum_price'){
				$order = ' ORDER BY sum_price DESC';
			}else if($data['order']=='date_create'){
				$order = ' ORDER BY date_create DESC';
			}

			$type=array();
			$sql_all_category = "SELECT * FROM b_type WHERE `sort` IS NOT NULL ORDER BY `sort` ASC ";
			$result_category = $this->query($sql_all_category);
			if($result_category->num_rows){
				foreach($result_category->rows as $val){
					$list = array();
					$sql = "SELECT `number`,`sum_price`,date_create FROM (
								SELECT 	b_lotto.`number`,SUM(`b_lotto`.`price`) AS sum_price,
										b_lotto_bill.`date_create` AS date_create 
								FROM b_lotto 
									LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto_bill.`id` 
								WHERE 
									( b_lotto_bill.`date_create` BETWEEN '".$date_close." 00:00:00' AND '".$date_end." 23:59:59')  
									AND b_lotto.id_type = '".$val['id']."'
									AND b_lotto_bill.id_category = '".$id_category."' 
							GROUP BY b_lotto.`number` ) t ".$order; 
					$list = $this->query($sql)->rows;
					if($list){
						$result[] = array(
							'id'	=> $val['id'],
							'name' 	=> $val['type'],
							'list'	=> $list
						);
					}
				}
			}
			// echo "<pre>";
			// var_dump($result);
			return $result;
		}
		public function getLastDateCategory($id_category=0){
			$result = array();
			$sql = "SELECT DATE(date_close) AS date_close FROM b_category WHERE id = ".$id_category;
			$result = $this->query($sql)->row['date_close'];
			return $result;
		}
		public function listReportAccounting($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$date_end 		= $this->escape($data['date_end']);
			$id_category 	= $data['id_category'];

			$list = array();
			$sql = "SELECT 	b_lotto.`number`,SUM(`b_lotto`.`price`) AS income,SUM(`b_lotto`.`receive`) AS expenses,
								b_lotto_bill.`date_create` AS date_create 
						FROM b_lotto 
							LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto_bill.`id` 
						WHERE 
							( b_lotto_bill.`date_create` BETWEEN '".$date_close." 00:00:00' AND '".$date_end." 23:59:59')  
							AND b_lotto_bill.id_category = '".$id_category."' 
					GROUP BY b_lotto_bill.`id_category`"; 
			$income = (isset($this->query($sql)->row['income'])?$this->query($sql)->row['income']:0);
			$expenses = (isset($this->query($sql)->row['expenses'])?$this->query($sql)->row['expenses']:0);
			$profit = $income-$expenses;
			$diff = ($income>=$expenses?'+':'-');
			$result = array(
				'income'	=> number_format($income,2),
				'expenses'	=> number_format($expenses,2),
				'profit'	=> number_format($profit,2),
				'diff'		=> $diff
			);
			// echo "<pre>";
			// var_dump($result);
			return $result;
		}
		public function listReportAccountingYeekee($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$date_end 		= $this->escape($data['date_end']);
			$id_category 	= $data['id_category'];

			$list = array();
			$sql = "SELECT 	b_lotto.`number`,SUM(`b_lotto`.`price`) AS income,SUM(`b_lotto`.`receive`) AS expenses,
								b_lotto_bill.`date_create` AS date_create 
						FROM b_lotto 
							LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto_bill.`id` 
						WHERE 
							( b_lotto_bill.`date_create` BETWEEN '".$date_close."' AND '".$date_end."')  
							AND b_lotto_bill.id_category = '".$id_category."' 
					GROUP BY b_lotto_bill.`id_category`"; 
					// echo $sql;exit();
			$income = (isset($this->query($sql)->row['income'])?$this->query($sql)->row['income']:0);
			$expenses = (isset($this->query($sql)->row['expenses'])?$this->query($sql)->row['expenses']:0);
			$profit = $income-$expenses;
			$diff = ($income>=$expenses?'+':'-');
			$result = array(
				'income'	=> number_format($income,2),
				'expenses'	=> number_format($expenses,2),
				'profit'	=> number_format($profit,2),
				'diff'		=> $diff
			);
			// echo "<pre>";
			// var_dump($result);
			return $result;
		}
		public function listType(){
			$result = array();
			$result = $this->query("SELECT * FROM b_type")->rows;
			return $result;
		}
		public function listPackage($id_category=0){
			$result = array();
			$result = $this->query("SELECT * FROM b_package WHERE id_category = ".(int)$id_category)->rows;
			return $result;
		}
		public function listBlockNo($id_category=0,$date=''){
			$result = array();
			$date_arr = explode(' ',$date);
			$date = $date_arr[0];
			if(!empty($date)){
				$id_category = (int)$id_category;
				if(!empty($date)){
					$sql = "SELECT *,b_block_number.id AS id FROM b_block_number 
							LEFT JOIN b_block_number_detail ON b_block_number_detail.id = b_block_number.id_type 
							LEFT JOIN b_type ON b_type.id = b_block_number.id_type 
							WHERE date_block = '".$date."' AND b_block_number.id_category = ".$id_category;
					$result = $this->query($sql)->rows;
				}
			}
			return $result;
		}
		public function listBlockNoAll($id_category=0,$date=''){
			$result = array();
			$date_arr = explode(' ',$date);
			$date = $date_arr[0];
			if(!empty($date)){
				$id_category = (int)$id_category;
				if(!empty($date)){
					$sql = "SELECT *,b_block_number_all.id AS id FROM b_block_number_all 
							LEFT JOIN b_block_number_detail ON b_block_number_detail.id = b_block_number_all.id_type 
							LEFT JOIN b_type ON b_type.id = b_block_number_all.id_type 
							WHERE date_block = '".$date."' AND b_block_number_all.id_category = ".$id_category;
					$result = $this->query($sql)->rows;
				}
			}
			return $result;
		}
		public function listBlockNoType($id_category=0,$date=''){
			$result = array();
			$date_arr = explode(' ',$date);
			$date = $date_arr[0];

			if(!empty($date)){
				$id_category = (int)$id_category;
				if(!empty($date)){
					$sql = "SELECT *,b_block_type.id AS id FROM b_block_type 
							LEFT JOIN b_type ON b_type.id = b_block_type.id_type 
							WHERE date_block = '".$date."' 
							AND b_block_type.id_category = ".$id_category;
					$result = $this->query($sql)->rows;
				}
			}
			return $result;
		}
		public function addRatio($data=array(),$id_category=0,$id_package=0){
			$result = array();
			if(!empty($id_package)){
				$sql = 'DELETE FROM b_ratio WHERE id_category='.(int)$id_category.' AND id_package = '.$id_package;
				$query = $this->query($sql);
				foreach($data as $key => $val){

					$arr = array(
						'id_type'=> $key,
						'id_category' => $id_category,
						'price'=>$val,
						'id_package' => $id_package
					);
					$this->insert('ratio',$arr);
				}
			}
		}
		public function addType($data=array(),$date='',$id_category=0){
			if($date){
				$result = array();
				foreach($data as $key => $val){
					$query = $this->query("DELETE FROM b_result 
						WHERE `date`= '".$date."' 
						AND id_category = '".$id_category."'
						AND id_type = '".$key."'");
				}
				foreach($data as $key => $val){
					
					$arr = array(
						'id_cate_type'=> $key,
						'date' => $date,
						'result'=>$val,
						'id_category'=>$id_category,
						'id_type'=>$key
					);
					$this->insert('result',$arr);
				}
			}
		}
		public function delRatio($id_ratio=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_ratio WHERE id = '.(int)$id_ratio;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function delResultType($id_type,$id_category,$date){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_result WHERE id = '.(int)$id_type;
			// echo $sql;exit();
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function delBlockNoType($id=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_block_type WHERE id = '.(int)$id;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function delBlockNoTypeAll($id=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_block_number_all WHERE id = '.(int)$id;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function delBlockNo($id=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_block_number WHERE id = '.(int)$id;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function delBlockNoAll($id=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_block_number_all WHERE id = '.(int)$id;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function saveDateEnd($date_end = '',$date_last_end = '',$id_category=0,$maxtotal=0){
			$result = array(
				'result' => 'fail'
			);
			if(!empty($date_end) AND !empty($id_category)){
				$sql = "UPDATE b_category SET 
				date_close = '".$date_end."', 
				date_last_end = '".$date_last_end."',
				max_total = '".$maxtotal."' 
				WHERE id=".(int)$id_category;
				$result_update = $this->query($sql);
				if($result_update){
					$result = array(
						'result' => 'success'
					);
				}
			}
			return $result;	
		}
		public function editDiscountPackage($id=0,$var=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = "UPDATE b_package SET discount = '".$var."' WHERE id=".(int)$id;
			// echo $sql
			$result = $this->query($sql);
			if($result){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;	
		}
		public function editDiscountRunNoPackage($id=0,$var=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = "UPDATE b_package SET diccount_run_no = '".$var."' WHERE id=".(int)$id;
			// echo $sql
			$result = $this->query($sql);
			if($result){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;	
		}
		public function editNamePackage($id=0,$var=0){
			$result = array(
				'result' => 'fail'
			);
			$sql = "UPDATE b_package SET `name` = '".$var."' WHERE id=".(int)$id;
			// echo $sql
			$result = $this->query($sql);
			if($result){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;	
		}
		public function getBlockNo(){
			$result = array();
			$sql = "SELECT * FROM b_block_number_detail";
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function addBlockNo($data = array()){
			$result = array(
				'result' => 'failed',
			);
			$data_insert = array(
				'num'					=> $data['num'],
				'ratio_price'			=> $data['ratio_price'],
				'max_price'				=> $data['max_price'],
				'date_block'			=> $data['date_block'],
				'id_category'			=> $data['id_category'],
				'id_type'				=> $data['id_type'],
			);
			$result_insert = $this->insert('block_number',$data_insert);
			if($result_insert){
				$result = array(
					'result' => 'success',
					'desc'	=> ''
				);
			}
			return $result;
		}
		public function addBlockNoAll($data = array()){
			$result = array(
				'result' => 'failed',
			);
			$data_insert = array(
				'num'					=> $data['num'],
				'id_condition_detail'	=> $data['id_condition_detail'],
				'max_price'				=> $data['max_price'],
				'date_block'			=> $data['date_block'],
				'id_category'			=> $data['id_category'],
				'id_type'				=> $data['id_type'],
			);
			$result_insert = $this->insert('block_number_all',$data_insert);
			if($result_insert){
				$result = array(
					'result' => 'success',
					'desc'	=> ''
				);
			}
			return $result;
		}
		public function addBlockNoType($data = array()){
			$result = array(
				'result' => 'failed',
			);
			$data_insert = array(
				// 'num'					=> $data['num'],
				// 'id_condition_detail'	=> $data['id_condition_detail'],
				'max_price'				=> $data['max_price'],
				'date_block'			=> $data['date_block'],
				'id_category'			=> $data['id_category'],
				'id_type'				=> $data['id_type'],
			);
			$result_insert = $this->insert('block_type',$data_insert);
			if($result_insert){
				$result = array(
					'result' => 'success',
					'desc'	=> ''
				);
			}
			return $result;
		}
	}
?>
