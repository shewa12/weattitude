@extends('layouts.app')

@section('content')
<div class="cointainer otherpage-area">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <form class="form-horizontal" action="" method="">
        <h1 class="page-title">Issues & Suggested Solutions</h1>
        <div class="input-group">
          <span class="input-group-addon"><i class="fas fa-search"></i></span>
          <input id="search" onKeyup="getLocations()" type="text" class="form-control" name="region" placeholder="Search your region...">
        </div>
        <div class="search-result" style="padding: 0px 15px;"></div>
        <div class="form-group" style="margin-left: 1px;margin-top: 20px;">
            <button type="button" class="btn-default btn" id="searchBtn">Search <i  class="fas fa-spinner fa-spin" id="loading" style="padding-left:5px;color:blue"></i></button>
            <button type="button" data-target="#advanceSearch" data-toggle="modal" class="btn-primary btn">Advance Search </button>
        </div>
      </form>
    </div>

  </div>
<div class="container">
  <div class="row" id="result">
<!--issue table-->
    <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Regions</th>
                    <th>Issue</th>
                    <th>Severity</th>
                    <th>Initiatives</th>
                    <th>Recommendation</th>
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
                    <td>{{$value->severity}}</td>
                    <td>{{$value->initiatives}}</td>
                    <td>
                        <a href="{{url('issue-detail/'.$value->id)}}" style="color:#000;">{{$value->recommendation}}</a>
                    </td>
                    

                     
                        <?php 
                        /*
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->name.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        */
                        ?>
                        
                   
                  </tr>
                @empty
                  <tr>
                    <td>No record found</td>
                  </tr>
                @endforelse
                </tbody>
            </table> 
    </div>      
<!--issue table end-->
  </div>
</div>
  <div class="row" id="advanceSearchresultForAll"></div>
</div>

<!--advance search modal-->
<div id="advanceSearch" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advance Search</h4>
      </div>
      <div class="modal-body">
          <form class="form" action="{{route('advanceSearch')}}" method="post">
            {{csrf_field()}}
              <div class="form-group">
                  <label>Search Solution</label>
                  <input class="form-control" onKeyup="solution(this.value)" name="recommendation" placeholder="Search solution"></input>

                  <div class="solution-result"></div>
              </div>              

              <div class="form-group">
                  <label>Search Issue</label>
                  <input class="form-control" onKeyup="searchIssue(this.value)" name="issue" placeholder="Search issue"></input>

                  <div class="issue-result"></div>
              </div>              

              <div class="form-group">
                  <label>Search Region</label>
                  <input class="form-control" onKeyup="advanceSearch(this.value)" name="region" placeholder="Search region"></input>    
                  <div class="advance-search-result"></div>      
              </div>              

              <div class="form-group">
                  <button type="submit" onClick="advanceSearchResult()" class="btn-primary btn">Search <span id="loading"><i class="fas fa-spinner fa-spin"></i></span></button>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--advance search modal-->
@endsection

@section('js')
<script type="text/javascript">
  function getLocations(){
        var location= $("#search").val();


            $.ajax({

              url : "<?php echo url('visitor-search-region')?>"+'/'+location,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
                $(".search-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });
  }

  $(document).ready(function(){
        $("#searchBtn").click(function(){
        var id= $( "#region option:selected" ).val();
           
    $.ajax({
        url:"<?php echo url('issue-by-region')?>"+"/"+id,
        type:"GET",
        dataType:"HTML",
        beforeSend:function(){
            $("#loading").show();
        },
        success:function(data){
          
            $("#loading").hide();
            
            $("#result").html(data);
            
        },
        error:function(){
          alert("error");
        }
    });            
            
        });
  });  

  function solution(solution){
            $.ajax({

              url : "<?php echo url('visitor-search-solution')?>"+'/'+solution,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
                $(".solution-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });      
  }

  function searchIssue(issue){

            $.ajax({

              url : "<?php echo url('visitor-search-issue')?>"+'/'+issue,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
                $(".issue-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });      
  }  

  function advanceSearch(location){
        //var location= $("#search").val();


            $.ajax({

              url : "<?php echo url('visitor-search-region')?>"+'/'+location,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
                $(".advance-search-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });
  }  





</script>
@endsection