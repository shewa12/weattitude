@extends('admin.master')

@section('content')
<div class="right_col" role="main">
<div class="container">
    <div class="row">
        <!--flass message-->
        @if(Session::has('success'))
            <div class="alert alert-success">
              <a class='close' data-dismiss='alert'>×</a>
                <h4>{!!Session::get('success')!!}</h4>
            </div>
        @endif        

        @if(Session::has('fail'))
            <div class="alert alert-danger">
                <h4>{!!Session::get('fail')!!}</h4>
            </div>
        @endif
        <!--end flass message-->

        <div class="responsive">

          
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform"><i class="fas fa-plus-circle"></i>Work Log</button>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Title</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
<?php 
    $i=1;
?>    

@forelse($worklog as $value)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->hour}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->description}}</td>
                        <td> 
                        <?php 
                        
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->hour.'\', \''.$value->title.'\',\''.$value->description.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        ?>
                        </td>
                        <td class=""><i id="delete" onClick="dlt(<?php echo $value->id?>)" class="msgbox warning fas fa-trash-alt" style="color:red; font-size:18px;cursor:pointer;"></i></td>
                    </tr>
@empty
<tr>
    <td>No record found</td>
</tr>                    
@endforelse       

                </tbody>
            </table>
        </div>
    </div>

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="save-worklog">
              {{ csrf_field() }}
          <div class="form-group">
            <label for="hour">Select Hour</label>
            <select class="form-control" name="hour" id="hour" required>
                <option value="1st Hour">1st Hour</option>
                <option value="2nd Hour">2nd Hour</option>
                <option value="3rd Hour">3rd Hour</option>
                <option value="4th Hour">4th Hour</option>
                <option value="5th Hour">5th Hour</option>
                <option value="6th Hour">6th Hour</option>
                <option value="7th Hour">7th Hour</option>
                <option value="8th Hour">8th Hour</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Work Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputPassword1" placeholder="Work Title" required>
          </div>          

          <div class="form-group">
            <label for="exampleInputPassword1">Work Detail</label>
            <input type="text" name="detail" class="form-control" id="exampleInputPassword1" placeholder="Work Detail" required>
          </div>

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for add end-->   

<!--edit form--> 

<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo route('updateForm')?>">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="">
          <div class="form-group">
            <label for="hour">Select Hour</label>
            <input class="form-control" name="hour" value=""/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Work Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputPassword1" placeholder="" required>
          </div>          

          <div class="form-group">
            <label for="exampleInputPassword1">Work Detail</label>
            <input type="text" name="detail" class="form-control" id="exampleInputPassword1" placeholder="" required>
          </div>

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Update</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--edit form end--> 
</div>
</div>
@endsection