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
    <?php// print_r($selected_region);?>
    <div class="panel-heading">
      <h3>
        <?php  $n=count($selected_region);?>
        What are issues in [

          @forelse($selected_region as $k=>$i)
            {{$i->location_name}}
            @if($k<$n-1)
            {{","}}
            @endif
          @empty
          @endforelse
        ]

      </h3>
    </div>
    <div class="panel-body">
      <div class="col-sm-10">
          <h4><?= count($issues);?> Issue listed</h4>
      </div>
      <div class="col-sm-2">
          <button type="button" class="btn-primary btn" data-toggle="modal" data-target="#addIssue"><i class="fas fa-plus-circle"></i> Add Issue</button>
      </div>
    </div>
  </div>
@forelse($issues as $value)
  <div class="panel panel-default">
    <div class="panel-body issue-content">
      
      <div class="col-xs-11 pull-left">{{$value->content}}</div>
      <div class="col-xs-1 pull-right">
          <i class="fas fa-th-list toggle-icon dropdown-toggle"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="cursor:pointer"></i>

        <ul class="dropdown-menu">
          <li><a class="rating"  data-target="#addRating" id="{{$value->id}}" data-toggle="modal">Give Rating</a></li>
          
          <li><a class="mark_delete" id="{{$value->id}}">Mark for Delete</a></li>
          
          <li><a class="addIssueForSug" id="{{$value->id}}" data-toggle="modal" data-target="#addSuggest">Suggest to Rename</a></li>
          
          <li><a href="{{url('offer-recommendation')}}/{{$value->id}}">Offer Recommendation</a></li>

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
        <form method="post" action="{{route('saveIssue')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <?php $arr=[];?>
          @forelse($selected_region as $sr)
              <?php $arr[]=$sr->id?>
          @empty
          @endforelse   
          <input type="hidden" name="region_id" value="<?php echo implode(',',$arr)?>"> 
          <div class="form-group">
            
            <textarea onKeyup="checkDuplicate()" class="form-control" name="content" placeholder="Enter text here... max 250 words"></textarea>
           
            <span class="word-used" style="color:green;"></span>
          </div>
          <div class="help-block"></div>
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

<!--ratting form--> 

<div class="modal fade" id="addRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Give a rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:center;font-size:25px;">
        <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="type_id">
          <input type="hidden" name="type" value="issue">

          <div class="checkbox">
            <i type="checkbox" id="checkbox" name="rating" value="1" class="far fa-thumbs-up bubbly-button"></i>
            <i class="far fa-thumbs-up bubbly-button" id="1"></i>
            <i class="far fa-thumbs-up bubbly-button" id="2"></i>
            <i class="far fa-thumbs-up bubbly-button" id="3"></i>
            <i class="far fa-thumbs-up bubbly-button" id="4"></i>
            <i class="far fa-thumbs-up bubbly-button" id="5"></i>

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
<!--suggest to rename-->

<div class="modal fade" id="addSuggest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suggest to new name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" id="" name="setIssueIdForSug">
              <div class="form-group">
                <label>Enter new name suggestion</label>
                <textarea class="form-control" name="issue_suggestion"></textarea>
             </div>
             <div class="form-group">
               <button type="button" onClick="issueSuggestion()" class="btn btn-primary">Submit</button>
             </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--suggest to rename end-->
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
          var csrf_token= $('meta[name="csrf-token"]').attr('content');
          var region_id= $('[name="region_id"]').val();
          var content= $('[name="content"]').val();
          var dataString = {
            _token:csrf_token,
            region_id:region_id,
            content:content
          };
        if(content !==''){
            $.ajax({

              url: "<?php echo url('check-duplicate-issue')?>",            
              type: "POST",
              data: dataString,
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data);
                  if(data=="duplicate"){
                    $(".help-block").html("Possible duplicate issue");
                    countMatch(content);
                    $("#submit").attr('disabled',true);
                  }
                  else{
                    $(".help-block").empty();
                    countMatch(content);
                  }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  $(".word-used").empty();
                  console.log('Error matching duplicate data');
              }
          }); 
            
        } //endif        
      }
      function countMatch(content){
        $(".word-used").empty();
        var matches= content.match(/\S+/g) ;
        var length= matches?matches.length:0;
        $(".word-used").html(250-length+" word remaining");
        if(length>250){
            $("#submit").attr('disabled',true);
            
        }
        else{
            $("#submit").attr('disabled',false);
        }
      }
      //count match end

      //rating
      var rating;

      $(".fa-thumbs-up").on('click',function(){
          rating= $(this).attr('id');
          $(".fa-thumbs-up").removeClass('active-thumb');
          $(".fa-thumbs-up").removeClass('shake');
          $(this).addClass('active-thumb shake');

          var typeId= $('[name="type_id"]').val();
          var csrf_token= $('meta[name="csrf-token"]').attr('content');
          var dataString= {
            _token:csrf_token,
            
            type_id:typeId,
            rating:rating
          };

            $.ajax({

              url:"<?php echo url('/issue-rating')?>",            
              type: "POST",
              data:dataString,
              dataType: "HTML",
              success: function(data)
              {
                if(data=="exists"){
                    alert("You have already submited rating!");
                    return ;
                }
                else{
                  location.reload();   
                  alert("Rating posted!");
                  console.log(data);
                                
                }

                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('Error posting rating');
              }
          });



      });//function close
      //rating end

      //set issue id
      $(".rating").click(function(){
        $(".fa-thumbs-up").removeClass('active-thumb shake');
        var issue_id= $(this).attr('id');
        $('[name="type_id"]').val(issue_id);
      });
      //set issue id end

      $(".mark_delete").on('click',function(){
            var issue_id= $(this).attr('id');
            
            $.ajax({

              url:"<?php echo url('/issue-mark-delete')?>"+'/'+issue_id,            
              type: "GET",
             
              dataType: "HTML",
              success: function(data)
              {
                 alert(data);
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('Error posting rating');
              }
          });
      });
      //issue suggestion
          function issueSuggestion(){
          var issue_id= $("[name='setIssueIdForSug']").val();
          var issue_suggest= $('[name="issue_suggestion"]').val();
          var csrf_token= $('meta[name="csrf-token"]').attr('content');
          var dataString= {
            _token:csrf_token,
            issue_id:issue_id,
            issue_suggest:issue_suggest

          };
            $.ajax({

              url:"<?php echo url('/issue-suggestion')?>",            
              type: "POST",
              data:dataString,
              dataType: "HTML",
              success: function(data)
              {
                if(data=="exists"){
                    alert("You have already submited suggestion!");
                    $("[name='issue_suggestion']").empty();
                    return ;
                }
                else{
                  $("[name='issue_suggestion']").empty();  
                  alert("Suggestion  submitted!");
                 
                                
                }

              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('Error posting suggestion');
              }
          });

      }

      $('.addIssueForSug').on('click',function(){
          var issue_id= $(this).attr('id');
          $('[name="setIssueIdForSug"]').val(issue_id);
      });

  </script>
@endsection