<div class="panel panel-default">
  <div class="panel-heading">
  	<a href="javascript:void(0);" data-toggle="collapse" data-target="#search" style="color:#333;">
    	<b><i class="fa fa-search"></i> Search Accounts </b>
    </a>
  </div>
  <div id="search" class="collapse">
    <div class="panel-body">
        <form method="get" id="search-form" action="" onsubmit="return false;">
          
        <div class="col-sm-3">
          <label class="control-label">User Name</label>
          <input type="text"  placeholder="Enter User Name" class="form-control" name="title" value="">
        </div>
        <!--col-sm-3-->
        <div class="col-sm-3">
          <label class="control-label">User Email</label>
          <input type="text"  placeholder="Enter User Email" class="form-control" name="email" value="">
        </div>
        <!--col-sm-3-->
        
        <div class="col-sm-3">
          <label class="label-control">Status: </label>
          <select class="form-control" name="status" >
            <option value="">Select Option</option>
            <option value="1">Active</option>
            <option value="0">In-Active</option>
          </select>
        </div>
        
        <div class="col-sm-3">
          <label class="label-control">Type: </label>
          <select class="form-control" name="user_type" >
            <option value="">Select Option</option>
            <option value="Landlord">Landlord</option>
            <option value="Agent">Agent</option>
            <option value="Building Manager">Building Manager</option>
            <option value="Tenant">Tenant</option>
          </select>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="col-sm-3">
          <label class="label-control">State: </label>
          <select class="form-control" name="featured" >
            <option value="">Select State</option>
          </select>
        </div>
        
        <div class="col-sm-2">
          <label class="control-label">&nbsp;</label><br />
          <input type="submit" value="Search" class="btn btn-primary btn-block">
        </div>
        <!--col-sm-3-->
      </form>
    </div>
  </div>
</div>
