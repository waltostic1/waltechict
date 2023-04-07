<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	public function index()
	{
	}

	function getSystemAdmin()
	{
		return $this->db->get('tbl_admin');
	}

  	function getConfig()
	{
		$_result_ = $this->db->get('tbl_configuration');
      	if($_result_->num_rows()>0){
          return $_result_;
        }else{
          // insert recored
          $this->db->insert('tbl_configuration',array('config_email'=>'example@gmail.com', 'config_auto_reinvest'=>'0'));
          echo '<script>window.open("' . base_url('txn_app_configuration') . '","_self")</script>';
        }
	}
  function saveConfigEmail($configEmail, $configId, $reinvest)
  {
  $this->db->where('config_id',$configId)->update('tbl_configuration', array('config_email'=>$configEmail, 'config_auto_reinvest'=>$reinvest));
    return $this->db->affected_rows();
    
  }
  
  
	function insert($data)
	{
		$this->db->insert('tbl_admin', $data);
		return $this->db->insert_id();
	}

	//login check
	function loginQuery($data)
	{
		$this->db->where($data);
		return $this->db->get('tbl_admin');
	}

	//update admin login key
	function updateLoginKey($adminId, $loginKey)
	{
		$this->db->set('ad_login_token', $loginKey);
		$this->db->where('ad_id', $adminId);
		$this->db->update('tbl_admin');
		return $this->db->affected_rows();
	}


	// add package
	function addPkg($data)
	{
		$this->db->insert('tbl_package', $data);
		return $this->db->insert_id();
	}

	// get packages
	function getPackage()
	{
		$this->db->where_not_in('pkg_status','deleted')->order_by('pkg_id');
		return $this->db->get('tbl_package');
	}
  
  
  	// get deleted packages
	function getDeletedPackage()
	{
		$this->db->where('pkg_status','deleted')->order_by('pkg_id');
		return $this->db->get('tbl_package');
	}

	// save package
	function savePkg($data, $packageId)
	{
		//$this->db->set($data);
		$this->db->where('pkg_id', $packageId);
		$this->db->update('tbl_package', $data);
		return $this->db->affected_rows();
	}

	// delete package by changing the status to deleted
	function deletePkg($packageId)
	{
		$this->db->where('pkg_id', $packageId);
		$del = $this->db->update('tbl_package',array('pkg_status'=>'deleted'));
		return $this->db->affected_rows();
	}
  
  	// restore deleted package by changing the status to active
	function restoreDeletedPkg($packageId)
	{
		$this->db->where('pkg_id', $packageId);
		$del = $this->db->update('tbl_package',array('pkg_status'=>'inactive'));
		return $this->db->affected_rows();
	}

	// add cryptocurrency
	function addCryptocurrency($data, $cryptocurrencyTable)
	{
		$this->db->insert('tbl_cryptocurrency', $data);

		if ($this->db->insert_id() > 0) {

			// create cryptocurrency table
			$sql = "CREATE TABLE IF NOT EXISTS $cryptocurrencyTable(
				cc_id INT NOT NULL AUTO_INCREMENT,
				cc_user_id VARCHAR(11) NOT NULL COMMENT 'userid from user tbl',
				cc_currency_address VARCHAR(255) NOT NULL,
				cc_username VARCHAR(100) NOT NULL COMMENT 'username from user table',
				cc_total_amount VARCHAR(20) NOT NULL DEFAULT '0',				
				cc_date TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY(cc_id)
				) ENGINE = INNODB;";


			if (!$this->db->query($sql)) {
				$this->session->set_flashdata('form', '<script>Swal.fire("Error","Cryptocurrency created with error-0","error")</script>');
				$this->db->where('c_name', $cryptocurrencyTable);
				$this->db->delete('tbl_cryptocurrency');
				return 0;
			} else {
				return 1;
			}
		}
	}

	function getCryptocurrency()
	{
		$this->db->order_by('c_name', 'asc');
		return $this->db->get('tbl_cryptocurrency');
	}

	function deleteCrypto($cryptocurrencyId, $cryptocurrencyTable)
	{
		$this->db->where('c_id', $cryptocurrencyId);
		$del = $this->db->delete('tbl_cryptocurrency');
		if ($del) {
			$sql = "DROP table IF EXISTS $cryptocurrencyTable ";
			$dropQuery = $this->db->query($sql);
			if ($dropQuery) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}


	// save wallet address
	function saveWallet($walletAddress, $cryptoId, $adminId)
	{
		$data = array(
			'c_admin_wallet_address' => $walletAddress,
		);
		//$this->db->set($data);
		$this->db->where('c_id', $cryptoId)->where('c_creator_id', $adminId);
		$this->db->update('tbl_cryptocurrency', $data);
		return $this->db->affected_rows();
	}



	// get ref bonus and admin bonus
	function getRefBonus()
	{
		return $this->db->get('tbl_ref_report');
	}
	// get total | all deposit
	function getAllDeposit()
	{
		return $this->db->get('tbl_deposit');
	}

	// get pending deposit
	function getPendingDeposit()
	{
		$this->db->where('dpt_status', '0')->order_by('dpt_id', 'asc');
		return $this->db->get('tbl_deposit');
	}


	// get successful deposit
	function getSuccessfulDeposit()
	{
		$this->db->where('dpt_status', '1')->order_by('dpt_id', 'asc');
		return $this->db->get('tbl_deposit');
	}

	// get queried deposit
	function getQueriedDeposit()
	{
		$this->db->where('dpt_status', '2')->order_by('dpt_id', 'asc');
		return $this->db->get('tbl_deposit');
	}

	// get deleted deposit
	function getDeletedDeposit()
	{
		$this->db->where('dpt_status', '4')->order_by('dpt_id', 'asc');
		return $this->db->get('tbl_deposit');
	}


	// approve txn
	function approveTxn($txnId, $txnSenderId)
	{
		// update user table 
		$this->db->set('have_made_deposit', '1')->where('user_id', $txnSenderId)->update('tbl_user');
		$this->db->set('dpt_status', '1')->where('dpt_id', $txnId)->where('dpt_user_id', $txnSenderId)->update('tbl_deposit');
		return $this->db->affected_rows();
	}

	//get crypto table name from cryptocurrency table
	function getCryptoTable($cryptoId)
	{
		$this->db->where('c_id', $cryptoId);
		return $this->db->get('tbl_cryptocurrency');
	}

	// disapprove|query txn
	function queryTxn($txnId, $txnSenderId)
	{
		$this->db->set('dpt_status', '2')->where('dpt_id', $txnId)->where('dpt_user_id', $txnSenderId)->update('tbl_deposit');
		return $this->db->affected_rows();
	}


	// delete txn 
	// status=4 means deleted txn. note: txn will still exist in the database
	function deleteTxn($txnId, $txnSenderId)
	{
		$this->db->set('dpt_status', '4')->where('dpt_id', $txnId)->where('dpt_user_id', $txnSenderId)->update('tbl_deposit');
		return $this->db->affected_rows();
	}


	//finalDelete will remove the txn from the database leaving no trace.
	function finalDelete($txnId, $txnSenderId)
	{
		$this->db->where('dpt_id', $txnId)->where('dpt_user_id', $txnSenderId)->delete('tbl_deposit');
		return $this->db->affected_rows();
	}


	// get disapproved txn
	function getDisapprovedDeposit()
	{
		$this->db->where('dpt_status', '2')->order_by('dpt_id', 'asc');
		return $this->db->get('tbl_deposit');
	}


	// get pending withdrawal
	function getPendingWithdrawal()
	{
		$this->db->where('wd_status', '0')->order_by('wd_id', 'asc');
		return $this->db->get('tbl_withdrawal');
	}

	// get total withdrawal
	function getAllWithdrawal()
	{
		return $this->db->get('tbl_withdrawal');
	}

	// get successful withdrawal
	function getSuccessfulWithdrawal()
	{
		$this->db->where('wd_status', '1')->order_by('wd_id', 'asc');
		return $this->db->get('tbl_withdrawal');
	}

	// settle txn
	function settleTxn($txnId, $trackingId)
	{
		$data = array(
			'wd_tracking_id' => $trackingId,
			'wd_status' => '1',
		);
		$this->db->set($data)->where('wd_id', $txnId)->update('tbl_withdrawal');
		return $this->db->affected_rows();
	}


	// get depositor data
	function getDepositor($userId)
	{
		$this->db->where('user_id', $userId);
		return $this->db->get('tbl_user');
	}

	// get ref data
	function getRef($refId)
	{
		$this->db->where('user_id', $refId);
		return $this->db->get('tbl_user');
	}

	// credit ref
	function creditRef($refId, $finalBalance)
	{
		$this->db->set('total_amount', $finalBalance)->where('user_id', $refId)->update('tbl_user');
		return $this->db->affected_rows();
	}

	// update the tbl_ref_report
	function sendRefReport($data)
	{
		$this->db->insert('tbl_ref_report', $data);
		return $this->db->insert_id();
	}

	// get all users
	function getUsers()
	{
		return $this->db->get('tbl_user');
	}

	// get all active users
	function getActiveUsers()
	{
		$this->db->where('status', '1');
		return $this->db->get('tbl_user');
	}

	// get all inactive users
	function getInactiveUsers()
	{
		//$this->db->where_not_in('status', '1');
		$this->db->where('status', '0');
		return $this->db->get('tbl_user');
	}

	// get all suspended users
	function getSuspendedUsers()
	{
		$this->db->where('status', '2');
		return $this->db->get('tbl_user');
	}





	// get users all data
	//** */

	// get confirmed deposit
	function getConfirmedDeposit($userId)
	{
		$this->db->where('dpt_user_id', $userId)->where('dpt_status', '1');
		return $this->db->get('tbl_deposit');
	}


	// get get user's Pending Deposit($userId)
	function getUserPendingDeposit($userId)
	{
		$this->db->where('dpt_user_id', $userId)->where('dpt_status', '0');
		return $this->db->get('tbl_deposit');
	}


	// get confirmed withdrawal
	function getConfirmedWithdrawal($userId)
	{
		$sql = "SELECT SUM(wd_amount)as total_withdrawal FROM tbl_withdrawal WHERE wd_user_id ='$userId' ";
		return $this->db->query($sql);
	}



	//** */
	// end of get users all data


	// change user status enable, disabled, suspended
	function changeUserStatus($userId, $status)
	{
		$this->db->set('status', $status)->where('user_id', $userId)->update('tbl_user');
		return $this->db->affected_rows();
	}
  
  // verify user email
  function verifyUserEmail($userId, $status){
    $this->db->set('is_email_verified', $status)->where('user_id', $userId)->update('tbl_user');
		return $this->db->affected_rows();
  }
  
  
  function changeCrypoStatus($cryptoId, $status){
   $this->db->set('c_status', $status)->where('c_id', $cryptoId)->update('tbl_cryptocurrency');
		return $this->db->affected_rows(); 
  }

	// get users data by username
	function getUserData($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('tbl_user');
	}

	// get get all users with ref bonus
	function getAllRefWithBonus()
	{
		$sql = "SELECT tbl_user.full_name, sum(tbl_ref_report.rr_bonus) as total_bonus, tbl_user.username FROM tbl_ref_report LEFT JOIN tbl_user on tbl_ref_report.rr_user_id=tbl_user.user_id GROUP BY username ORDER by SUM(tbl_ref_report.rr_bonus) desc;";
		return	$this->db->query($sql);
	}

	// get all users with ref bonus without grouping
	function getAllRefWithBonus2()
	{
		$sql = "SELECT tbl_ref_report.*, tbl_user.full_name, tbl_user.username FROM tbl_ref_report LEFT JOIN tbl_user ON tbl_ref_report.rr_user_id = tbl_user.user_id; ";
		return	$this->db->query($sql);
	}



	// add bonus to a user
	function shareBonusToUser($username, $totalBonus, $userId, $amount)
	{
		$this->db->set('total_amount', $totalBonus)->where('username', $username)->update('tbl_user');

		$data = array(
			'rr_user_id' => $userId,
			'rr_downline_username' => "sys_admin",
			'rr_bonus' => $amount,
			'rr_comment' => 'free bonus from admin',
		);
		$this->db->insert('tbl_ref_report', $data);
		return $this->db->insert_id();
	}

	// get users that have made deposit not 1=yes have made deposit; 0=no have not made deposit
	function getUsersHaveDeposit()
	{
		$this->db->where('have_made_deposit', '1');
		return $this->db->get('tbl_user');
	}

	// get users that have made deposit not 1=yes have made deposit; 0=no have not made deposit
	function getUsersHaveNoDeposit()
	{
		$this->db->where('have_made_deposit', '0');
		return $this->db->get('tbl_user');
	}


	//** */
	// get account balance info


	// get deposit with 24hrs, 7day, 30days, 1 year, total; all passed to $day variable
	function getTotalDeposit($crypto_id, $day)
	{
		$sql = "SELECT SUM(dpt_amount) as inAmt FROM tbl_deposit WHERE dpt_date >= DATE_SUB(NOW(), INTERVAL $day DAY) AND dpt_wallet_id=$crypto_id;";
		return $this->db->query($sql);
	}

	// get withdrawn with 24hrs, 7day, 30days, 1 year, total; all passed to $day variable
	function getTotalWithdrawal($crypto_id, $day)
	{
		$sql = "SELECT SUM(wd_amount) as outAmt FROM tbl_withdrawal WHERE wd_date >= DATE_SUB(NOW(), INTERVAL $day DAY) AND wd_user_wallet_id=$crypto_id;";
		return $this->db->query($sql);
	}

	// get all total deposit
	function getAllTotalDeposit($crypto_id)
	{
		$sql = "SELECT SUM(dpt_amount) as inAmt FROM tbl_deposit WHERE dpt_wallet_id=$crypto_id;";
		return $this->db->query($sql);
	}


	// get all total withdrawal
	function getAllTotalWithdrawal($crypto_id)
	{
		$sql = "SELECT SUM(wd_amount) as outAmt FROM tbl_withdrawal WHERE wd_user_wallet_id=$crypto_id;";
		return $this->db->query($sql);
	}
	//** */

	// check if the user has a pending penalty 
	function checkPenalty($username){
		//$this->db->where('pen_status','0')->or_where('pen_status','1')->where('pen_username',$username);
      $this->db->where('pen_status','0')->where('pen_username',$username)->or_where('pen_status','1')->where('pen_username',$username);
		return $this->db->get('tbl_penalty');
	}

	// penalize user
	function penalize($username, $userId, $amount, $comment){
		$data=array(
			'pen_user_id'=>$userId,
			'pen_username'=>$username,
			'pen_amount'=>$amount,
			'pen_comment'=>$comment,
		);
		$this->db->insert('tbl_penalty',$data);
		return $this->db->insert_id();
	}

	// get all created penalties by the admin
	function getCreatedPenalty(){
		$this->db->where('pen_status','0');
		return $this->db->get('tbl_penalty');
	}

	// get pending penalty
	function getPendingPenalty(){
		$this->db->where('pen_status','1');
		return $this->db->get('tbl_penalty');
	}

	// resolve penalty issue
	function resolvePenalty($txnId,$UserId){
		$this->db->set('pen_status','2')->where('pen_user_id',$UserId)->where('pen_id',$txnId)->update('tbl_penalty');
		return $this->db->affected_rows();
	}


	// get all resolved | paid penalties
	function getPaidPenalty(){
		$this->db->where('pen_status','2');
		return $this->db->get('tbl_penalty');
	}

	// delete penalty
	function deletePenalty($txnId,$UserId){
		$this->db->set('pen_status','3')->where('pen_user_id',$UserId)->where('pen_id',$txnId)->update('tbl_penalty');
		return $this->db->affected_rows();
	}

	// get deleted penalty
	function getDeletedPenalty(){
		$this->db->where('pen_status','3');
		return $this->db->get('tbl_penalty');
	}

	// get withdrawal order of a specific txn
	function getTxnWithdrawal($txnId){
		$this->db->where('wd_id', $txnId);
		return $this->db->get('tbl_withdrawal');
	}

	// get user data by user id
	function getUserById($wd_user_id){
		$this->db->where('user_id', $wd_user_id);
		return $this->db->get('tbl_user');
	}
}
