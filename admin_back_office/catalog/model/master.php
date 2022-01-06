<?php 
	class MasterModel extends db {
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
			if($date==''){
				$date = date('Y-m-d');
			}
			$result = array();
			$path_json = PATH_JSON.'/getCategory.json';
			if(!isset($data['db'])){
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
						LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
						LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
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
					$sql_sub = "SELECT *, b_category_type.id AS id FROM b_category_type 
					LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
					LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
					WHERE `status`=0 
					AND id_category = '".$id_category."' 
					ORDER BY b_category_type.`order` ASC";
					$type = $this->query($sql_sub)->rows;

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
				$fp = fopen($path_json, 'w');
				fwrite($fp, json_encode($result));
				fclose($fp);
			}else{
				$result = json_decode(file_get_contents($path_json), true);
			}
			return $result;
		}
		public function listReportNo($data=array()){
			$result = array();
			$date_close 	= $this->escape($data['date']);
			$id_category 	= $data['id_category'];
			$id_type 		= $data['id_type'];
			$order = ' ORDER BY number';
			if($data['order']=='sum_price'){
				$order = ' ORDER BY sum_price';
			}
			$sql = "
			SELECT `number`,`sum_price` FROM (
				SELECT b_lotto.`number`,SUM(`b_lotto`.`price`) AS sum_price FROM b_lotto 
				LEFT JOIN b_lotto_bill ON b_lotto.id_bill = b_lotto_bill.`id` 
				WHERE 
					b_lotto_bill.`date_close` like '".$date_close."%' 
					AND b_lotto.id_type = '".$id_type."'
					AND b_lotto_bill.id_category = '".$id_category."'
				GROUP BY b_lotto.`number` ) t ".$order;
			// echo $sql;
			$result = $this->query($sql)->rows;
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
		public function addType($data=array(),$date=''){
			if($date){
				$result = array();
				foreach($data as $key => $val){
					$query = $this->query("DELETE FROM b_result WHERE `date`= '".$date."' AND id_cate_type='".(int)$key."'");
					$arr = array(
						'id_cate_type'=> $key,
						'date' => $date,
						'result'=>$val
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
				'id_condition_detail'	=> $data['id_condition_detail'],
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
