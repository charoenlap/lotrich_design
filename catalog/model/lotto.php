<?php 
	class LottoModel extends db {
		public function getBlockNumber($id_category){
			$sql = "SELECT * FROM b_block_number 
					LEFT JOIN b_block_number_detail ON b_block_number.id = b_block_number_detail.id_block WHERE id_category = ".(int)$id_category;
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
			foreach($result_type as $val){
				$sql_sub = "SELECT * FROM b_type WHERE id_parent = ".$val['id']."  ORDER BY `order` ASC";
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
			$result = array(
				'status' 	=> 'failed',
				'ratio'		=> 0 
			);
			$id_type		= $data['id_type'];
			$id_category 	= (!empty($data['id_category']) 	? (int)$this->escape($data['id_category'])	:'');
			$id_package 	= (!empty($data['id_package']) 	? (int)$this->escape($data['id_package'])	:'');
			$number			= (!empty($data['number']) 	? (int)$this->escape($data['number'])	:'');
			$price 			= (!empty($data['price']) 	? (float)$this->escape($data['price'])	:'');

			$result_rows = array();
			if(!empty($id_type)){
				foreach($id_type as $v){
					$sql = "SELECT price,b_type.type AS type_name,b_type.id AS id FROM b_ratio
						LEFT JOIN b_type ON b_ratio.id_type = b_type.id 
						WHERE id_type = '".(int)$v."' 
						AND id_category = '".$id_category."' 
						AND id_package = '".$id_package."' 
					";
					$query 	= $this->query($sql);
					if($query->num_rows>0){
						$result_rows[] = array(
								'ratio'		=> $query->row['price'],
								'type'		=> $query->row['type_name'],
								'number'	=> $number,
								'price'		=> $price,
								'id_type'	=> $query->row['id'],
								'paid'		=> $query->row['price'] * $price
						);
					}
				}
				$result = array(
					'status'	=> 'success',
					'rows'		=> $result_rows
				);
			}
			return $result;
		}
		public function getLotto($id_user = 0){
			$result = array(
				'status' 	=> 'failed'
			);
			$sql = "SELECT *, b_lotto_bill.id AS id FROM b_lotto_bill 
				LEFT JOIN b_category ON b_category.id = b_lotto_bill.id_category 
				WHERE b_lotto_bill.id_user = '".$id_user."'";
			$query 	= $this->query($sql);
			if($query->num_rows>0){
				foreach($query->rows as $val){
					$sql = "SELECT * FROM b_lotto WHERE id_bill = ".$val['id'];
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
					$arr = array(
						'id_user' 		=> $id_user,
						'id_category'	=> $id_category,
						'date_create' 	=> date('Y-m-d H:i:s'),
						'total'			=> $sum_price,
						'receive'		=> 0
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
						'desc'	=> 'Not found lotto'
					);
				}
			}
			return $result;
		}
	}
?>