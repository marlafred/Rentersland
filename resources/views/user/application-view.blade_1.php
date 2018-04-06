@extends('master')
@section('title', 'User Dashboard')
@section('body')

@if(Auth::user()->user_type=='Tenant')
@include('user.rental-sidebar')
@else
@include('user.sidebar')
@endif

<!-- Content Area -->
<div class="col-sm-9 dash-content">
  <div class="col-sm-12 clmn">
    <div class="alert-box">
      <h4 class="heading"><b>Applicant View</b></h4>
      <div class="content">
        <div class="panel-group applicant-accord" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a  href="#about" data-toggle="collapse" data-parent="#accordion" >
                  <b> About </b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="about" class="panel-collapse collapse in">
              <div class="card-body">
                @include('templates.application.about')

                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#residences" data-toggle="collapse" data-parent="#accordion">
                  <b> Residences </b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="residences" class="panel-collapse collapse">
              <div class="card-body">
                @include('templates.application.residences')
                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#occupations" data-toggle="collapse" data-parent="#accordion">
                  <b> Occupation </b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="occupations" class="panel-collapse collapse">
              <div class="card-body">
                @include('templates.application.occupations')

                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" href="#refrences" role="button" aria-expanded="true" aria-controls="collapseOne">
                  <b> References </b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="refrences" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                @include('templates.application.refrences')
                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#add-infos" data-toggle="collapse" data-parent="#accordion">
                  <b> Additional Information </b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="add-infos" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                @include('templates.application.info')
                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#finance-details" data-toggle="collapse" data-parent="#accordion">
                  <b>Financial Details</b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="finance-details" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                @include('templates.application.financial')
                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--card-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#extras" data-toggle="collapse" data-parent="#accordion">
                  <b> Extras (Loan Details)</b>
                </a>
              </h4>
            </div>
            <!-- /.card-header -->
            <div id="extras" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                @include('templates.application.extras')
                <div class="clearfix"></div>
              </div>
            </div>
          </div><!--panel-default-->
        </div>
      </div>
    </div>
  </div>
</div>
@stop