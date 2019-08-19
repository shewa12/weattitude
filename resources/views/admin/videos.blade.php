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
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addform"><i class="fas fa-plus-circle"></i> Video / Essay</button>
            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Title</th>
                    <th>Video</th>
                    <th>Essay</th>
                    <th>Tags</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                  ?>

                @forelse($videos as $value)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->title}}</td>
                    <td width="30%">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video class="embed-responsive-item" controls>
                            <source src="{{url('storage/app/videos/').'/'.$value->video}}" type="video/mp4">
                            </video>
                            
                        </div> 
                    

                      
                    </td>
                    <td>{{$value->essay}}</td>
                    <td>{{$value->tags}}</td>

                     
                        <?php 
                        /*
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->name.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        */
                        ?>
                        <td>
                        <?php 
                        echo 
                        '
                        <i class="fas fa-trash-alt" onClick ="deleteUser('.$value->id.')" data-toggle="modal" 
                        aria-hidden="true" style="color:red; font-size:18px;cursor:pointer;"></i>

                        ';
                        ?>
                        </td>
                        
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
        <h5 class="modal-title" id="exampleModalLabel">Add Video / Essay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveVideo')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
         
          <div class="form-group">
              <label>Title</label>
              <input class="form-control" name="title" required></input>
          </div>

          <div class="form-group">
            <label>Video</label>
            <input class="form-control" type="file" name="video" ></input>
          </div>          

          <div class="form-group">
            <label>Essay</label>
            <textarea class="form-control" name="essay" placeholder="add initiatives"></textarea>
          </div>          
          
          <div class="form-group">
            <label>Tags</label>
            <span class="helo-block">(add comma separated tags)</span>
            <input class="form-control" name="tags" ></input>
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
//this script for check is it img or not
$(document).ready(function(){
  $('[name="video"]').change(function(){
    var img = $(this).val();
  if (!img.match(/(?:mp4|avi|mov)$/)) {
    // inputted file path is not an image of one of the above types
    alert("please select an image!");
     $('[name="video"]').val('');
  }
  });
//SIZE VALIDATION
         $('[name="video"]').bind('change', function() {
            var size= this.files[0].size/1024/1024;
            if(size>25){
              alert("Please upload file less than 25mb");
              $('[name="video"]').val('');
            }
        });
//SIZE VALIDATION

});
//deleting 
 
  </script>
  <script type="text/javascript">

      function deleteUser(id){
        
       var url ="<?php echo url('delete-video')?>";

        if(confirm('Are you sure delete this data?'))
        {
          // ajax delete data from database
            $.ajax({

              url : url+'/'+id,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                  
               $("#table").load(location.href+" #table");
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