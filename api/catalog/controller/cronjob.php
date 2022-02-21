<?php 
	class CronjobController extends Controller {
	    public function index() {

	    }
	    public function checkByMidNight(){
	    	$data = array();
	    	$dataSelect = array(
	    		'date'	=>	date('Y-m-d')
	    	);
	    	$resultCheckDate = $this->model('cronjob')->checkCreateDate($dataSelect);
	    }
	    public function checkBy15Min(){
	    	$data = array();
	    	$dataSelect = array(
	    		'code'		=>	date('ymdHi'),
	    		'id_round'	=>	get('id_round')
	    	);
	    	// $changeStatus 	= $this->model('cronjob')->changeStatus($dataSelect);
	    	$calculate 		= $this->model('cronjob')->calculate($dataSelect);
	    }
	}
?>