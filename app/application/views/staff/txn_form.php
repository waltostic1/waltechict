<div id="content" class="container col-12 ">
  <div class="container text-light bg-info col-sm-12 col-md-12 p-2">

    <div class="col-12 text-center my-3 ">
      <h4 class="title font-weight-bold">
        <u>Create transaction</u>
      </h4>
    </div>


    <form id="txn-form" method="post" name="txn_form" action="<?php echo base_url('staff/txn/create') ?>">
      <input type="hidden" name="csrftoken" value="ea49375f43c7e6a59c77df1e4de562b3f1350124eeb70e5d5124e4ce3b5251c2b4d12e9aaf2a3ddc618c178c8dc4620b">


      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Transaction id:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <input class="form-control" style="background: none!important; border:none!important; color:white!important" type="text" readonly="true" name="txn_id" value="<?php echo (date('dmYsiH') . rand(99999, 10)) ?>">
            </div>
          </div> <span class="text-warning"> <?php echo form_error('txn_id') ?> </span>
        </div>
      </div>


      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Select transaction type:</label>
            </div>
            <div class="col-12 col-md-8 ">
              <select required name="type" id="type" class="form-control">                
                <option value="<?php echo set_value('type') ?>"><?php echo set_value('type') ?></option>
                <option value="Sales">Sales</option>
                <option value="Expenses">Expenses</option>
              </select>

            </div>
          </div> <span class="text-warning"> <?php echo form_error('type') ?> </span>
        </div>
      </div>



      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Enter transaction purpose:</label>
            </div>
            <div class="col-12 col-md-8 ">


              <input type="text" required name="purpose" class="form-control" placeholder="transaction purpose" value="<?php echo set_value('purpose') ?>">
            </div>
          </div>
          <span class="text-warning"> <?php echo form_error('purpose') ?> </span>
        </div>
      </div>



      <div class="form-group ">
        <div class="col-12 container-fluid  " style="padding:10px;">
          <div class="row">
            <div class="col-12 col-md-4 text-md-right">
              <label>Enter transaction amount:</label>
            </div>
            <div class="col-12 col-md-8 ">

              <input type="number" required name="amount" class="form-control" placeholder="amount" value="<?php echo set_value('amount') ?>">
            </div>
          </div>
          <span class="text-warning"> <?php echo form_error('amount') ?> </span>
        </div>
      </div>







      <div class="form-group text-right">

        <input type="submit" class="btn btn-success" name="create" value="Create">
        
      </div>


    </form>
  </div>
  <!-- end login -->

</div>