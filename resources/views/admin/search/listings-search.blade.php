<div class="panel panel-default">
  <div class="panel-heading">
  	<a href="javascript:void(0);" data-toggle="collapse" data-target="#search" style="color:#333;">
    	<b><i class="fa fa-search"></i> Search Listings </b>
    </a>
  </div>
  <div id="search" class="collapse">
    <div class="panel-body">
        <form method="get" id="search-form" action="" onsubmit="return false;">
          
        <div class="col-sm-3">
          <label class="control-label">Listing Title</label>
          <input type="text"  placeholder="Enter Listing Title" class="form-control" name="title" value="">
        </div>
        <!--col-sm-3-->
        <div class="col-sm-3">
          <label class="control-label">Dealer</label>
          <select class="form-control" name="dealer_id" >
            <option value="">Select Dealer</option>
            
          </select>
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
          <label class="label-control">Featured: </label>
          <select class="form-control" name="featured" >
            <option value="">Select Option</option>
            <option value="1">Featured</option>
            <option value="0">Non-Featured</option>
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
