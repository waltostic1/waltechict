<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify_transaction extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->library('form_validation');
        $this->load->model('model');
    }


    public function index()
    {
        $ref = $_GET['reference'];

        if ($ref == "") {
            header("Location:javascript://history.go(-1)");
        }

        $curl = curl_init();


        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_live_e3e0c3ff66b576a5f1bc8609326116639f48deda",
                "Cache-Control: no-cache",
            ),

        ));



        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {

            echo "cURL Error #:" . $err;
        } else {

            //echo $response; success status
            $result = json_decode($response);
        }
        if ($result->data->status == 'success') {
            $status = $result->data->status;
            $reference = $result->data->reference;
            $_no_vote = (($result->data->amount) / 50) / 100;

            $lname = $result->data->customer->last_name;
            $fname = $result->data->customer->first_name;
            //$fullname = $lname . ' ss ' . $fname;
            $sender_email = $result->data->customer->email;
            date_default_timezone_set('Africa/Lagos');
            $Date_time = date('m/d/Y h:i:s a', time());

            // get contestant id and group
            $_contestant_id = $this->session->userdata('_contestant_id_');
            $_group_name = $this->session->userdata('_group_name_');
            $conUsername = $this->session->userdata('_contestant_username_');

            // set votes to contestant
            $updateCon = $this->model->updateContestant($_contestant_id, $_group_name, $_no_vote);

            // create transactions history
            $updateTxn = $this->model->gateway_updateTxn($_no_vote, $_contestant_id, $_group_name,$sender_email,$reference);

            if ($updateCon > 0 && $updateTxn > 0) {
                
                // set the following sessions to ''
                $this->session->set_userdata('_contestant_username_', '');
                $this->session->set_userdata('_contestant_id_', '');
                $this->session->set_userdata('_group_name_', '');

                $this->session->set_flashdata('form', "<script>Swal.fire('Thanks for voting.','You can still vote again.', 'success')</script>");
                echo '<script>window.open("' . base_url('login') . '","_self")</script>';
            } else {
                echo 'There was a problem on your code'; //. $updateCon->error_get_last;
                exit;
            }
        } else {
             $this->session->set_flashdata('form', "<script>Swal.fire('Error!.','', 'error')</script>");
                echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
            exit;
        }


        //$this->load->view('verify_transaction');
    } //verify_transaction
  
  
  
  
      // insert data into success payment table once payment is complete before redirection
    function insert_data()
    {
        $txn_reference = $this->input->post('txn_reference');
        $sent_amount = ($this->input->post('sent_amount')/100);
        $sender_email = $this->input->post('sender_email');
        $_contestant_id = $this->session->userdata('_contestant_id_');
        $_group_name = $this->session->userdata('_group_name_');

        date_default_timezone_set('Africa/Lagos');
        $Date_time = date('m/d/Y h:i:s a', time());
        if ($txn_reference == "") {
            echo "<script>Swal.fire('Your vote was not successfull.','You can still try again.', 'error')</script>";
        } else {
            // insert the following data into the success_payment table
            $data = array(
                'sp_sender_email' => $sender_email,
                'sp_amount' => $sent_amount,
                'sp_ref' => $txn_reference,
                'sp_contestant_id' => $_contestant_id,
                'sp_date' => $Date_time,
                'sp_group' => $_group_name,
            );
            $insertD = $this->model->insertSuccessPay($data);
            if ($insertD > 0) {
                echo "<script>Swal.fire('Your payment was successfull.','', 'success')</script>";
               
            } else {
                echo "<script>Swal.fire('Your vote was not successfull.','You can still try again.', 'error')</script>";
            }
        }
    }
  
  
}
