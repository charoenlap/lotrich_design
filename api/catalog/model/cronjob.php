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
			
		}
	}
?>