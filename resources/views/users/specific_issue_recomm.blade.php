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
<!--issue list-->
<div class="row main-content">
  <div class="panel-default panel">
    <div class="panel-heading">
      <h3>What are Recommended Solutions for Unemployment [selected issues] in regions [selected regions] Bangladesh?</h3>
    </div>
    <div class="panel-body">
      <div class="col-sm-10">
          <h4><?php echo count($recomm);?> Recommendations  listed</h4>
      </div>
      <div class="col-sm-2">
          <button type="button" class="btn-primary btn" data-toggle="modal" data-target="#addIssue"><i class="fas fa-plus-circle"></i> Add Recommendation</button>
      </div>
    </div>
  </div>
@forelse($recomm as $value)
  <div class="panel panel-default">
    <div class="panel-body issue-content">
      
      <div class="col-xs-11 pull-left">
        {{$value->recommendation}}
      </div>

      <div class="col-xs-1 pull-right">
          <i class="fas fa-th-list toggle-icon dropdown-toggle"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="cursor:pointer"></i>

        <ul class="dropdown-menu">
          <li><a href="#">Give Rating</a></li>
          
          <li><a href="#">Mark for Delete</a></li>
          
          <li><a href="#">Suggest to Rename</a></li>
          
          <li><a href="#">Offer Recommendation</a></li>

          <li><a href="#">Offer for OR Against Remark</a></li>
        </ul>
      </div>

    </div>
  </div>
@empty()
  <div class="panel-default panel">
    <div class="panel-body">
      <strong>No record found</strong>
    </div>
  </div>
@endforelse

</div>
<!--issue list end-->

<!-- Modal for add -->
<div class="modal fade" id="addIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveSpecIssueRecomm')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
     
  
          <input type="hidden" name="issue_id" value="<?= $selected_issue ?>"> 
          <input type="hidden" name="region_id" value="<?= implode(',',$selected_region)?>"> 
          <div class="form-group">
            <textarea onKeyup="checkDuplicate()" class="form-control" name="recommendation" placeholder="Enter text here... max 250 words"></textarea>
            <span class="word-used" style="color:green;"></span>
          </div>
          <span class="help-block"></span>

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="submit">Submit</button>
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
        
       var url ="<?php echo url('delete-issue')?>";

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

      function checkDuplicate(){
          var issue_id= $("[name='issue_id']").val();
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          var recomm= $('[name="recommendation"]').val();
          var dataString= {_token:CSRF_TOKEN,issue_id:issue_id,recomm:recomm};
          
          if(recomm !==''){
            $.ajax({

              url: "<?php echo url('check-duplicate-recomm')?>",            
              type: "POST",
              data: dataString,
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data);
                  if(data=="duplicate"){
                    $(".help-block").html("Possible duplicate recommendation");
                    //countMatch(recomm);
                    $("#submit").attr('disabled',true);
                  }
                  else{
                    $(".help-block").empty();
                    countMatch(recomm);
                  }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  $(".word-used").empty();
                  console.log('Error matching duplicate data');
              }
          });  

          } //if end       
      }
      function countMatch(recomm){
        $(".word-used").empty();
        var matches= recomm.match(/\S+/g) ;
        var length= matches?matches.length:0;
        $(".word-used").html(250-length+" word remaining");
        if(length>250){
            $("#submit").attr('disabled',true);
            
        }
        else{
            $("#submit").attr('disabled',false);
        }
      }      
  </script>
@endsection