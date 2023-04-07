<div id="content" class="container col-12 ">
  <div class="container bg-light col-sm-12 col-md-12">

    <div class="col-12 text-center my-3 ">
      <h5 class="title text-primary font-weight-bold">
        <u>Add Staff Form</u>
      </h5>
    </div>


    <form id="registerform" method="post" name="registerform" action="<?php echo base_url('admin/add_staff/process') ?>">
      <input type="hidden" name="csrftoken" value="ea49375f43c7e6a59c77df1e4de562b3f1350124eeb70e5d5124e4ce3b5251c2b4d12e9aaf2a3ddc618c178c8dc4620b">

      <div class="form-group">
        <input type="hidden" readonly="true" name="userId" value="<?php echo date('dmYsiH') ?>">
        <span class="text-danger"> <?php echo form_error('userId') ?> </span>
      </div>


      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Fullname:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <input type="text" name="fullName" class="form-control" placeholder="Full name" value="<?php echo set_value('fullName') ?>">
            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('fullName') ?> </span>
        </div>
      </div>

      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Username:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo set_value('username') ?>">
            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('username') ?> </span>
        </div>
      </div>

      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Email:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
            </div>
          </div>
          <span class="text-danger"> <?php echo form_error('email') ?> </span>
        </div>
      </div>

      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Password:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>">

            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('password') ?> </span>
        </div>
      </div>

      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Verify password:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <input type="password" name="reEnterPassword" class="form-control" placeholder="Re-enter password" value="<?php echo set_value('reEnterPassword') ?>">

            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('reEnterPassword') ?> </span>
        </div>
      </div>


      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Sex:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <select require name="sex" id="sex" class="form-control">
                <option value="<?php echo set_value('sex') ?>"><?php echo set_value('sex') ?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('sex') ?> </span>
        </div>
      </div>

      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Phone no:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <!-- input element here -->
              <input type="number" name="phoneNumber" class="form-control" placeholder="Phone number" value="<?php echo set_value('phoneNumber') ?>">

            </div>
          </div>
          <!-- error reporting here -->
          <span class="text-danger"> <?php echo form_error('phoneNumber') ?> </span>
        </div>
      </div>

      <div class="form-group text-right">
        <input type="submit" class="btn btn-primary" name="registerAccount" value="Add staff">
        </p>
      </div>


    </form>
  </div>
  <!-- end login -->

</div>