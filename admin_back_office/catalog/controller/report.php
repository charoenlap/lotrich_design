<?php  
	class ReportController extends Controller{
		public function number(){
			$data = array();
			$data['date'] 			= get('date');
			$data['date_end'] 		= get('date_end');
			$data['id_category']	= (int)get('category');
			$data['id_type']		= (int)get('type');
			$data['order']			= get('order');

			$data['category'] 	= $this->model('master')->listCategory();
			$data['type'] 		= $this->model('master')->listType();
			$data['action'] 	= route('report/number');

			$data_select = array(
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
				'id_category' 	=> $data['id_category'],
				'id_type' 		=> $data['id_type'],
				'order'			=> $data['order']
			);
			$data['result']		= $this->model('master')->listReportNo($data_select);
			$this->view('report/number',$data);
		}
		public function all(){
			$data = array();
			$data['date'] 			= get('date');
			$data['date_end'] 		= get('date_end');
			if(empty($data['date']) AND empty($data['date_end'])){
				$data['date'] = $data['date_end'] = $this->model('master')->getLastDateCategory(1);
			}
			$data['id_category']	= (int)get('category');
			$data['id_type']		= (int)get('type');
			$data['order']			= get('order');

			$data['category'] 	= $this->model('master')->listCategory();
			$data['type'] 		= $this->model('master')->listType();
			$data['action'] 	= route('report/all');

			$data_select = array(
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
				'id_category' 	=> $data['id_category'],
				// 'id_type' 		=> $data['id_type'],
				'order'			=> $data['order']
			);
			$data['result']		= $this->model('master')->listReportAll($data_select);
			$this->view('report/all',$data);
		}
		public function accounting(){
			$data = array();
			$data['date'] 			= get('date');
			$data['date_end'] 		= get('date_end');
			$data['id_category']	= (int)get('category');
			$data['id_type']		= (int)get('type');
			$data['order']			= get('order');

			$data['category'] 	= $this->model('master')->listCategory();
			$data['type'] 		= $this->model('master')->listType();
			$data['action'] 	= route('report/accounting');

			$data_select = array(
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
				'id_category' 	=> $data['id_category'],
				// 'id_type' 		=> $data['id_type'],
				// 'order'			=> $data['order']
			);
			$data['result']		= $this->model('master')->listReportAccounting($data_select);
			$this->view('report/accounting',$data);
		}
		public function bill(){
			$data = array();
			$data['id_type']		= (int)get('type');
			$data['number']			= get('number');
			$data['date'] 			= get('date');
			$data['date_end'] 		= get('date_end');

			$data_select = array(
				'id_type' 		=> $data['id_type'],
				'number'		=> $data['number'],
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
			);
			$data['result']		= $this->model('master')->listReportAllBill($data_select);
			$this->view('report/allBill',$data);
		}
	}
?>