<?php 
// class Auth_Controller extends CI_Controller{

//     public function __construct()
//     {
//         parent::__construct();

//         $this->load->model('SigninModel');
//         $this->load->model('UserModel');
//     }


//     public function signin(){

//         $username = $this->input->post('email');
//         $useremail = $this->input->post('password');
//         $usertpe = $this->input->post('usertype');

//         if($usertpe === 'admin'){

//             $admin = $this->SigninModel->loginmodel($username,$useremail);

//             if($admin){

//                 $this->session->set_userdata('id',$admin->id);
//                 $this->session->set_userdata('user_type','admin');

//                 redirect('DashboardController');

//             }else{

//                 $this->session->set_flashdata('error','Invalid admin credentials');
//                 redirect('Signin');
//             }

//         } elseif($usertpe === 'user'){

//             $user = $this->UserModel->index($username,$useremail);

//             if($user){

//                 $this->session->set_userdata('id',$user->id);
//                 $this->session->set_userdata('user_type','user');
//                 redirect('DashboardController');
//             }else{

//                 $this->session->set_flashdata('error','Invalid user credentials');
//                 redirect('Signin');
//             }

//         } else {

//             $this->session->set_flashdata('error','Invalid user type');
//             redirect('Signin');
//         }
//     }
// }

class Auth_Controller extends CI_Controller{

    public function login(){

        $useremail = $this->input->post('email');
        $userpassword = $this->input->post('password');
        $user_type = $this->input->post('usertype');
        $user = null;

        if($user_type === 'Admin'){
            $this->load->model('SigninModel');
            $user = $this->SigninModel->loginmodel($useremail,$userpassword);
        }elseif($user_type==='User'){
            $this->load->model('UserModel');
            $user = $this->UserModel->index($useremail,$userpassword);


        }


        if($user){
            $data = array(
                'email'=>$useremail,
                'password'=>$userpassword
            );
            $this->session->set_userdata($data);
            redirect('DashboardController');
        }else{
            $data['error'] = "Invalid username or password";
            $this->load->view('Signin',$data);
            echo '<script>alert("invalid email or password")</script>';
        }
    }
}
?>
