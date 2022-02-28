<?php  
	class ReportController extends Controller{
		public function number(){
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
				'id_type' 		=> $data['id_type'],
				'order'			=> $data['order']
			);
			$data['result']		= $this->model('master')->listReportAll($data_select);
			$data['resultALL']		= $this->model('master')->listResultReportAll($data_select);
			$this->view('report/all',$data);
		}
		public function accounting(){
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
			$data['action'] 	= route('report/accounting');

			$data_select = array(
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
				'id_category' 	=> $data['id_category'],
			);
			$data['result']		= $this->model('master')->listReportAccounting($data_select);
			if($data['id_category']==24){
				$data['yeekee'] = $yeekee = $this->model('yeekee')->getRound();
				// $i=0;
				foreach($yeekee['yeekee'] as $val){
					$hour = $val['hour'];
					$selectedTime = $val['hour'].':'.$val['min'].':00';
					$endTime = strtotime("-15 minutes", strtotime($selectedTime));
					$time = date('H:i:s', $endTime);
					$data_select = array(
						'date' 			=> $data['date'].' '.$time,
						'date_end' 		=> $data['date_end'].' '.$val['hour'].':'.$val['min'].':00',
						'id_category' 	=> $data['id_category'],
					);
					// echo '<pre>';
					// var_dump($data_select);
					$data['yeekee_result'][$val['code']]		= $this->model('master')->listReportAccountingYeekee($data_select);
					// if($i==5){
					// 	break;
					// }
					// $i++;
				}
			}
			$this->view('report/accounting',$data);
		}
		public function bill(){
			$data = array();
			$data['id_type']		= (int)get('type');
			$data['number']			= get('number');
			$data['date'] 			= get('date');
			$data['date_end'] 		= get('date_end');
			$data['id_category'] 	= (int)get('id_category');


			$data_select = array(
				'id_type' 		=> $data['id_type'],
				'number'		=> $data['number'],
				'date' 			=> $data['date'],
				'date_end' 		=> $data['date_end'],
				'id_category' 	=> $data['id_category'],
			);
			$data['result']		= $this->model('master')->listReportAllBill($data_select);

			$this->view('report/allBill',$data);
		}
	}
?>