<?php 
	class LottoModel extends db {
		public function getRatio($data=array()){
			$result = array(
				'status' 	=> 'failed',
				'ratio'		=> 0 
			);
			$id_type		= (!empty($data['id_type']) 	? (int)$this->escape($data['id_type'])	:'');
			$id_category 	= (!empty($data['id_category']) 	? (int)$this->escape($data['id_category'])	:'');

			$sql = "SELECT price,b_type.type AS type_name FROM b_ratio
				LEFT JOIN b_type ON b_ratio.id_type = b_type.id 
				WHERE id_type = '".(int)$id_type."' AND id_category = '".$id_category."'";
			$query 	= $this->query($sql);
			if($query->num_rows>0){
				$result = array(
					'status' 	=> 'success',
					'ratio'		=> $query->row['price'],
					'type'		=> $query->row['type_name']
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