<?php 
	class SystemModel extends db {
		public function getbank($data = array()){
			$result = array();
			$sql = "SELECT * FROM b_bank";
			$result = $this->query($sql);
			return $result->rows;
		}
		public function bankList($data = array()){
			$result = array();
			$sql = "SELECT *,b_bank_take.id as id FROM b_bank_take LEFT JOIN b_bank ON b_bank_take.id_bank = b_bank.id";
			$result = $this->query($sql);
			return $result->rows;
		}
		public function addBank($input = array()){
			$result = array();
			$result = $this->insert('bank_take',$input);
			return $result;
		}
		public function delBank($id=0){
			$result = array();
			$result = $this->delete('bank_take','id = '.$id);
			return $result;
		}
		public function statusBank($id=0,$val=0){
			$result = array();
			$result = $this->query('UPDATE b_bank_take SET `status` = '.$val.' WHERE id = '.$id);
			return $result;
		}
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