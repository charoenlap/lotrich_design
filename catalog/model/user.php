<?php 
	class UserModel extends db {
		public function login($data=array()){
			$result = array();
			$email 	= $this->escape(pure_text($data['email']));
			$password 	= $this->escape($data['password']);
			
			$sql = "SELECT * FROM `b_user` 
			WHERE `email` = '".$email."' AND `password` = '".md5($password)."' 
			limit 0,1";
			
			$result_user = $this->query($sql); 
			if($result_user->num_rows > 0){
				$result 			= $result_user->row;
				$result['status']	= 'success';
				$result['desc']		= 'Login complete';
			}else{
				$result = array(
					'status'		=> 'fail',
					'email'			=> $email,
					'desc'			=> 'Not found in database.'
				);
			}
			return $result;
		}
		public function register($data=array()){
			$result = array();

			$name 			= (!empty($data['name']) ? 			$this->escape($data['name']):'');
			$lname 			= (!empty($data['lname']) ? 		$this->escape($data['lname']):'');
			$phone 			= (!empty($data['phone']) ? 		$this->escape($data['phone']):'');
			$bank_no 		= (!empty($data['bank_no']) ? 		$this->escape($data['bank_no']):'');
			$bank_name 		= (!empty($data['bank_name']) ? 	$this->escape($data['bank_name']):'');
			$email 			= (!empty($data['email']) ? 		$this->escape($data['email']):'');
			$password 		= (!empty($data['password']) ? 		$this->escape($data['password']):'');
			$encrypt 		= (!empty($data['encrypt']) ? 		$this->escape($data['encrypt']):'');
			$approve 		= (!empty($data['approve']) ? 		$this->escape($data['approve']):0);
			$by 			= (!empty($data['by']) ? 			$this->escape($data['by']):'');

			if(!empty($email)){
				$sql_check_dupplicate_email = "SELECT * FROM b_user WHERE email = '".$email."'";
				$query_check_email 		= $this->query($sql_check_dupplicate_email);

				$sql_check_dupplicate_bank_no = "SELECT * FROM b_user WHERE bank_no = '".$bank_no."'";
				$query_check_bank_no 	= $this->query($sql_check_dupplicate_bank_no);

				if($query_check_email->num_rows == 0 AND $query_check_bank_no->num_rows == 0){
					$date_create 	= date('Y-m-d H:i:s');
					$data_insert_user = array(
						'name' 			=> $name,
						'lname' 		=> $lname,
						'phone' 		=> $phone,
						'bank_no' 		=> $bank_no,
						'bank_name' 	=> $bank_name,
						'email' 		=> $email,
						'password' 		=> md5($password),
						'encrypt' 		=> $encrypt,
						'date_create' 	=> $date_create,
						'approve'		=> $approve,
						'by'			=> $by
					);
					$id = $this->insert('user',$data_insert_user);
					$result['id'] 		= $id;
					$result['status'] 	= 'success';
					$result['desc'] 	= 'สมัครสมาชิกเรียบร้อย ท่านจะสามารถเข้าสู่ระบบ ได้หลังจากเจ้าหน้าที่อนุมัติ กรุณารอซักครู่';
					return $result;
				}else{
					$result['status'] 	= 'fail';
					if($query_check_email->num_rows){
						$result['desc'][]	= 'Email นี้มีอยู่ในระบบแล้ว';
					}
					if($query_check_bank_no->num_rows){
						$result['desc'][]	= 'บัญชีธนาคาร นี้มีอยู่ในระบบแล้ว';
					}
					return $result;
				}
			}else{
				$result['status'] 	= 'fail';
				$result['desc']		= 'Email เป็นค่าว่าง';
				return $result;
			}
		}
		
		public function findEamil($email) {
			$this->where('user_email', $email);
			$result = $this->get('user');
			return $result->num_rows;
		}
	}
?>