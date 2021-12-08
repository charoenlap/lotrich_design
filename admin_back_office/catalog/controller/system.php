<?php  
	class SystemController extends Controller{
		public function index(){
			$data = array();
			$id_admin = $this->getSession('id_admin');
	    	if($id_admin){
	    		if(method_post()){
	    			$post = $_POST;
	    			if(isset($_FILES["logo"])){
		    			if(!empty($_FILES["logo"]['name'])){
		    				$name = time().'_'.$_FILES["logo"]['name'];
		    				$path = "uploads/logo/";
		    				upload($_FILES["logo"],'../'.$path,$name);
		    				$post['logo'] = $path.$name;
		    			}
		    		}
	    			$this->model('system')->submit($post);
	    			$this->redirect('system&result=success');
	    		}else{
					$data['setting'] = $this->model('system')->getSetting();
					$data['action'] = route('system');
					$data['result'] = get('result');
					$this->view('system/index',$data);
				}
			}else{
				$this->redirect('home/login');
			}
		}
	}
?>