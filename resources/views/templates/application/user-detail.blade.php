<div class="panel-group applicant-accord" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a  href="#about" data-toggle="collapse" data-parent="#accordion" >
            <b> User Details </b>
          </a>
        </h4>
      </div>
      <!-- /.card-header -->
      <div id="about" class="panel-collapse collapse in">
        <div class="card-body">
          <div class="form-group col-sm-4">
                <label>First Name </label>
                <p class="">{{ $user->first_name }}</p>
            </div>
            <div class="form-group col-sm-4">
                <label>Last Name</label>
                <p class="">{{ $user->last_name }}</p>
            </div>
            <div class="form-group col-sm-4">
                <label>Email</label>
                <p class="">{{ $user->email }}</p>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-4">
                <label>Phone Number</label>
                <p class="">{{ $user->phone_number }}</p>
            </div>

            <div class="form-group col-sm-8">
                <label>Current Residence</label>
                <p class="">{{ $user->address }}</p>
            </div>

          <div class="clearfix"></div>
        </div>
      </div> 
    
    </div><!--panel-default-->
</div>

