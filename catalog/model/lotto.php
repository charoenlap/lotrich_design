<?php 
	class LottoModel extends db {
		public function getBlockNumber($id_category,$date=''){
			$sql = "SELECT *,b_block_number.id AS id FROM b_block_number 
					LEFT JOIN b_block_number_detail ON b_block_number.id_condition_detail = b_block_number_detail.id 
					LEFT JOIN b_type ON b_type.id = b_block_number.id_type 
					WHERE id_category = ".(int)$id_category;
			return $this->query($sql)->rows;
		}
		public function listType($data=array()){
			$id_category 	= (int)$data['id_category'];
			$id_package 	= (int)$data['id_package'];
			$result = array();
			$sql = "SELECT *,b_type.id AS id FROM b_type 
					LEFT JOIN b_ratio ON b_type.id = b_ratio.id_type 
					WHERE 
						b_type.id_parent = 0 
						AND b_type.see_lotto_page = 1 
						AND b_ratio.id_category = '".$id_category."' 
						AND b_ratio.id_package = '".$id_package."' 
				ORDER BY `order` ASC";
			// echo $sql;
			$result_type = $this->query($sql)->rows;
			// var_dump($result_type);
			foreach($result_type as $val){
				$sql_sub = "SELECT *,b_type.id AS id FROM b_type
				LEFT JOIN b_ratio ON b_type.id = b_ratio.id_type 
				 WHERE id_parent = ".$val['id']." 
				 AND b_ratio.id_category = '".$id_category."' 
				 AND b_ratio.id_package = '".$id_package."'  
				 ORDER BY `order` ASC";
				$result_sub_type = $this->query($sql_sub);
				$result[] = array(
					'id'			=> $val['id'],
					'name'			=> $val['type'],
					'digit'			=> $val['digit'],
					'main'			=> $val['main'],
					'allow_parent'	=> $val['allow_parent'],
					'support_digit'	=> $val['support_digit'],
					'price'			=> str_replace('.00','',$val['price']),
					'sub'			=> $result_sub_type->rows
				);
			}
			return $result;
		}
		public function getRatio($data=array()){
			$result = array();

			$id_type		= $data['id_type'];
			$id_category 	= (!empty($data['id_category']) 	? (int)$this->escape($data['id_category'])	:'');
			$id_package 	= (!empty($data['id_package']) 	? (int)$this->escape($data['id_package'])	:'');
			$number			= $data['number'];
			$price 			= (!empty($data['price']) 	? (float)$this->escape($data['price'])	:'');

			$result_rows = array();
			if(!empty($id_type)){
				$sql = "SELECT digit,price,b_type.type AS type_name,b_type.id AS id FROM b_ratio
					LEFT JOIN b_type ON b_ratio.id_type = b_type.id 
					WHERE id_type = '".(int)$id_type."' 
					AND id_category = '".$id_category."' 
					AND id_package = '".$id_package."' 
				";
				$query 	= $this->query($sql);
				if($query->num_rows>0){
					$sql_category = "SELECT * FROM b_category WHERE id = '".$id_category."'";
					$category = $this->query($sql_category);
					if($category->num_rows > 0){
						$limit_number = 0;
						$date_close = $category->row['date_close'];
						$date = date_create($date_close);
						$date = date_format($date,"Y-m-d");
						foreach($number as $num){
							$sql_block_number = "SELECT * FROM b_block_number 
							LEFT JOIN b_block_number_detail ON b_block_number.id_condition_detail = b_block_number_detail.id
							 WHERE date_block = '".$date."' AND num = '".(int)$num."' AND id_type = '".(int)$id_type."'";
							$block_number = $this->query($sql_block_number);
							$condition = 1;
							$ratio = $query->row['price'];
							if($block_number->num_rows > 0 ){
								$condition = $block_number->row['condition'];
								$limit_number = 1;
								$ratio = $ratio * $condition;
							}
							$price = 1 * $condition;
							$paid = $query->row['price'] * $price;
							// var_dump($query->rows);
							$result[] = array(
								'ratio'		=> $ratio,
								'type'		=> $query->row['type_name'],
								'number'	=> str_pad($num,$query->row['digit'],"0", STR_PAD_LEFT),
								'price'		=> 1,
								'id_type'	=> $query->row['id'],
								'paid'		=> $paid,
								'limit_number'=> $limit_number,
								'digit'		=> $query->row['digit']
							);
						}
					}
				}
			}
			return $result;
		}
		public function getLotto($id_user = 0){
			$result = array(
				'status' 	=> 'failed'
			);
			$sql = "SELECT *, b_lotto_bill.id AS id,b_category.`name` AS category_name FROM b_lotto_bill 
				LEFT JOIN b_category ON b_category.id = b_lotto_bill.id_category 
				WHERE b_lotto_bill.id_user = '".$id_user."' ORDER BY b_lotto_bill.id DESC";
			$query 	= $this->query($sql);
			if($query->num_rows>0){
				foreach($query->rows as $val){
					$sql = "SELECT * FROM b_lotto WHERE id_bill = ".$val['id']."";
					$query_lotto 	= $this->query($sql);
					$bill[] = array(
						'id'		=> $val['id'],
						'name'		=> $val['name'],
						'date_create'=> $val['date_create'],
						'total'		=> $val['total'],
						'receive'	=> $val['receive'],
						'lotto' 	=> $query_lotto->rows
					);
				}
				$result = array(
					'status' 	=> 'success',
					'bill'		=> $bill
				);
			}
			return $result;
		}
		public function addLotto($data=array(),$id_user=0,$id_category=0,$sum_price=0){
			$result = array(
				'status' 	=> 'failed',
				'desc'		=> 'Not login'
			);
			if($id_user){
				$lotto = $data;
				if(!empty($lotto)){
					$id_category = (int)$id_category;
					$date_close = '';
					$result_get_date_closed = $this->query('SELECT date_close FROM b_category WHERE `id` = '.$id_category.' LIMIT 0,1');
					if($result_get_date_closed->num_rows){
						$date_close = $result_get_date_closed->row['date_close'];

						$date1			= date_create_from_format("Y-m-d H:i:s",date("Y-m-d H:i:s"));
						$date2			= date_create_from_format("Y-m-d H:i:s", $date_close);
						$diff 			= date_diff($date1,$date2);
						$result_diff 	= $diff->format("%R");

						if($result_diff=="+"){
							if(!empty($date_close)){
								$arr = array(
									'id_user' 		=> $id_user,
									'id_category'	=> $id_category,
									'date_create' 	=> date('Y-m-d H:i:s'),
									'total'			=> $sum_price,
									'receive'		=> 0,
									'date_close'	=> $date_close
								);
								$id_bill = $this->insert("lotto_bill",$arr);
								foreach($lotto as $val){
									$insert = array(
										'date_create' 	=> date('Y-m-d H:i:s'),
										'number' 		=> $val['number'],
										'price' 		=> $val['price'],
										'paid' 			=> $val['paid'],
										'ratio' 		=> $val['ratio'],
										'id_type' 		=> $val['id_type'],
										'type' 			=> $val['type'],
										'status' 		=> $val['status'],
										'id_bill'		=> $id_bill
									);
									$this->insert('lotto',$insert);
								}
								$result = array(
									'status' 	=> 'success',
									'desc'	=> $id_bill
								);
							}else{
								$result = array(
									'status' 	=> 'failed',
									'desc'	=> 'ไม่พบวันที่ปิด หากต้องการข้อมูลเพิ่มเติมกรุณาติดต่อเจ้าหน้าที่'
								);
							}
						}else{
							$result = array(
								'status' 	=> 'failed',
								'desc'	=> 'หมดเวลาในการแทงหวย หากต้องการข้อมูลเพิ่มเติมกรุณาติดต่อเจ้าหน้าที่'
							);
						}
					}else{
						$result = array(
							'status' 	=> 'failed',
							'desc'	=> 'ไม่พบวันที่สิ้นสุด หากต้องการข้อมูลเพิ่มเติมกรุณาติดต่อเจ้าหน้าที่'
						);
					}
				}else{
					$result = array(
						'status' 	=> 'failed',
						'desc'	=> 'ไม่พบการแทง หากต้องการข้อมูลเพิ่มเติมกรุณาติดต่อเจ้าหน้าที่'
					);
				}
			}
			return $result;
		}
		public function getLottoRatio($number=0,$id_category=0,$id_type=0,$id_package=0){
			$condition = 0;
			$limit_number = 0;

			if(!empty($id_type)){
				$sql = "SELECT digit,price,b_type.type AS type_name,b_type.id AS id FROM b_ratio
					LEFT JOIN b_type ON b_ratio.id_type = b_type.id 
					WHERE id_type = '".(int)$id_type."' 
					AND id_category = '".(int)$id_category."' 
					AND id_package = '".(int)$id_package."' 
				";
				$query 	= $this->query($sql);
				if($query->num_rows>0){
					$sql_category = "SELECT * FROM b_category WHERE id = '".$id_category."'";
					$category = $this->query($sql_category);
					if($category->num_rows > 0){
						$limit_number = 0;
						$date_close = $category->row['date_close'];
						$date = date_create($date_close);
						$date = date_format($date,"Y-m-d");

						$sql_block_number = "SELECT * FROM b_block_number 
						LEFT JOIN b_block_number_detail ON b_block_number.id_condition_detail = b_block_number_detail.id
						 WHERE date_block = '".$date."' AND num = '".$number."' AND id_type = '".(int)$id_type."'";
						$block_number = $this->query($sql_block_number);
						$condition = 1;
						if($block_number->num_rows > 0 ){
							$condition = $block_number->row['condition'];
							$limit_number = 1;
						}
						$price = 1 * $condition;
						$paid = $query->row['price'] * $price;

						// $sql_ratio = "SELECT * FROM b_ratio 
						//  WHERE id_type = '.$id_type.' AND  id_category = '.$id_category.' AND id_package = '.$id_package.'";
						// $ratio = $this->query($sql_ratio);
					}
					$result = array(
						'status' 		=> 'success',
						'desc'			=> '',
						'condition' 	=> (int)$condition,
						'limit_number' 	=> $limit_number,
						'ratio'			=> $query->row['price'],
						'type'			=> $query->row['type_name']
					);
				}else{
					$result = array(
						'status' 		=> 'failed',
						'desc'			=> 'num_rows',
						'sql'			=> $sql
					);
				}
			}else{
				$result = array(
					'status' 		=> 'failed',
					'desc'			=> 'id_type',
				);
			}
			return $result;
		}
	}
?>