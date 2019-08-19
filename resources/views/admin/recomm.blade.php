@extends('admin.master')

@section('content')
  <div class="right_col" role="main">
      <div class="row">
        <!--flass message-->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <a class='close' data-dismiss='alert'>×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
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
      </div>  

        <div class="responsive">
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform"><i class="fas fa-plus-circle"></i> Recommendation / Initiatives</button>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Regions</th>
                    <th>Issue</th>
                    <th>Recommendation</th>
                    <th>Initiatives</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                  ?>

                @forelse($recomm as $value)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->location_name}}</td>
                    <td>{{$value->content}}</td>
                    <td>{{$value->recommendation}}</td>
                    <td>{{$value->initiatives}}</td>

                     
                        <?php 
                        /*
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->name.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        */
                        ?>
                        
                        <td class="" id="dlt"><i id="delete" onClick="deleteUser({{$value->id}})" class=" fas fa-trash-alt" style="color:red; font-size:18px;cursor:pointer;"></i></td>                   
                  </tr>
                @empty
                  <tr>
                    <td>No record found</td>
                  </tr>
                @endforelse
                </tbody>
            </table>    
        </div>      

<!-- Modal for add -->
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Recommendation / Initiatives</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveRecomm')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Select Issue</label>
            <select class="form-control" name="issue_id">
              @forelse($issues as $value)
                <option value="{{$value->id}}">{{$value->location_name}} -- {{$value->content}}</option>
              @empty()
                <option>No record found</option>
              @endforelse  
            </select>
          </div>          

          <div class="form-group">
            <label>Recommendation</label>
            <textarea class="form-control" name="recommendation" placeholder="add recommendation"></textarea>
          </div>          

          <div class="form-group">
            <label>Initiatives</label>
            <textarea class="form-control" name="initiatives" placeholder="add initiatives"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateIssue')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="id">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" required></input>
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
<!--edit form end--> 
  </div><!--main  col div end-->
@endsection

@section('js')

  <script type="text/javascript">
    function edit(id, name){
      $('[name="id"]').val(id);
      $('[name="name"]').val(name);

    }

//deleting 
 
  </script>
  <script type="text/javascript">

      function deleteUser(id){
        
       var url ="<?php echo url('delete-recommendation')?>";

        if(confirm('Are you sure delete this data?'))
        {
          // ajax delete data from database
            $.ajax({

              url : url+'/'+id,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                  
               $("#dlt").closest("tr").remove();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });

        }
      }
  </script>
@endsection