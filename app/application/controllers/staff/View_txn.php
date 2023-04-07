<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_txn extends CI_Controller {
	public function __Construct(){
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('staff/model');
		

	}

	
	public function index()
	{
		
		$data['fetch_user_txn']=$this->model->getUserTxn();
		$data['fetch_user_txn_total_sales_by_day']=$this->model->getUserTxnTotalSalesByDay();
		$data['fetch_user_txn_total_expenses_by_day']=$this->model->getUserTxnTotalExpensesByDay();
		$this->load->view('staff/view_txn',$data);
	}


	
}