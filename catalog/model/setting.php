<?php 
	class SettingModel extends db {
		public function getSetting(){
			$result = array();
			$sql = "SELECT * FROM b_setting";
			$query = $this->query($sql)->rows;
			foreach($query as $val){
				$result[$val['name']] = $val['val'];
			}
			return $result;
		}
	}
?>