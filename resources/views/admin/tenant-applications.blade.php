@extends('adminlte::page')

@section('title', 'Tenant Applications')

@section('content_header')
   
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #c5dcf1;">
        <b><i class="fa fa-file-code-o "></i> &nbsp;Applicants List </b>
    </div>
    <div class="box-header">
        
    </div>
    
    <div class="box-body" style="overflow-x: auto; padding: 0;">
        
        <table id="users" class="display table table-striped" cellspacing="0" width="100%" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th class="no-sort">Sr#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>About</th>
                    <th>Residences</th>
                    <th>Occupation</th>
                    <th>Additional</th>
                    <th>Reference</th>
                    <th>Financial</th>
                    <th>Loans</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($userApp) > 0)
                    <?php $pos=1; ?>
                    @foreach ($userApp as $user)
                    <tr>
                        <td>{{ $pos++ }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ isset($user->about->percentage)?$user->about->percentage:'0' }} %</td>
                        <td>{{ isset($user->residence->percentage)?$user->residence->percentage:'0' }} %</td>
                        <td>{{ isset($user->occupation->percentage)?$user->occupation->percentage:'0' }} %</td>
                        <td>{{ isset($user->info->percentage)?$user->info->percentage:'0' }} %</td>
                        <td>{{ isset($user->reference->percentage)?$user->reference->percentage:'0' }} %</td>
                        <td>
                            <?php 
                                if(isset($user->finance) and count($user->finance)>0 ){ 
                                    foreach($user->finance as $finance){
                                        echo $finance->percentage.' %'; 
                                        break;
                                    }
                                }else{
                                    echo '0 %';
                                } 
                              ?>
                        </td>
                        <td>
                            <?php 
                                if(isset($user->loan) and count($user->loan)>0){ 
                                    foreach($user->loan as $loan){
                                        echo $loan->percentage.' %'; 
                                        break;
                                    }
                                }else{
                                    echo '0 %';
                                } 
                              ?>
                        </td>
                        <td>
                            <a href="{{ route('admin.view.application') }}/{{ $user->username }}" target="_blank"><i class="fa fa-eye"></i></a>
                            &nbsp; || &nbsp;
                            <a href="{{ route('admin.edit.application') }}/{{ $user->username }}" target="_blank"><i class="fa fa-pencil"></i></a>
                        </td>
                        
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
</div>
	
@stop