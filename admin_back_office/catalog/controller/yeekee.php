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
            $getConfigYeekeeStartEnd = $this->model('yeekee')->getConfigYeekeeStartEnd();

            $data['start']= $getConfigYeekeeStartEnd['start'];
            $data['end']= $getConfigYeekeeStartEnd['end'];

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
        public function setConfigYeekeestart(){
            $data_update = array(
                'start' => get('start')
            );
            $this->model('yeekee')->setConfigYeekeestart($data_update);
            $json = array(
                'status' => 'success',
                'desc'  => 'ปรับเป็น '.get('start').' เรียบร้อยแล้ว'
            );
            $this->json($json);
        }
        public function setConfigYeekeeend(){
            $data_update = array(
                'end' => get('end')
            );
            $this->model('yeekee')->setConfigYeekeeend($data_update);
            $json = array(
                'status' => 'success',
                'desc'  => 'ปรับเป็น '.get('end').' เรียบร้อยแล้ว'
            );
            $this->json($json);
        }
    }
?>