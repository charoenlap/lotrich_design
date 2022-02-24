<?php 
    class YeekeeController extends Controller {
        public function index() {
            $data = array();
            // if(method_post()){
            // }
            $data['title'] = "LotRich";
            // $data['descreption'] = "";
            $data['date'] 		= (get('date')?get('date'):date('Y-m-d'));
            $select_date = array(
                'date' => $data['date']
            );
            $data['round'] = $this->model('yeekee')->getResult($select_date);
            $data['getConfigYeekeePercent'] = $this->model('yeekee')->getConfigYeekeePercent();
            $data['action'] = route('yeekee');
            $this->view('yeekee/home',$data); 
        }
        public function setConfigYeekeePercent(){
            $data_update = array(
                'percent' => (int)get('percent')
            );
            $this->model('yeekee')->setConfigYeekeePercent($data_update);
            $json = array(
                'status' => 'success',
                'desc'  => 'ปรับเป็น '.(int)get('percent').'% เรียบร้อยแล้ว'
            );
            $this->json($json);
        }
    }
?>