<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	
	    	$style = array(
	    		'assets/home.css'
	    	);
	    	$data['style'] 	= $style;
	    	$data['title'] = "LotRich";
	    	$data['descreption'] = "";
	    	$data['link_contact'] = route('contact');
	    	$data['link_dashboard'] = route('home/dashboard');
	    	$data['link_login']	= route('login');
 	    	$this->view('home',$data); 
	    }
	}
?>