<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify_topup extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->library('form_validation');
        $this->load->model('model');
    }


    public function index()
    {
        $userId = $this->session->userdata('user_id');

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
                //"Authorization: Bearer sk_test_756cf0fda1e21c7eb90751c68a91c1ac109a6aa5",
                
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
            $amount = ($result->data->amount) / 100;
            $unit = (($result->data->amount) / 50) / 100;

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



            if ($amount != "" && $unit != "") {
                $newAmount = $unit * 50;
                if ($newAmount == $amount) {
    
                    // check tbl_vote_unit table if user has purchased a unit before then update it
                    $dataRequest = $this->model->checkUnit($userId);
                    if ($dataRequest->num_rows() > 0) {
                        $newUnit = 0;
                        $previousUnit = 0;
                        foreach ($dataRequest->result() as $row) {
                            $previousUnit = $row->vu_units;
                        }
                        $newUnit = $previousUnit + $unit;
    
                        $data = array(
                            'vu_units'	   => $newUnit
                        );
                        // update record
                        $dataResponse = $this->model->updateUnit($data, $userId);
                        if ($dataResponse > 0) {
                            echo "<span class=' text-success h6'>Success</span>";
                            $this->session->set_flashdata('form', "<script>Swal.fire('Unit purchased successfully','','success')</script>");
                            echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
                        } else {
                            echo "<span class=' text-danger h6'>Error! cannot update record at the moment</span>";
                            echo '<script>Swal.fire("Error", "Cannot update record at the moment", "error")</script>';
                        }
                    } else {
    
                        // insert new record
                        $data = array(
                            'vu_user_id' => $userId,
                            'vu_units'	   => $unit
                        );
                        $dataResponse = $this->model->insertUnit($data, $userId);
                        if ($dataResponse > 0) {
                            echo "<span class=' text-success h6'>Success</span>";
                            $this->session->set_flashdata('form', "<script>Swal.fire('Unit purchased successfully','','success')</script>");
                            echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
                        } else {
                            echo "<span class='text-danger h6'>Error! cannot insert record at the moment</span>";
                            echo '<script>Swal.fire("Error", "Cannot insert record at the moment", "error")</script>';
                        }
                    }
                } else {
                    echo "<span class='text-danger h6'>Amount error!</span>";
                }
            } else {
                echo "<span class='text-danger h6'>Invalid command</span>";
                echo '<script>Swal.fire("Invalid command", "", "error")</script>';
            }






        } else {
            header("Location:dashboard");
            exit;
        }


        //$this->load->view('verify_transaction');
    } //verify_transaction
}
