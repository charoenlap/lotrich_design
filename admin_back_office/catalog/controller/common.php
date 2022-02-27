<?php 
	class CommonController extends Controller {
	    public function header($data=array()) {
	    	$data = array();
	    	$data['deposit'] = $this->model('finance')->notiDeposit();
	    	$data['widthdraw'] = $this->model('finance')->notiWidthdraw();
	    	$this->render('common/header',$data);
	    }
	    public function footer($data=array()){
	    	$this->render('common/footer',$data);
	    }
	    public function logout($data=array()){
	    	session_destroy();
	    	$this->redirect('home',$data);
	    }
	}
?>