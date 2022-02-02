<?php 
	class YeekeeModel extends db {
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
	}
?>