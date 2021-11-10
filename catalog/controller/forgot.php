<?php 
    class ForgotController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['link_line'] = route('contact');
            $data['action'] = route('forgot/submit');
            $this->view('forgot',$data); 
        }
        public function submit(){
        	$result = array(
        		'status' => 'failed',
        		'desc' => ''
        	);
        	if(method_post()){
        		$email = post('email');
        		$user 	= $this->model('user');
        		$result_forgot = $user->forgot($email);

        		$result = array(
	        		'status' => $result_forgot['status'],
	        		'desc'	=> $result_forgot['desc']
	        	);
		        	
	        	
	        	$this->json($result);
        	}
        }
    }
?>