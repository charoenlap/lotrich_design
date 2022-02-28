<?php 
    class YeekeeController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            // $data['descreption'] = "";
            // $this->view('contact',$data); 
            $result_round = $this->model('master')->getRoundShow();
            $data['round'] = $result_round;
            $data['id'] = get('id');
            
            $this->view('yeekee/home',$data);
        }
        public function result() {
            $data = array();
            $arr = array();
            if(method_get()){
                // $date_lasted = $this->model('master')->getDateLastedResult();
                $data['date'] = (get('date')?get('date'):date('Y-m-d'));
                $arr = array(
                    'date' => $data['date']
                );
            }

            $data['action'] = route('yeekee/result&date='.$data['date']);
            // $data['descreption'] = "";
            // $this->view('contact',$data); 
            // $result_round = $this->model('master')->getRoundShow();
            // $data['round'] = $result_round;
            $id = decrypt(get('id'));

            $data['yeekee'] = $this->model('master')->getResultYeekee($id);
            $this->view('yeekee/result',$data);
        }
    }
?>