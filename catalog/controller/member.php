<?php 
	class MemberController extends Controller {
	    // public function index() {
	    // 	$data = array();
	    // 	$style = array(
	    // 		'assets/home.css'
	    // 	);
	    // 	$data['style'] 	= $style;
	    // 	$data['title'] = "LotRich";
	    // 	$data['descreption'] = "";
	    // 	$data['link_contact'] = route('contact');
	    // 	$data['link_dashboard'] = route('home/dashboard');
 	   //  	$this->view('home',$data); 
	    // }
	    public function lottery(){
			$data = array();
	    	$data['title'] = "lottery";
	    	$data['descreption'] = "";
	    	// $data['category'] = $this->model('master')->getCategory();
 	    	$this->view('member/lottery',$data); 
	    }
	    public function dashboard() {
	    	$data = array();
	    	$data['title'] = "dashboard";
	    	$data['descreption'] = "";
	    	$data['category'] = $this->model('master')->getCategory();
	    	$data['link_lottery'] = route('member/lottery');
	    	$data['link_deposit'] = route('member/deposit');
			$data['link_widthdraw'] = route('member/widthdraw');
			$data['link_reward'] = route('member/reward');
			$data['link_ticket'] = route('member/ticket');
			$data['link_finance'] = route('member/finance');
	    	// $data['category'] = $this->model('master')->getCategory();
 	    	$this->view('member/dashboard',$data); 
	    }
	    public function widthdraw(){
	    	$data = array();
	    	$data['title'] = "widthdraw";
	    	$data['descreption'] = "";
 	    	$this->view('member/widthdraw',$data); 
	    }
		public function reward(){
			$data = array();
	    	$data['title'] = "reward";
	    	$data['descreption'] = "";
 	    	$this->view('member/reward',$data); 
		}
		public function ticket(){
			$data = array();
	    	$data['title'] = "ticket";
	    	$data['descreption'] = "";
 	    	$this->view('member/ticket',$data); 
		}
		public function finance(){
			$data = array();
	    	$data['title'] = "finance";
	    	$data['descreption'] = "";
 	    	$this->view('member/finance',$data); 
		}
	    public function deposit(){
	    	$data = array();
	    	$data['title'] = "deposit";
	    	$data['descreption'] = "";
 	    	$this->view('member/deposit',$data); 
	    }
		public function password() {
	    	$data = array();
	    	$data['title'] = "password";
	    	$data['descreption'] = "";
	    	// $data['category'] = $this->model('master')->getCategory();
 	    	$this->view('member/password',$data); 
	    }
		public function logout() {
	    	$data = array();
	    	$data['title'] = "logout";
	    	$data['descreption'] = "";
	    	// $data['category'] = $this->model('master')->getCategory();
 	    	$this->redirect('home'); 
	    }
	}
?>