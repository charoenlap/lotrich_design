<?php 
    class RegisterController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['action'] = route('register/submit');
            $data['bank'] = $this->model('master')->getBank();
            $this->view('register',$data); 
        }
        public function submit(){
        	$result = array(
        		'status' => 'failed',
        		'desc' => ''
        	);
        	if(method_post()){
        		$user 	= $this->model('user');
				$name 				= post('name');
				$lname 				= post('lname');
				$phone 				= post('phone');
				$bank_no 			= post('bank_no');
				$bank_name 			= post('bank_name');
				$bank_no_2 			= post('bank_no_2');
				$bank_name_2 		= post('bank_name_2');
				$email 				= post('email');
				$password 			= post('password');
				$confirm_password 	= post('confirm_password');
				$encrypt 			= encrypt(post('password'));
				$date_create 		= date('Y-m-d H:i:s');

        		if(	!empty($name) 
        			and !empty($lname) 
	        		and !empty($phone) 
	        		and !empty($bank_no) 
	        		and !empty($bank_name) 
	        		and !empty($password) 
	        		and !empty($email) ){
        			if($confirm_password == $password){
		        		$arr_user = array(
							'name'			=> $name,
							'lname'			=> $lname,
							'phone'			=> $phone,
							'bank_no'		=> $bank_no,
							'bank_name'		=> $bank_name,
							'bank_no_2'		=> $bank_no_2,
							'bank_name_2'	=> $bank_name_2,
							'email'			=> $email,
							'password'		=> $password,
							'encrypt'		=> $encrypt,
							'approve'		=> 1,
							'by'			=> 0
		        		);

		        		$result_register = $user->register($arr_user);

		        		$this->setSession('id',encrypt($result_register['id']));
		        		$this->setSession('email',$email);
		        		$this->setSession('name',$name);
		        		$this->setSession('lname',$lname);
		        		$this->setSession('phone',$phone);
		        		$this->setSession('bank_no',$bank_no);
		        		$this->setSession('bank_name',$bank_name);
		        		$this->setSession('bank_no_2',$bank_no_2);
		        		$this->setSession('bank_name_2',$bank_name_2);

		        		$result = array(
			        		'status' => $result_register['status'],
			        		'desc'	=> $result_register['desc']
			        	);
		        	}else{
		        		$result = array(
			        		'status' => 'failed',
			        		'desc' => 'Password not match'
			        	);
		        	}
	        	}else{
					$password 	= (empty($password)?'password, ':''); 
					$email 		= (empty($email)?'email, ':''); 
					$name 		= (empty($name)?'name, ':'');
					$lname 		= (empty($lname)?'lname, ':'');
					$phone 		= (empty($phone)?'phone, ':'');
					$bank_no 	= (empty($bank_no)?'bank_no, ':'');
					$bank_name 	= (empty($bank_name)?'bank_name, ':'');
					$bank_no_2 	= (empty($bank_no)?'bank_no_2, ':'');
					$bank_name_2 	= (empty($bank_name)?'bank_name_2, ':'');
	        		$result = array(
		        		'status' => 'failed',
		        		'desc' => 'Empty '.$password.$email.$name.$lname.$phone.$bank_no.$bank_name
		        	);
	        	}
	        	$this->json($result);
        	}
        }
    }
?>