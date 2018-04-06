<div class="panel-group applicant-accord" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a  href="#about" data-toggle="collapse" data-parent="#accordion" >
            <b> User Documents </b>
          </a>
        </h4>
      </div>
      <!-- /.card-header -->
      <div id="about" class="panel-collapse collapse in">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="no-sort">Sr#</th>
                        <th>Doc Title</th>
                        <th>Doc Description</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($files) and count($files)>0)
                    <?php $pos = 1; ?>
                    @foreach($files as $file)
                    <tr>
                        <td><?php print $pos++ ?></td>
                        <td>{{ $file->doc_title }}</td>
                        <td>{{ $file->doc_description }}</td>
                        <td><a href="{{ asset('static/') }}/{{ $file->file_name }}" target="_blank">View File</a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="8">No Docs Found..!!</td></tr>
                    @endif
                </tbody>
            </table>

          <div class="clearfix"></div>
        </div>
      </div> 
    
    </div><!--panel-default-->
</div>


