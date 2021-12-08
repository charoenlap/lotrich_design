<?php 
	class SystemModel extends db {
		public function getSetting($data = array()){
			$result = array(
				'result' => 'fail'
			);
			$sql = "SELECT * FROM b_setting";
			$result_setting = $this->query($sql);
			if($result_setting->num_rows > 0){
				$result = array(
					'result' 	=> 'success',
					'detail'	=> $result_setting->rows
				);
			}
			return $result;
		}
		public function submit($data = array()){
			if($data){
				foreach($data as $key => $val){
					$sql = "UPDATE b_setting SET `val` = '".$val."' WHERE `name` = '".$key."'";
					// echo $sql.'<br>';
					$this->query($sql);
				}
			}
		}
	}
?>