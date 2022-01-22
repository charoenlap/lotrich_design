<?php 
	class FinanceModel extends db {
		public function getDeposit($data = array()){
			$result = array(
				'result' => 'failed'
			);
			$where = '';
			$date = ($data['date']?$data['date']:'');
			if($date){
				$where .= " AND b_transection.date_create like '".$date."%'";
			}
			$sql = "SELECT *,b_transection.id AS id,b_transection.date_create AS date_create FROM b_transection LEFT JOIN b_user ON b_transection.id_user = b_user.id 
				WHERE `type` = 0 ".$where."
				ORDER BY `b_transection`.`status` ASC, b_transection.date_create ASC";
			$result_deposit = $this->query($sql);
			if($result_deposit->num_rows > 0){
				$result = array(
					'result' 	=> 'success',
					'deposit'	=> $result_deposit->rows
				);
			}
			return $result;
		}
		public function addDeposit($data=array()){
			$id_transection = (int)$data['id_transection'];
			
			$sql_check_transection = "SELECT * FROM b_transection WHERE id = ".$id_transection." AND status=0";
			$query_check_transection = $this->query($sql_check_transection);
			if($query_check_transection->num_rows > 0){
				$sql = "UPDATE b_transection SET `status` = '1' , date_modify = '".date('Y-m-d H:i:s')."' WHERE id = '".$id_transection."'";
				$query = $this->query($sql);
				$id_user = $query_check_transection->row['id_user'];
				$balance = $query_check_transection->row['amount'];

				$sql = "UPDATE b_user SET balance = balance + ".$balance." WHERE id = '".$id_user."'";
				$query = $this->query($sql);

				$result = array(
					'result' 			=> 'success',
					'desc'				=> '',
					'balance' 			=> $balance,
					'id'				=> $id_user,
					'id_transection'	=> $id_transection
				);
			}else{
				$result = array(
					'result' 	=> 'failed',
					'desc'		=>	'Transection fail'
				);
			}
			return $result;
		}
		public function getWidthdraw($data = array()){
			$result = array(
				'result' => 'failed'
			);
			$where = '';
			$date = ($data['date']?$data['date']:'');
			if($date){
				$where .= " AND b_transection.date_create like '".$date."%'";
			}
			$sql = "SELECT *,b_transection.id AS id,b_transection.date_create AS date_create FROM b_transection LEFT JOIN b_user ON b_transection.id_user = b_user.id 
			WHERE `type` = 1 ".$where."
			ORDER BY `b_transection`.`status` ASC, b_transection.date_create ASC";
			$result_widthdraw = $this->query($sql);
			if($result_widthdraw->num_rows > 0){
				// var_dump($result_widthdraw->rows);
				$result = array(
					'result' 	=> 'success',
					'widthdraw'	=> $result_widthdraw->rows
				);
			}
			return $result;
		}
		public function addWidthdraw($data=array()){
			$id_transection = (int)$data['id_transection'];
			
			$sql_check_transection = "SELECT * FROM b_transection WHERE id = ".$id_transection." AND status=0";
			$query_check_transection = $this->query($sql_check_transection);
			if($query_check_transection->num_rows > 0){
				$sql = "UPDATE b_transection SET `status` = '1' , date_modify = '".date('Y-m-d H:i:s')."' WHERE id = '".$id_transection."'";
				$query = $this->query($sql);
				$id_user = $query_check_transection->row['id_user'];
				$balance = $query_check_transection->row['amount'];

				$sql = "UPDATE b_user SET balance = balance - ".$balance." WHERE id = '".$id_user."'";
				$query = $this->query($sql);

				$result = array(
					'result' 			=> 'success',
					'desc'				=> '',
					'balance' 			=> $balance,
					'id'				=> $id_user,
					'id_transection'	=> $id_transection
				);
			}else{
				$result = array(
					'result' 	=> 'failed',
					'desc'		=>	'Transection fail'
				);
			}
			return $result;
		}
		public function getLotto($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$date_end 			= $this->escape($data['date_end']);
			// $id_category 	= $data['id_category'];
			// $id_type 		= $data['id_type'];
			$order = ' ORDER BY b_lotto_bill.date_create ASC';
			if($data['order']=='sum_price'){
				$order = ' ORDER BY sum_price DESC';
			}else if($data['order']=='date_create'){
				$order = ' ORDER BY b_lotto_bill.date_create DESC';
			}
			$sql = "SELECT *,
						b_lotto_bill.id AS id,b_lotto_bill.date_create AS date_create,
						b_category.name as category_name,b_lotto_bill.status AS status 
					FROM b_lotto_bill 
						LEFT JOIN b_category ON b_lotto_bill.id_category = b_category.id
						LEFT JOIN b_user ON b_lotto_bill.id_user = b_user.id 
					WHERE 
					( b_lotto_bill.`date_create` BETWEEN '".$date_close." 00:00:00' AND '".$date_end." 23:59:59')  
					
					".$order; 
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function getLottoDetail($id=0){
			$result = array();
			$sql = "SELECT * FROM b_lotto WHERE id_bill = '".(int)$id."'
						ORDER BY b_lotto.date_create DESC";
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function submitBill($data=array()){

			$result = array();
			$id_bill = (int)$data['id_bill'];
			$date = $this->escape($data['date']);
			if(!empty($date)){
				$sql_bill = "SELECT * FROM b_lotto_bill 
								WHERE id = '".(int)$id_bill."' AND `status` = '0'";
				$result_bill = $this->query($sql_bill);
				if( $result_bill->num_rows ){
					$id_category 	= $result_bill->row['id_category'];
					$id_user 		= $result_bill->row['id_user'];
					$sql_bill_detail = "SELECT * FROM b_lotto WHERE id_bill = '".$id_bill."' AND `status`='0'";
					$result_bill_detail = $this->query($sql_bill_detail);
					if( $result_bill_detail->num_rows ){
						$total_receive = 0;
						foreach( $result_bill_detail->rows as $val ){
							$id 		= $val['id'];
							$id_type 	= $val['id_type'];
							$number 	= $val['number'];
							$price 		= $val['price'];
							$ratio 		= $val['ratio'];

							$sql_check_result = "SELECT * FROM b_result 
													WHERE `date` = '".$date."' 
													AND id_cate_type = '".$id_type."' 
													AND `result` LIKE '%".$number."%'";
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
						}
						$sql_update_lotto_bill_status = "UPDATE b_lotto_bill SET `status`='1', `receive`='".$total_receive."' WHERE `id` = '".$id_bill."'";
						$query_update_lotto_bill_status = $this->query($sql_update_lotto_bill_status);

						$sql_update_balance_user = "UPDATE b_user SET `balance` = `balance` + ".$total_receive." 
													WHERE `id` = '".$id_user."'";
						$result_update_balance = $this->query($sql_update_balance_user);
						$result = array(
							'result' => 'Success',
							'desc'	=> '',
							'reward'	=> $total_receive
						);
					}else{
						$result = array(
							'result' => 'Fail',
							'desc'	=> 'Record Empty'
						);
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
?>