<?php  
	class ReportController extends Controller{
		public function number(){
			$data = array();
			$data['date'] 			= get('date');
			$data['id_category']	= (int)get('category');
			$data['id_type']		= (int)get('type');

			$data['category'] 	= $this->model('master')->listCategory();
			$data['type'] 		= $this->model('master')->listType();
			$data['action'] 	= route('report/number');

			$data_select = array(
				'date' 			=> $data['date'],
				'id_category' 	=> $data['id_category'],
				'id_type' 		=> $data['id_type'],
			);
			$data['result']		= $this->model('master')->listReportNo($data_select);
			$this->view('report/number',$data);
		}
	}
?>