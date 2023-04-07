<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_view_users extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_users'] = $this->admin_model->getUsers(); // get all users
		$this->load->view('txn_view_users', $data);
	}


	// get from user table, all wallet tables, withdrawal and deposit tables etc.
	function getUsersAllData()
	{
?>
		<table id="my-table" class="display table nowrap table-striped table-bordered " style="font-size:13px;">
			<thead class="">
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Reg. date</th>
					<th>Status</th>
					<th class="text-right">Sys-Token</th>
					<th class="text-right">Funded</th>
					<th class="text-right">Withdrawn</th>
					<th class="text-right">Earned</th>
					<th class="text-right">Pending<br>deposit</th>
					<th class="text-center">Action<br>view | edit</th>
				</tr>
				<tr>
					<td colspan="2"> <input type="checkbox" id="check-all" name="check_all" class="m-2"> &nbsp; Check all</td>
					<td colspan="6"><p class="h6 p-2">Send mails to users by checking the check-boxes below</p></td>
					<td colspan="2"><button data-toggle="modal" data-target="#send-mail-modal" class="btn btn-primary btn-sm my-2"><i class="mdi mdi-email"></i> Send Mails</button></td>
				</tr>
			</thead>
			<tbody>



				<?php
				$userData = $this->admin_model->getUsers();
				if ($userData->num_rows() > 0) {
					$sn = 0;
					foreach ($userData->result() as $row) {
						$sn++;
						$userId = $row->user_id;
						$password = $row->password;
						$fullName = $row->full_name;
						$username = $row->username;
						$status = $row->status;
						$date = $row->date;
						$email=$row->email;
						$balance = $row->total_amount;
						if ($status == "0") {
							$status_report = '<select data-set-value="' . $status . '" class="select-status" id="id-' . $userId . '" data-user-id="' . $userId . '"><option value="0">Disabled</option><option value="1">Enable</option><option value="2">Suspended</option><option value="yes">Verify email</option></select>';
						} else if ($status == "1") {
							$status_report = '<select data-set-value="' . $status . '" class="select-status" id="id-' . $userId . '" data-user-id="' . $userId . '"><option value="1">Enable</option><option value="0">Disabled</option><option value="2">Suspended</option><option value="yes">Verify email</option></select>';
						} else if ($status == "2") {
							$status_report = '<select data-set-value="' . $status . '" class="select-status" id="id-' . $userId . '" data-user-id="' . $userId . '"><option value="2">Suspended</option><option value="0">Disabled</option><option value="1">Enable</option><option value="yes">Verify email</option></select>';
						} else {
							$status_report = $status_report = '<select data-set-value="' . $status . '" class="select-status" id="id-' . $userId . '" data-user-id="' . $userId . '"><option value="4">unknown</option><option value="1">Enable</option><option value="0">Disabled</option><option value="2">Suspended</option><option value="yes">Verify email</option></select>';
						}

						// get all confirmed deposit for this user
						$d = $this->admin_model->getConfirmedDeposit($userId);
						if ($d->num_rows() > 0) {
							$total_income = $total_deposit = 0;
							foreach ($d->result() as $rowD) {
								$total_deposit = $total_deposit + $rowD->dpt_amount;
								$funded = $total_deposit;
								$total_income = $total_income + $rowD->dpt_total_income;
								$earning = $total_income;
							}
						} else {
							$funded =$earning=$total_income = $total_deposit = 0;
						}



						// get all pending|unconfirmed deposit for this user
						$pd = $this->admin_model->getUserPendingDeposit($userId);
						if ($pd->num_rows() > 0) {
							$pending_sn = $total_pending_deposit_amt = 0;
							foreach ($d->result() as $rowPd) {
								$total_pending_deposit_amt = $total_pending_deposit_amt + $rowPd->dpt_amount;
								$pending_deposit_amt = $total_pending_deposit_amt;
								$pending_sn++;
							}
						} else {
							$pending_deposit_amt = $pending_sn = $total_pending_deposit = 0;
						}


						// get all confirmed withdrawal
						$w = $this->admin_model->getConfirmedWithdrawal($userId);
						if ($w->num_rows() > 0) {
							foreach ($w->result() as $rowD) {
								$total_withdrawal = $rowD->total_withdrawal;
							}
						} else {
							$total_withdrawal = 0;
						}


						if ($balance == "") {
							$balance = 0;
						}
						if ($pending_deposit_amt == "") {
							$pending_deposit_amt = 0;
						}
						if ($earning == "") {
							$earning = 0;
						}
						if ($total_withdrawal == "") {
							$total_withdrawal = 0;
						}
						if ($funded == "") {
							$funded = 0;
						}


				?>
						<tr>
							<td>
								<?= $sn ?>
								<input type="checkbox" id="<?= $userId ?>" name="check_box" class="check-all" user_email="<?= $email ?>">
							</td>
							<td><?= $username ." <i class=' mdi mdi-arrow-bottom-right text-info '></i><br>".$fullName?></td>
							<td><?= $date ?></td>
							<td><?= $status_report ?><br><i id="change-status-response-<?= $userId ?>"></i></td>
							<td class="text-right">$<?= number_format($balance) ?>.00</td>
							<td class="text-right">$<?= number_format($funded) ?>.00</td>
							<td class="text-right">$<?= number_format($total_withdrawal) ?>.00</td>
							<td class="text-right">$<?= number_format($earning) ?>.00</td>
							<td class="text-right">$<?= number_format($pending_deposit_amt) ?>.00</td>
							<td>
								<a class="" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=profile&token_e=<?= md5(md5(rand())) ?>" target="_blank">profile</a>
								<a class="ml-2" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=make_withdrawal&token_e=<?= md5(md5(rand())) ?>" target="_blank">withdraw</a>
								<a class="ml-2" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=make_deposit&token_e=<?= md5(md5(rand())) ?>" target="_blank">fund</a>

							</td>
						</tr>
              
              <script>
$(document).ready(function(){    

		// check/uncheck all check boxes
		$('#check-all').click(function() {
			if ($(this).prop("checked") == true) {
				$('.check-all').prop('checked', true);
			} else {
				$('.check-all').prop('checked', false);
			}
		});

			
    // update user accout status
				$(".select-status").change(function() {
					var userId = $(this).attr('data-user-id');
					var status = $(this).val();
					var statusStr = 0;
					var initialValue = $(this).attr("data-set-value");
					if (status == '0') {
						statusStr = "Disable this user"
					} else if (status == '1') {
						statusStr = "Enable user"
					} else if (status == '2') {
						statusStr = "Suspend user"
					}else if (status == 'yes') {
						statusStr = "Verify email"
					} else {
						statusStr = "Unknown action"
					}

					Swal.fire({
						title: '<h5>' + statusStr + '</h5>',
						text: 'Are you sure?',
						showDenyButton: true,
						confirmButtonText: 'Yes',
						denyButtonText: 'No',
						icon: 'info'
					}).then((result) => {
						if (result.isConfirmed) {
							$("#change-status-response-" + userId).html("processing...")
							//alert(status);return;
							var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
							$.ajax({
								url: "<?php echo base_url('txn_view_users/changeUserStatus'); ?>",
								method: 'POST',
								data: {
									userId: userId,
									status: status,
									<?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
								},
								success: function(data) {
									$("#change-status-response-" + userId).html(data);
								}
							});
						} else {
							$("#id-" + userId).val(initialValue);
						}
					});

				});
				// end of update user account status
});
</script>



					<?php


					}
					?>
			</tbody>
			<tfoot>
				<?php
					if (isset($sn)) {
						echo '<tr><td colspan="10">Total members: <span class="text-primary h6">' . $sn . '</span></td></tr>';
					} ?>

			</tfoot>
		</table>
		<script>
			$(document).ready(function() {

			    $("#send-mails-now").on('click', function() {
					var user_email ="";
					var message = $("#message").val();	
					var msg_title = $("#msg_title").val();
					if(msg_title==""){
						Swal.fire('Error!','Please enter message title','error');
						return;
					}	
					if(message==""){
						Swal.fire('Error!','Please enter message','error');
						return;
					}			
					var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
					
				$("input:checkbox[name=check_box]:checked").each(function() {
					
					
					user_email = $(this).attr('user_email');
					

				// check if email is empty or not then run the cmd
				if (user_email == "") {
					
				} else {					
					// save score
					$('#processing-mail').html('Processing...');
					$.ajax({
						url: "<?php echo base_url('txn_view_users/sendMails'); ?>",
						method: 'POST',
						data: {							
							user_email:user_email,
							message:message,
							msg_title:msg_title,
							<?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
						},
						success: function(data) {
							$('#processing-mail').html(data);
						}
					});
				}
				});

				if(user_email==""){
					Swal.fire('Error!','No user selected','error');
					return;
				}
				location.reload();
			});

				$('#my-table').DataTable({
					// dom: '<"top"i>rt<"bottom"flp><"clear">',
					"pagingType": "full_numbers",
					"lengthMenu": [
						[10, 25, 50, -1],
						[10, 25, 50, "All"]
					],
					//responsive: true,
					language: {
						search: "_INPUT_",
						searchPlaceholder: "Enter search text"
					},

					scrollY: "60vh",
					//scrollX: true,

				});



				



			});
		</script>
<?php

				}
			}
			// end of get users all data function




			// change user status
			function changeUserStatus()
			{
				$userId = $this->security->xss_clean($this->input->post('userId'));
				$status = $this->security->xss_clean($this->input->post('status'));
              
              // if $status==yes verify user email	
              if($status=='yes'){
                  $response = $this->admin_model->verifyUserEmail($userId, $status);
               	 $_alert='<script>Swal.fire("Email verification success!","","success")</script>';
              }else{
                $response = $this->admin_model->changeUserStatus($userId, $status);
                $_alert='<script>Swal.fire("User status saved","","success")</script>';
              }
              
				if ($response > 0) {
					echo $_alert;
				} else {
					echo '<script>Swal.fire("Not save","may be action has already taken place","info")</script>';
				}
			}
			// end of change user status


			// change user status
			function sendMails()
			{
				$user_email = $this->security->xss_clean($this->input->post('user_email'));
				$message = $this->security->xss_clean($this->input->post('message'));
				$msgTitle = $this->security->xss_clean($this->input->post('msg_title'));
				$configEmail = $this->session->userdata('configEmail');
 				
					$to=$user_email;
					$subject = "$msgTitle";
                    $headers = "From:$configEmail\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $m = mail($to, $subject, $msg, $headers);
				
					$this->session->set_flashdata('form', '<script>Swal.fire("Mails sent successfully","","success")</script>');
						
			}
			// end of change user status

		}
