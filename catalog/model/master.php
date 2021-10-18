<?php 
	class MasterModel extends db {
		public function getCategory($data=array()){
			$date = "2021-10-01";
			$result = array();
			$path_json = PATH_JSON.'/getCategory.json';
			if(!isset($data['db'])){
				$sql = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = 0";
				$category = $this->query($sql)->rows;

				foreach($category as $val){
					$sub = array();
					$sql_sub = "SELECT * FROM b_category WHERE `status`=0 AND sub_category = '".$val['id']."'";
					$category_sub = $this->query($sql_sub)->rows;
					$result_cate_sub = array();
					foreach($category_sub as $cs){
						$sql_sub_in = "SELECT * FROM b_category_type 
						LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
						LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
						WHERE `status`=0 
						AND id_category = '".$cs['id']."' 
						ORDER BY b_category_type.`order` ASC";
						$type_sub = $this->query($sql_sub_in)->rows;
						$result_cate_sub[] = array(
							'name' => $cs['name'],
							'type' => $type_sub
						);
					}
					$type = array();
					$sql_sub = "SELECT * FROM b_category_type 
					LEFT JOIN b_type ON b_category_type.id_type = b_type.id 
					LEFT JOIN (SELECT * FROM b_result WHERE `date` = '".$date."') result ON result.id_cate_type = b_category_type.id 
					WHERE `status`=0 
					AND id_category = '".$val['id']."' 
					ORDER BY b_category_type.`order` ASC";
					$type = $this->query($sql_sub)->rows;

					$result[] = array(
						'id' 	=> $val['id'],
						'name' 	=> $val['name'],
						'flag' 	=> $val['flag'],
						'sub'	=> $result_cate_sub,
						'type'	=> $type
					);
				}
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
	}
?>