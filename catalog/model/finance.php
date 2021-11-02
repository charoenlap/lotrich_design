<?php 
	class FinanceModel extends db {
		public function widthdrawBalance($id=0,$price){
			$result = array();
			$id_user = (int)$id;
			$sql = "UPDATE b_user SET balance = balance - ".(float)$price." WHERE id = ".$id_user;
			$query 	= $this->query($sql);
			return true;
		}
		public function deposit($data=array()){
			$data_insert = array(
				'id_user'		=> (!empty($data['id_user']) 	? (int)$this->escape($data['id_user'])	:''),
				'amount' 		=> (!empty($data['amount']) 	? (float)$this->escape($data['amount'])	:''),
				'type'			=> (!empty($data['type']) 		? $this->escape($data['type'])		:''),
				'status'		=> (!empty($data['status']) 	? $this->escape($data['status'])	:''),
				'hour'			=> (!empty($data['hour']) 		? (int)$this->escape($data['hour'])		:''),
				'minutes'		=> (!empty($data['minutes']) 	? (int)$this->escape($data['minutes'])	:''),
				'img'			=> (!empty($data['img']) 		? $this->escape($data['img'])		:''),
				'detail'		=> (!empty($data['detail']) 	? $this->escape($data['detail'])	:''),
				'date_create'	=> date('Y-m-d H:i:s'),
			);
			$id = $this->insert('transection',$data_insert);
			return true;
		}
		public function widthdraw($data=array()){
			$data_insert = array(
				'id_user'		=> (!empty($data['id_user']) 	? (int)$this->escape($data['id_user'])	:''),
				'amount' 		=> (!empty($data['amount']) 	? (float)$this->escape($data['amount'])	:''),
				'type'			=> (!empty($data['type']) 		? $this->escape($data['type'])		:''),
				'status'		=> (!empty($data['status']) 	? $this->escape($data['status'])	:''),
				'hour'			=> (!empty($data['hour']) 		? (int)$this->escape($data['hour'])		:''),
				'minutes'		=> (!empty($data['minutes']) 	? (int)$this->escape($data['minutes'])	:''),
				'img'			=> (!empty($data['img']) 		? $this->escape($data['img'])		:''),
				'detail'		=> (!empty($data['detail']) 	? $this->escape($data['detail'])	:''),
				'date_create'	=> date('Y-m-d H:i:s'),
			);
			$id = $this->insert('transection',$data_insert);
			return true;
		}
		public function getTransection($id){
			$id_user = (int)$id;
			$sql = "SELECT * FROM b_transection WHERE id_user = '".(int)$id_user."' ORDER BY date_create ASC";
			$query 	= $this->query($sql);
			return $query->rows;
		}
		public function getBalance($id){
			$id_user = (int)$id;
			$sql = "SELECT balance FROM b_user WHERE id = '".(int)$id_user."'";
			$query 	= $this->query($sql);
			return $query->row['balance'];
		}
	}
?>