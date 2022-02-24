<?php 
	class UserModel extends db {
		public function login($data=array()){
			$result = array();
			$email 	= $this->escape(pure_text($data['email']));
			$password 	= $this->escape($data['password']);
			
			$sql = "SELECT * FROM `b_user` 
			WHERE 
				(
					(`email` = '".$email."' AND `password` = '".md5($password)."') 
					OR (`phone` = '".$email."' AND `password` = '".md5($password)."')
					OR (`email_2` = '".$email."' AND `password` = '".md5($password)."')
				)
				AND `del`=0 
			LIMIT 0,1";
			
			$result_user = $this->query($sql); 
			if($result_user->num_rows > 0){
				$result 			= $result_user->row;
				$result['status']	= 'success';
				$result['desc']		= 'เข้าสู่ระบบสำเร็จ';
			}else{
				$result = array(
					'status'		=> 'fail',
					'email'			=> $email,
					'desc'			=> 'ไม่พบข้อมูล กรุณาติดต่อ Admin'
				);
			}
			return $result;
		}
		public function forgot($email=''){
			$result = array();
			$email 	= $this->escape(pure_text($email));
			if(empty($email)){
				$result = array(
					'status'		=> 'fail',
					'email'			=> $email,
					'desc'			=> 'หาไม่พบ'
				);
			}else{
				$sql = "SELECT * FROM `b_user` 
				WHERE `email` = '".trim($email)."' AND `del`=0 
				limit 0,1";
				
				$result_user = $this->query($sql); 
				if($result_user->num_rows > 0){
					$new_password = rand(10000,99999);
					$to_email=trim($email);
					$msg="รหัสผ่านของท่านในการเข้าสู่ระบบคือ ".$new_password." <br>กรุณาเปลี่ยนรหัสผ่านที่ท่านจะใช้บนเว็บไซต์ <a href='".route('login')."'>คลิกที่นี่</a>";
					$subject="รหัสผ่านใหม่ในการเข้าสู่ระบบ";
					sendmailSmtp($to_email,$msg,$subject);
					$this->query("UPDATE b_user set `password`='".md5($new_password)."',`encrypt`='".encrypt($new_password)."' WHERE email = '".$to_email."'");
					// $result 			= $result_user->row;
					$result = array(
						'status'		=> 'success',
						'desc'			=> 'ระบบได้ทำการส่งรหัสผ่านไปที่อีเมลของท่าน'
					);
				}else{
					$result = array(
						'status'		=> 'fail',
						'email'			=> $email,
						'desc'			=> 'หาไม่พบ'
					);
				}
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
			$bank_no_2 		= (!empty($data['bank_no_2']) ? 	$this->escape($data['bank_no_2']):'');
			$bank_name_2 	= (!empty($data['bank_name_2']) ? 	$this->escape($data['bank_name_2']):'');
			$email 			= (!empty($data['email']) ? 		$this->escape($data['email']):'');
			$email_2 		= (!empty($data['email_2']) ? 		$this->escape($data['email_2']):'');
			$password 		= (!empty($data['password']) ? 		$this->escape($data['password']):'');
			$encrypt 		= (!empty($data['encrypt']) ? 		$this->escape($data['encrypt']):'');
			$approve 		= (!empty($data['approve']) ? 		$this->escape($data['approve']):0);
			$by 			= (!empty($data['by']) ? 			$this->escape($data['by']):'');

			if(!empty($email)){
				$sql_check_dupplicate_phone = "SELECT * FROM b_user WHERE phone = '".$phone."'";
				$query_check_phone 		= $this->query($sql_check_dupplicate_phone);

				$sql_check_dupplicate_email = "SELECT * FROM b_user WHERE email = '".$email."'";
				$query_check_email 		= $this->query($sql_check_dupplicate_email);

				$sql_check_dupplicate_email_2 = "SELECT * FROM b_user WHERE email_2 = '".$email_2."'";
				$query_check_email_2 	= $this->query($sql_check_dupplicate_email_2);

				$sql_check_dupplicate_bank_no = "SELECT * FROM b_user WHERE bank_no = '".$bank_no."'";
				$query_check_bank_no 	= $this->query($sql_check_dupplicate_bank_no);

				if($query_check_email->num_rows == 0 
					AND $query_check_bank_no->num_rows == 0
					AND $query_check_email_2->num_rows == 0 
					AND $query_check_phone->num_rows == 0){
					$date_create 	= date('Y-m-d H:i:s');
					$data_insert_user = array(
						'name' 			=> $name,
						'lname' 		=> $lname,
						'phone' 		=> $phone,
						'bank_no' 		=> $bank_no,
						'bank_name' 	=> $bank_name,
						'bank_no_2' 	=> $bank_no_2,
						'bank_name_2' 	=> $bank_name_2,
						'email' 		=> $email,
						'email_2' 		=> $email_2,
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
						$result['desc'][]	= 'ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว';
					}
					if($query_check_email_2->num_rows){
						$result['desc'][]	= 'Email นี้มีอยู่ในระบบแล้ว';
					}
					if($query_check_bank_no->num_rows){
						$result['desc'][]	= 'บัญชีธนาคาร นี้มีอยู่ในระบบแล้ว';
					}
					if($query_check_phone->num_rows){
						$result['desc'][]	= 'เบอร์มือถือ นี้มีอยู่ในระบบแล้ว';
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