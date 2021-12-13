<?php 
	class UserModel extends db {
		public function listUser($data = array()){
			$result = array(
				'result' => 'fail',
				'row'	 => array(),
				'num_rows'	=> 0
			);
			$sql = "SELECT * FROM b_user ORDER by id ASC";
			$result_user = $this->query($sql);
			if($result_user->num_rows > 0){
				$result = array(
					'result' 	=> 'success',
					'rows' 		=> $result_user->rows,
					'num_rows' 	=> $result_user->num_rows
				);
			}
			return $result;
		}
		public function del($id=0){
			$result = array(
				'result' => 'fail'
			);
			if($id){
				$sql = "UPDATE b_user SET `del`=1 WHERE id = ".(int)$id;
				$result = $this->query($sql);
			}
			return $result;
		}
	}
?>