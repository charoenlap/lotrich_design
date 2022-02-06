<?php 
	class MasterModel extends db {
		public function checkRegister($val){
			$result = array(
				'status'	=>	'fail'
			);
			if(!empty($val)){
				$sql_check = "SELECT * FROM b_user WHERE 
				phone = '".$val."' 
				OR email = '".$val."' 
				OR email_2 = '".$val."' 
				OR bank_no = '".$val."' 
				OR bank_no_2 = '".$val."'";
				$query_check 		= $this->query($sql_check);

				if($query_check->num_rows == 0){
					$result['status'] 	= 'success';
					$result['desc']	= 'สามารถใช้ได้';
				}else{
					$result['status'] 	= 'fail';
					$result['desc']	= 'ไม่สามารถใช้ได้';
					
				}
			}
			return $result;
		}
		public function getRound($data = array()){
			$result = array(
				'status'	=>	'fail',
				'yeekee'	=> array()
			);
			$hour_now = date('H');
			$min_now = date('i');

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
		// public function check
		public function bankList($data = array()){
			$result = array();
			$sql = "SELECT *,b_bank_take.id as id,b_bank_take.name as `name`,b_bank.name as `bank` FROM b_bank_take 
			LEFT JOIN b_bank ON b_bank_take.id_bank = b_bank.id";
			$result = $this->query($sql);
			return $result->rows;
		}
		public function getLogoBank($data = array()){
			$result = array();
			$sql = "SELECT * FROM b_bank";
			$result = $this->query($sql);
			return $result->row['image'];
		}
		public function getDateLastedResult(){
			return $this->query("SELECT * FROM b_result ORDER BY date ASC limit 0,1")->row['date'];
		}
		public function getPackage($id){
			return $this->query("SELECT * FROM b_package WHERE id_category = ".(int)$id)->rows;
		}
		public function getBank(){
			return $this->query("SELECT * FROM b_bank")->rows;
		}
		public function getCategory($data=array()){
			$date = $this->escape((isset($data['date'])?$data['date']:date('Y-m-d')));
			$result = array();
			$path_json = PATH_JSON.'/getCategory.json';
			// if(!isset($data['db'])){
				$sql = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = 0 ORDER BY `order_by` ASC";
				$category = $this->query($sql)->rows;
				$last_date = '';
				// echo "<pre>";
				// var_dump($category);exit();
				foreach($category as $val){
					$sub = array();
					// $sql_last_date = "SELECT * FROM b_result WHERE id_cate_type = '".$val['id']."' ORDER BY date DESC limit 0,1";
					// $query_last_date = $this->query($sql_last_date);
					// if($query_last_date->num_rows){
					// 	$last_date = $query_last_date->row['date'];
					// }

					$sql_sub = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = '".$val['id']."'";
					$category_sub = $this->query($sql_sub)->rows;
					$result_cate_sub = array();
					foreach($category_sub as $cs){

						$result_date_cate = '';
						$sql_date = "SELECT * FROM b_result WHERE `id_category` = '".$val['id']."' ORDER BY `date` DESC LIMIT 0,1";
						$query_date = $this->query($sql_date);
						if($query_date->num_rows){
							$result_date_cate = $query_date->row['date'];
						}
						$sql_sub_in = "SELECT * FROM b_category_type 
						LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
						LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$result_date_cate."') result 
							ON result.id_category = b_category_type.id_category AND result.id_type = b_category_type.id_type
						WHERE `status`=0 
						AND result.id_category = '".$cs['id']."' 
						ORDER BY b_type.`sort` ASC";
						$type_sub = $this->query($sql_sub_in)->rows;

						$date1			= date_create_from_format("Y-m-d H:i:s",date("Y-m-d H:i:s"));
						$date2			= date_create_from_format("Y-m-d H:i:s", $cs['date_close']);
						$diff 			= date_diff($date1,$date2);
						$result_diff 	= $diff->format("%R");

						$result_cate_sub[] = array(
							'id' 		=> $cs['id'],
							'name' 		=> $cs['name'],
							'flag' 		=> $cs['flag'],
							'name' 		=> $cs['name'],
							'type' 		=> $type_sub,
							'diff_date'	=> $result_diff
						);
					}
					$type = array();
					$result_date_cate = '';
					$sql_date = "SELECT * FROM b_result WHERE `id_category` = '".$val['id']."' ORDER BY `date` DESC LIMIT 0,1";
					$query_date = $this->query($sql_date);
					if($query_date->num_rows){
						$result_date_cate = $query_date->row['date'];
					}
					$sql_sub = "SELECT *,b_type.type AS type FROM b_category_type 
					LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$result_date_cate."') result 
						ON result.id_category = b_category_type.id_category AND result.id_type = b_category_type.id_type
					LEFT JOIN b_type ON b_type.id = result.id_type
					WHERE `status`=0 
					AND result.id_category = '".$val['id']."' 
					ORDER BY b_type.`sort` ASC";
					$type = $this->query($sql_sub)->rows;

					$date1			= date_create_from_format("Y-m-d H:i:s",date("Y-m-d H:i:s"));
					$date2			= date_create_from_format("Y-m-d H:i:s", $val['date_close']);
					$diff 			= date_diff($date1,$date2);
					$result_diff 	= $diff->format("%R");
					// var_dump($date1);echo "<br>";
					$result[] = array(
						'id' 			=> $val['id'],
						'name' 			=> $val['name'],
						'flag' 			=> $val['flag'],
						'sub'			=> $result_cate_sub,
						'type'			=> $type,
						'date_close' 	=> $val['date_close'],
						'column' 		=> $val['column'],
						'last_date' 	=> $result_date_cate,//$last_date,
						'diff_date'		=> $result_diff
					);
				}
				// exit();
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
		public function getCategoryDetail($id){
			$result = array();
			$sql = "SELECT * FROM b_category WHERE `status`=0 AND id = ".(int)$id;
			$result = $this->query($sql)->row;
			return $result;
		}
	}
?>