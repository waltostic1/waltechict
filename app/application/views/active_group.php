<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php"); ?>
<script>
    /* $(document).ready(function() {
    Swal.fire('Yes', 'no', 'info', 'icon');
  }); */
</script>

<body>

    <!-- check membership type -->

    <?php
    $membershipType = '';
    if ($check_membership_type->num_rows() > 0) {
        $membershipType = 'admin';
        // set a session for the admin
        $this->session->set_userdata('membership_type', 'admin');
    } else {
        $this->session->set_userdata('membership_type', '');
    }
    ?>
    <!-- end of check membership type -->


    <!-- check contestant status -->

    <?php
    $contestantStatus = '';
    $contestantVotePoints = '';
    if ($check_contestant_status->num_rows() > 0) {
        $contestantStatus = 'confirmed';
    }
    ?>
    <!-- end of check contestant status -->

    <?php

    // get number of contestant request
    if ($contestant_request->num_rows() > 0) {
        $num_of_request = 0;
        foreach ($contestant_request->result() as $row) {
            $num_of_request++;
        }
        echo  $this->session->set_userdata('pending_request', $num_of_request, ' unapproved request');
    } else {
        $this->session->set_userdata('pending_request', 'Not available');
    }
    ?>

    <div class="container-scroller">

        <!-- sidebar -->
        <?php $this->load->view("sidebar.php"); ?>
        <!-- end of sidebar -->

        <div class="container-fluid page-body-wrapper">

            <!-- navbar -->
            <?php $this->load->view("navbar") ?>
            <!-- end of navbar -->

            <div class="main-panel">
                <div class="content-wrapper">

                    <style>
                        .row {

                            margin-right: 0rem;
                            margin-left: 0rem;
                            padding-right: 0rem;
                            padding-left: 0rem;
                        }

                        .content-wrapper {
                            padding: 0rem 0rem;
                            padding-top: 12px;
                        }
                    </style>

                    <?php

                    // get number of contestant request
                    if ($contestant_request->num_rows() > 0) {
                        $num_of_request = 0;
                        foreach ($contestant_request->result() as $row) {
                            $num_of_request++;
                        }
                        echo  $this->session->set_userdata('pending_request', $num_of_request);
                    } else {
                        $this->session->set_userdata('pending_request', '0');
                    }

                    if ($fetch_group_data->num_rows() > 0) {
                        foreach ($fetch_group_data->result() as $row) {
                            $groupId = $row->gl_id;
                            $groupLogo = $row->gl_logo;
                            $groupName = $row->gl_group_name;
                            $formatedGroupName = strtoupper(str_replace('_', ' ', $row->gl_group_name));
                            $groupCreatorId = $row->gl_creator_id;
                            $groupDescription = $row->gl_description;
                            $puplishPoint = $row->gl_publish_point;
                            $groupLink = $row->gl_link;
                            $dateCreated = $row->gl_date;
                            // set session for group name so we can use it to get data from the groups name table
                            $this->session->set_userdata('group_table', $groupName);
                        }
                    }
                    ?>


                    <div class=" container m-3">
                       	<a href="<?php echo base_url('groups')?>" class=" btn btn-sm btn-primary mdi mdi-step-backward text-light mdi-18px"></a>
                        <button class="btn btn-primary btn-sm mdi mdi-account-group mdi-18px" id="show-group-info"> <u>Group info</u><i class="mdi mdi-menu-down "></i></button>
                        <button class="btn btn-primary btn-sm mdi mdi-account mdi-18px" id="show-my-info"> <u>My info</u><i class="mdi mdi-menu-down "></i></button>
                      <a class="btn btn-primary btn-sm mdi mdi-trophy" href="<?php echo base_url('my_voters')?>"> <u>My voters</u></a>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $("#my-info").hide();
                            $("#group-info").hide();
                            $("#show-my-info").click(function() {
                                $("#my-info").toggle();
                                $("#group-info").hide();
                            });
                            $("#show-group-info").click(function() {
                                $("#group-info").toggle();
                                $("#my-info").hide();
                            });


                        });
                    </script>

                    <div class="card mb-3 mx-3">
                        <div class="card-body p-3 text-center" id="group-info">
                            <a data-toggle="modal" class=" btn p-0 " data-target="#change-profile-photo-modal">
                                <div class="row">

                                    <div class=" container d-flex align-items-center align-self-start ">
                                        <img src="img/group_photo/<?php echo $groupLogo ?>" alt="" class="rounded-circle profile-pic" width="50" height="50">
                                        <p class="mb-0 text-light d-flex col-lg-9 mr-lg-3"><?php echo $formatedGroupName . '<br>' . $groupDescription ?></p>

                                    </div>

                                </div>
                            </a>
                            <?php if ($membershipType == 'admin') { ?>
                                <div class="container p-0 bg-gray-dark">
                                    <div class="row">
                                        <div class="col-12 col-lg-2  text-left text-lg-right">
                                            <i style="font-size: 12px !important;">Group link:</i>
                                        </div>
                                        <div class="col-12 col-lg-10 p-0 ">
                                            <div class="row">
                                                <div class="col-12 col-lg-10 p-0 m-0">
                                                    <textarea id="g-link" rows="2" readonly class="form-control" style="font-size: 12px !important;"><?php echo base_url('groups?g_id=' . $groupId . '&g_n=' . $groupName) ?></textarea>
                                                </div>
                                                <div class="col-12 col-lg-2  text-left">
                                                    <button class="btn-sm btn btn-primary" id="btn-copy-g-link" style="font-size: 12px !important;">
                                                        <i class=" btn mdi mdi-content-copy p-0 m-0  " style="font-size: 12px !important;">copy</i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#btn-copy-g-link, #g-link").click(function() {
                                        var copyText = $("#g-link").val();
                                        $("#g-link").select();
                                        document.execCommand('copy');
                                        Swal.fire('Group link copied', copyText, 'success');
                                    });
                                </script>
                            <?php } ?>

                        </div>

                    </div>

                    <!--  display member contestant details if the member is a contestant -->
                    <?php if ($contestantStatus == 'confirmed') {

                    ?>
                        <div class="container mb-3  p-3" id="my-info">
                            <h5 id="show-your-info" class=" "><u>My info</u></h5>
                            <div class="row bg-gray-dark p-3 ">
                                <?php
                                $membershipId = "";
                                $_votePoint = "";
                                if ($fetch_members_data->num_rows() > 0) {

                                    foreach ($fetch_members_data->result() as $row) {
                                        $membershipId = $row->g_user_id;
                                        $_votePoint = $row->g_vote_point;
                                    }
                                }

                                ?>
                                <div class=" col-12  p-1 text-lowercase" style="font-size: 12px;">

                                    <?php

                                    echo $this->session->userdata('user_username');
                                    echo ' (' . $this->session->userdata('user_first_name') . ' ';
                                    echo $this->session->userdata('user_last_name') . ' ';
                                    echo $this->session->userdata('user_phone') . ')' ?>
                                </div>
                                <div class="col-12 text-left ">
                                    <span style="font-size: 12px !important;">Your contestant Link: <small>copy and share this link</small></span>
                                </div>
                                <div class="col-12  p-0 ">
                                    <div class="row">
                                        <div class="col-12 col-lg-10 p-0 m-0">
                                            <textarea id="contest-link" rows="3" readonly class="col-12" style="font-size: 12px !important;"><?php echo base_url('contestant_link_processor?m_id=' . $membershipId) . '&g_name=' . $groupName ?></textarea>
                                        </div>
                                        <div class="col-12 col-lg-2  text-left">
                                            <button class="btn-sm btn btn-primary" id="btn-copy-contest-link" style="font-size: 12px !important;">
                                                <i class=" btn mdi mdi-content-copy p-0 m-0  " style="font-size: 12px !important;">copy</i>
                                            </button>

                                        </div>
                                        <div class=" col-12 p-3">
                                            <span style="font-size:12px"> No of votes:</span> <button class="btn btn-success"><?php echo $_votePoint ?></button>
                                        </div>
                                    </div>

                                </div>
                                <script>
                                    $("#btn-copy-contest-link, #contest-link").click(function() {
                                        var copyText = $("#contest-link").val();
                                        $("#contest-link").select();
                                        document.execCommand('copy');
                                        Swal.fire('Contestant link copied', copyText, 'success');
                                    });
                                </script>


                            </div>
                        </div>

                    <?php

                    } ?>

                    <div class="container mb-3">
                        <div class="row">
                            <!-- display publish/hide vote points if member is admin  -->
                            <!-- $puplishPoint -->
                            <?php
                            if ($membershipType == 'admin') {
                              echo '<a href="group_notification" class="btn btn-primary mb-2 mr-2  mdi mdi-bell-ring text-danger mdi-18px  "></a>';
                                if (!$puplishPoint == '1') {
                                    echo '<button onclick="publishVotePoint();" type="button" class="btn btn-primary mb-2 mr-2 mdi mdi-trophy "> Publish votes</button>';
                                } else {
                                    echo '<button onclick="hideVotePoint();" type="button" class="btn btn-primary mb-2 mr-2 mdi mdi-trophy "> Hide votes</button>';
                                }
                            }
                            ?>

                            <!--  display vote points button if the member is a contestant or display contest button if the member is not a contestant -->
                            <?php echo  $contestantStatus == 'confirmed' ? '' : '<button onclick="contest();" type="button" class="btn btn-primary mb-2 mr-2 mdi mdi-trophy icon"> Contest</button>'; ?>
                            <p id="publish-votes-response"></p>

                        </div>
                    </div>
                    <p id="contest-response"></p>


                    <div class="row">
                        <div class="col-12 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between border-bottom">
                                        <h4 class="card-title mb-1">Contestants</h4>

                                        <!-- <p class="text-muted mb-1">Your data status</p> -->
                                    </div>
                                    <!-- get the total numbers of contestants with total votes -->
                                    <?php
                                    $total_contestant='0';
                                    $total_votes='0';

                                    if ($get_total_contestants_with_total_votes->num_rows() > 0) {
                                        foreach ($get_total_contestants_with_total_votes->result() as $row) {
                                            $total_contestant = $row->total_no;
                                            $total_votes = $row->total_votes;
                                            if($total_votes==""){
                                                $total_votes='0';
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="col-12 m-0 p-0 border-bottom p-3 text-center text-primary">
                                        <div class="row">
                                            <div class=" col-12 col-md-6">
                                                No. of contestants: <span class="text-success"><?php echo $total_contestant ?></span>
                                            </div>
                                            <div class=" col-12 col-md-6">
                                                Total votes: <span class="text-success"><?php echo $total_votes ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <!-- get contestants -->

                                        <?php
                                        if ($fetch_contestants_data->num_rows() > 0) {
                                            foreach ($fetch_contestants_data->result() as $row) {
                                                $memberG_user_id = $row->g_user_id;
                                                $memberG_vote_point = $row->g_vote_point;
                                                $memberUsername = $row->username;
                                                $memberEmail = $row->email;
                                                $memberPhone = $row->phone;
                                                $memberSex = $row->sex;
                                                $memberFirst_name = $row->first_name;
                                                $memberLast_name = $row->last_name;
                                                $memberCountry = $row->country;
                                                $memberState = $row->state;
                                                $memberCity = $row->city;
                                                $memberPhoto = $row->photo;
                                                $memberAbout_me = $row->about_me;



                                        ?>
                                                <div class="col-12">
                                                    <div class="preview-list">
                                                        <div class="preview-item border-bottom">
                                                            <div class="preview-thumbnail">
                                                                <div class="-icon">
                                                                    <img onclick="viewImg<?php echo $memberG_user_id ?>();" src="img/profile_photo/<?php echo $memberPhoto ?>" alt="" class="rounded-circle profile-pic" width="50" height="50">
                                                                </div>
                                                            </div>
                                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                                <div class="flex-grow">
                                                                    <p class="preview-subject text-lowercase"><?php echo $memberUsername  . " (<i>$memberFirst_name</i>)" ?></p>
                                                                </div>
                                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                    <p class="text-primary mb-0">Votes:
                                                                        <?php
                                                                        if ($puplishPoint == '1') {
                                                                            echo "<span class='text-success'>".$memberG_vote_point."</span>";
                                                                        } else {
                                                                            echo "<i class=' text-muted'>coming soon</i>";
                                                                        }

                                                                        ?>
                                                                    </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <script>
                                                    function viewImg<?php echo $memberG_user_id ?>() {
                                                        Swal.fire({
                                                            title: '<img src="img/profile_photo/<?php echo $memberPhoto ?>" alt="" class="rounded-circle profile-pic" class="profile-pic" width="250px" height="250px">',
                                                            text: "(Membership Id:<?php echo $memberG_user_id ?>)  ==  (Name: <?php echo $memberFirst_name . ' ' . $memberLast_name ?>)  == (Link: <?php echo base_url('contestant_link_processor?m_id=' . $memberG_user_id) . '&g_name=' . $groupName ?>)",
                                                            showDenyButton: false,
                                                            showConfirmButton: true,
                                                            showBackground: false,
                                                        });
                                                    }
                                                </script>
                                        <?php }
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>




                <!-- content-wrapper ends -->
                <!-- footer -->
                <?php $this->load->view("footer.php"); ?>
                <!-- end of footer -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php //$this->load->view('script.php'); 
    ?>
    <?php

    echo $this->session->flashdata('form');
    $this->session->set_flashdata('form', '');

    if ($membershipType == 'admin') { ?>
        <!-- update-profile-photo modal -->
        <div class="container">

            <!-- Modal -->
            <div class="modal fade" data-backdrop="static" id="change-profile-photo-modal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content bg-light text-dark">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update group profile</h4>
                        </div>
                        <!-- form open -->
                        <?php
                        $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'edit-profile-photo-form');
                        echo form_open(base_url('active_group/save_group_profile'), $attributes);
                        ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <p style="font-size: 12px;">Maximum size: 2.5mb<br> Image type|format: .gif|.GIF|.jpg|.JPG|.jpeg|.JPEG|.png|.PNG</p>
                                <label class="h5" for="group-logo">Select an image</label>
                                <input type="file" required name="groupLogo" id="group-logo" class="form-control">
                                <input type="hidden" name="previous_group_photo" id="previous-group-photo" value="<?php echo $groupLogo ?>" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="h5" for="group-description">Edit/update description</label>
                                <input type="text" name="group_description" id="group-description" required value="<?php echo set_value('group_description') != '' ? set_value('group_description') : $groupDescription ?>" class="form-control">

                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary " name="save" id="save"><i class="mdi mdi-content-save"></i>Save</button>
                                <p id="join-group-response"></p>
                            </div>

                        </div>
                        <?php echo form_close() ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                        </div>
                        <p id="save-profile-photo-response"></p>
                    </div>

                </div>
            </div>

        </div>
        <!-- end of update group profile modal -->
    <?php } ?>

    <script>
        function viewImg() {
            Swal.fire({
                title: '<img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic" width="300px" height="300px">',
                text: "Id:0012-im-an-ch; Height:5.1\" inches tall female; Color:Chocholate",
                showDenyButton: false,
                showConfirmButton: false,
                showBackground: false,
            });
        }


        function contest() {
            Swal.fire({
                title: '<h5>Notice: Admin will add you as a contestant</h5>',
                text: 'Do you really want to contest?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url('active_group/contest'); ?>",
                        success: function(data) {
                            $('#contest-response').html(data);
                        }
                    });

                }
            })

        }

        // publish vote points
        function publishVotePoint() {
            Swal.fire({
                title: '<h5>Notice: Vote points will be visible to all members of this group</h5>',
                text: 'Do you really want to publish points?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    var groupName = "<?php echo $groupName ?>";
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    $.ajax({

                        url: "<?php echo base_url('active_group/publish_votes'); ?>",
                        method: 'POST',
                        data: {
                            groupName: groupName,
                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                        },
                        success: function(data) {
                            $('#publish-votes-response').html(data);
                        }
                    });

                }
            })
        }

        // end of publish vote points


        function hideVotePoint() {
            Swal.fire({
                title: '<h5>Notice: Vote points will no longer be visible to all members of this group</h5>',
                text: 'Do you really want to hide vote points?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    var groupName = "<?php echo $groupName ?>";
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    $.ajax({

                        url: "<?php echo base_url('active_group/hide_votes'); ?>",
                        method: 'POST',
                        data: {
                            groupName: groupName,
                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                        },
                        success: function(data) {
                            $('#publish-votes-response').html(data);
                        }
                    });

                }
            })
        }

        // end of un-publish vote points
    </script>
</body>

</html>