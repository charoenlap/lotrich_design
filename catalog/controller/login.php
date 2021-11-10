<?php 
    class LoginController extends Controller {
        public function index() {
            $data = array();
            $data['title'] = "LotRich";
            $data['descreption'] = "";
            $data['action'] = route('login/submit');
            $data['username'] = '';
            $id     = decrypt($this->getSession('id'));
            $email  = $this->getSession('email');
            $data['chk']  = $this->getSession('chk');
            if(!empty($id) AND !empty($email)){
                $this->redirect('member/dashboard');
            }else{
                $data['username'] = $this->getSession('email');
                $this->view('login',$data); 
            }
        }
        public function submit(){
            $result = array(
                'status' => 'failed',
                'desc' => ''
            );
            if(method_post()){
                $user   = $this->model('user');
                $email              = post('email');
                $password           = post('password');
                $this->setSession('email',$email);
                $this->setSession('chk',post('chk'));
                if( !empty($password) and !empty($email) ){
                        $arr_user = array(
                            'email'         => $email,
                            'password'      => $password,
                        );
                        $result_login = $user->login($arr_user);
                        if(!empty($result_login['id'])){
                            $this->setSession('id',encrypt($result_login['id']));
                            $this->setSession('email',$result_login['email']);
                            $this->setSession('name',$result_login['name']);
                            $this->setSession('lname',$result_login['lname']);
                            $this->setSession('phone',$result_login['phone']);
                            $this->setSession('bank_no',$result_login['bank_no']);
                            $this->setSession('bank_name',$result_login['bank_name']);
                            $result = array(
                                'status' => $result_login['status'],
                                'desc'  => $result_login['desc']
                            );
                        }else{
                            $result = array(
                                'status' => 'failed',
                                'desc' => $result_login['desc']
                            );
                        }
                    
                }else{
                    $password   = (empty($password)?'password, ':''); 
                    $email      = (empty($email)?'email, ':''); 
                    $result = array(
                        'status' => 'failed',
                        'desc' => 'Empty '.$password.$email
                    );
                }
                $this->json($result);
            }
        }
    }
?>