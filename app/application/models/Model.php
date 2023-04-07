<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{


    // register user
    function register($data)
    {
        $this->db->insert('tbl_user', $data);
        return $this->db->insert_id();
    }

    function getRef($ref_username)
    {
        $this->db->where('username', $ref_username);
        return $this->db->get('tbl_user');
    }

  
  // email verification
  function emailVerification($data){
  	$data2=array(
    	"is_email_verified"=>'yes',
    	"email_verification"=>'',
    );
    $this->db->where($data)->update('tbl_user',$data2);
    return $this->db->affected_rows();
    
  }



    // end of retister user



    // user login
    function login($data)
    {
        $token = md5(rand());
        $this->db->set('login_token', $token)->where($data)->update('tbl_user');
        return $this->db->get_where('tbl_user', $data);
    }


    	//login check for admin
	function adminLoginQuery($data_admin)
	{
		$this->db->where($data_admin);
		return $this->db->get('tbl_admin');
	}
	//update admin login key
	function updateAdminLoginKey($adminId, $loginKey)
	{
		$this->db->set('ad_login_token', $loginKey);
		$this->db->where('ad_id', $adminId);
		$this->db->update('tbl_admin');
		return $this->db->affected_rows();
	}


    // admin login
    function adminLogin($data)
    {
        // $token = md5(rand());
        // $this->db->set('login_token', $token)->where($data)->update('tbl_user');
        return $this->db->get_where('tbl_user', $data);
    }

    // save user profile
    function saveProfile($data, $userId)
    {
        $this->db->where('user_id', $userId);
        $id = $this->db->update('tbl_user', $data);
        return  $this->db->affected_rows();
    }

    // save user password
    function savePassword($new_password, $userId)
    {
        $this->db->set('password', $new_password)->where('user_id', $userId);
        $id = $this->db->update('tbl_user');
        return  $this->db->affected_rows();
    }


    // save user profile photo
    function saveProfilePhoto($imgName, $userId)
    {
        $this->db->where('user_id', $userId);
        $this->db->update('tbl_user', $imgName);
        return $this->db->affected_rows();
    }


    // get user info
    function getUserInfo($userId)
    {
        return $this->db->where('user_id', $userId)->get('tbl_user');
    }
  
  

    // get cryptocurrency
    function getCryptocurrency()
    {
        return $this->db->get('tbl_cryptocurrency');
    }

    // get user cryptocurrency address
    function getUserCryptocurrencyAddress($userId, $tableName)
    {
        $this->db->where('cc_user_id ', $userId);
        return $this->db->get($tableName);
    }

    // check if the user exists in the currency table (eg: where $tableName=btc)
    function checkUser($tableName, $userId)
    {
        $this->db->where('cc_user_id ', $userId);
        return $this->db->get($tableName);
    }

    // insert wallet
    function insertWallet($walletAddress, $tableName, $userId, $username)
    {
        $data = array(
            'cc_user_id' => $userId,
            'cc_currency_address' => $walletAddress,
            'cc_username' => $username,

        );
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }
  
  
  // save user pin on first instance  
  function savePin($userId,$pin){
    $this->db->where('user_id',$userId)->update('tbl_user',array('txn_pin'=>$pin));
    return $this->db->affected_rows();
  }
  
  // reset pin request | update
  function updateTxnResetCode($userEmail, $userId, $resetCode){
     $this->db->where('user_id',$userId)->where('email',$userEmail)->update('tbl_user',array('txn_pin_reset_code'=>$resetCode));
    return $this->db->affected_rows();
  }

    // reset user txn pin
  function resetPin($userId, $pin, $reset_code){
     $this->db->where('user_id',$userId)->where('txn_pin_reset_code',$reset_code)->update('tbl_user',array('txn_pin'=>$pin, 'txn_pin_reset_code'=>''));
    return $this->db->affected_rows();
  }
    // save wallet
    function saveWallet($walletAddress, $tableName, $userId)
    {
        $data = array(
            'cc_currency_address' => $walletAddress,
        );
        //$this->db->set($data);
        $this->db->where('cc_user_id', $userId);
        $this->db->update($tableName, $data);
        return $this->db->affected_rows();
    }

    // get package
    function getPackage()
    {
        $this->db->order_by('pkg_min_amount', 'asc');
        return $this->db->get('tbl_package');
    }

    // get wallet name by walletid
    function getWalletName($walletId)
    {
        $this->db->where('c_id', $walletId);
        return $this->db->get('tbl_cryptocurrency');
    }

    // make deposit
    function deposit($data, $userId)
    {
        $this->db->insert('tbl_deposit', $data);
        return $this->db->insert_id();
    }

    // get user wallet address
    function getUserWalletAddress($walletTableName, $userId)
    {
        $this->db->where('cc_user_id', $userId);
        return $this->db->get($walletTableName);
    }

    // get user deposit
    function getDeposit($userId)
    {
        $this->db->order_by('dpt_id', 'asc')->where('dpt_user_id', $userId)->where_not_in('dpt_status', '3');
        return $this->db->get('tbl_deposit');
    }


    // get user pending deposit
    function getPendingDeposit($userId)
    {
        $this->db->order_by('dpt_id', 'asc')->where('dpt_user_id', $userId)->where('dpt_status', '0');
        return $this->db->get('tbl_deposit');
    }


    // get user approved deposit
    function getApprovedDeposit($userId)
    {
        $this->db->order_by('dpt_id', 'asc')->where('dpt_user_id', $userId)->where('dpt_status', '1');
        return $this->db->get('tbl_deposit');
    }

    // get user unapproved deposit
    function getUnapprovedDeposit($userId)
    {
        $this->db->order_by('dpt_id', 'asc')->where('dpt_user_id', $userId)->where('dpt_status', '2');
        return $this->db->get('tbl_deposit');
    }

    // get user settled deposit
    function getSettledDeposit($userId)
    {
        $this->db->order_by('dpt_id', 'asc')->where('dpt_user_id', $userId)->where('dpt_status', '3');
        return $this->db->get('tbl_deposit');
    }


    // get user pending withdrawal
    function getPendingWithdrawal($userId)
    {
        $this->db->where('wd_user_id', $userId)->where('wd_status', '0');
        return $this->db->get('tbl_withdrawal');
    }

    // get user settled withdrawal
    function getSettledWithdrawal($userId)
    {
        $this->db->where('wd_user_id', $userId)->where('wd_status', '1');
        return $this->db->get('tbl_withdrawal');
    }


    //cancel transaction
    function cancelTxn($txnId, $userId)
    {
        $this->db->where('dpt_id', $txnId)->where('dpt_user_id', $userId)->delete('tbl_deposit');
        return $this->db->affected_rows();
    }

    // cash out txn
    //** */
    function cashOutTxn($txnId, $userId, $data, $auto_reinvest, $dataReinvest)
    {
        $this->db->set('dpt_status', '3')->where('dpt_id', $txnId)->where('dpt_user_id', $userId)->update('tbl_deposit');
        $result = $this->db->affected_rows();
        if ($result > 0) {
            $this->db->insert('tbl_cashout', $data);
            if($auto_reinvest=="1"){
            $this->db->insert('tbl_deposit', $dataReinvest);
            }
            return $this->db->insert_id();
        }
    }

    // get crypto info
    function getCrypto($dpt_wallet_id)
    {
        $this->db->where('c_id', $dpt_wallet_id);
        return $this->db->get('tbl_cryptocurrency');
    }

    function amountUpdate($profit_or_txnAmount, $userId, $tablename)
    {
        $sql = "UPDATE $tablename SET cc_total_amount=cc_total_amount+$profit_or_txnAmount WHERE cc_user_id=$userId";
        $this->db->query($sql);
        //$this->db->set('total_amount','total_amount'+$txnAmount)->where('user_id',$userId)->update('tbl_user');
        return $this->db->affected_rows();
    }


    function amountUpdateUserTable($profit_or_txnAmount, $userId)
    {
        $sql = "UPDATE tbl_user SET total_amount=total_amount+$profit_or_txnAmount WHERE user_id=$userId";
        $this->db->query($sql);
        //$this->db->set('total_amount','total_amount'+$txnAmount)->where('user_id',$userId)->update('tbl_user');
        return $this->db->affected_rows();
    }



    //** */
    // end of cash out txn


    // withdrawal order
    //** */



    // check if the user has the requested amount
    function userBalance($userId)
    {
        $this->db->where('user_id', $userId);
        return $this->db->get('tbl_user');
    }
    // debit user
    function debitUser($userId, $newBalance)
    {
        $this->db->set('total_amount', $newBalance)->where('user_id', $userId)->update('tbl_user');
        return $this->db->affected_rows();
    }

    // check if the user has the requested amount in the crypto table
    function userBalance2($userId, $crypto_table)
    {
        $this->db->where('cc_user_id', $userId);
        return $this->db->get("$crypto_table");
    }


    // debit userwallet account
    function debitUserWallet($userId, $newBalance, $crypto_table)
    {
        $this->db->set('cc_total_amount', $newBalance)->where('cc_user_id', $userId)->update("$crypto_table");
        return $this->db->affected_rows();
    }

    // update user wallet account
    function UpdateUserWalletAmount($userId, $newAmount, $crypto_table)
    {
        $this->db->set('cc_total_amount', $newAmount)->where('cc_user_id', $userId)->update("$crypto_table");
        return $this->db->affected_rows();
    }


    //increase userwallet account
    function increaseUserWalletAmount($userId, $newAmount, $crypto_table){
        $sql = "UPDATE $crypto_table SET cc_total_amount=cc_total_amount+$newAmount WHERE cc_user_id=$userId";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // place withdrawal
    function withdraw($data, $userId)
    {
        $this->db->insert('tbl_withdrawal', $data);
        return $this->db->insert_id();
    }


    //** */
    // end of withdrawal order


    // get user withdrawal order
    function getWithdrawal($userId)
    {
        $this->db->order_by('wd_id', 'asc')->where('wd_user_id', $userId)->where_not_in('wd_status', '1');
        return $this->db->get('tbl_withdrawal');
    }

        // get user successful withdrawals
        function getSuccessfulWithdrawal($userId)
        {
            $this->db->order_by('wd_id', 'asc')->where('wd_user_id', $userId)->where('wd_status', '1');
            return $this->db->get('tbl_withdrawal');
        }


    // get referral
    function getReferral($userId)
    {
        $this->db->where('ref_id', $userId);
        return $this->db->get('tbl_user');
    }

    // get ref report
    function getRefReport($userId)
    {
        $this->db->where('rr_user_id', $userId);
        return $this->db->get('tbl_ref_report');
    }

    // get penalty
    function getPenalty($userId){
       // $this->db->where('pen_status','0')->or_where('pen_status','1')->where('pen_user_id',$userId)->order_by('pen_id','asc')->limit('1');
       $this->db->where('pen_status','0')->where('pen_user_id',$userId)->or_where('pen_status','1')->where('pen_user_id',$userId)->order_by('pen_id','asc')->limit('1');
		return $this->db->get('tbl_penalty');
    }

    // pay penalty
    function payPenalty($pen_id,$company_wallet_address,$user_wallet_address,$userId, $wallet_name, $wallet_id){
        $data=array(
            'pen_user_wallet_address'=>$user_wallet_address,
            'pen_company_wallet_address'=>$company_wallet_address,
            'pen_wallet_name'=>$wallet_name,
            'pen_wallet_id'=>$wallet_id,
            'pen_status'=>'1',
        );
        $this->db->where('pen_user_id',$userId)->where('pen_id',$pen_id)->update('tbl_penalty',$data);
		return $this->db->affected_rows();
    }
  
  
    // password  reset cmds 
  
  function checkAdminLink($link, $email){    
    $this->db->where('ad_password_reset_link',$link)->where('ad_email',$email);
	return $this->db->get('tbl_admin');
  }
  
  function checkMemberLink($link, $email){    
    $this->db->where('password_reset',$link)->where('email',$email);
	return $this->db->get('tbl_user');
  }
  
    function resetAdmin($email,$rand_no){
        $this->db->set('ad_password_reset_link',$rand_no)->where('ad_email',$email)->update('tbl_admin');
        return $this->db->affected_rows();
    }

    function resetMember($email,$rand_no){
        $this->db->set('password_reset',$rand_no)->where('email',$email)->update('tbl_user');
        return $this->db->affected_rows();
    }

    function save_admin_password($data,$new_password){
        $this->db->set('ad_password',$new_password)->set('ad_password_reset_link','')->where($data)->update('tbl_admin');
        return $this->db->affected_rows();
    }

    function save_user_password($data,$new_password){
        $this->db->set('password',$new_password)->set('password_reset','')->where($data)->update('tbl_user');
        return $this->db->affected_rows();
    }

  // end of password reset cmds
}
