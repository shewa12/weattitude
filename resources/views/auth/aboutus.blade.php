@extends('layouts.app')

@section('content')
<div class="cointainer otherpage-area">
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-bottom:100px;">
			<h1 align="center" class="page-title">What is WEattitude.org
			</h1>
			<div class="content">
				<p align="center">
					WEattitude.org is the equivalent of a match-making/dating site (think match.com, eHarmony etc.) for philanthropy. Essentially, it is a platform that matches issues and solutions to people from all works of life (students, professionals etc.) who can implement practical and measurable solutions.

				</p>
			</div>
		</div>

	</div>


</div>

<!--image content-->
<div class="container">
	<div class="row post-area">
		<div class="col-md-6 col-xs-12 post">
			<div class="post-content">
				<h3>The Supporting Cast</h3>
				<p>
					WEattitude.org is kept afloat by a supporting cast of volunteers and skeletal admin staff.
				</p>
			</div>

		</div>

		<div class="col-md-6 col-xs-12 post-img">
			<img src="{{url('public/img/about/the supporting cast.png')}}" class"img-responsive"/>
		</div>
	</div>
  
	<div class="row post-area">

		<div class="col-xs-12 col-md-6 col-md-push-6 post">
			<div class="post-content">
        <h3>Culture</h3>
				<h3>Succession Planning Initiative</h3>
				<p>
The vision is to create a sustainable system that is independent of any one individual. To this end a transparent leadership and knowledge-sharing culture is paramount. Every participant is expected to document and share best practices. Furthermore, where possible, for each individual in a pivotal role, someone else should be prepared to take over if necessary. Replacement is always preparing someone else to take over and sharing exactly how they do whatever they do.
				</p>
			</div>

		</div>	

		<div class="col-xs-12 col-md-6 col-md-pull-6  post-img">
			<img src="{{url('public/img/about/culture - succession planning initiative.png')}}" class="img-responsive">
		</div>

	
	</div>

	<div class="row post-area">
		<div class=" col-xs-12 col-md-6 post">
			<div class="post-content">
        <h3>Culture</h3>
				<h3>Open Management Initiative</h3>
				<p>
The WEattitude.org Open Management Initiative is characterized by Transparency. This includes transparency in decision making, management processes, finances, best practices etc. The end goal is to have a sustainable and robust system that is flexible, able to adapt easily, and can proceed at maximum efficiency and effectiveness in the absence of any individual
				</p>
			</div>

		</div>

		<div class="col-xs-12 col-md-6   post-img">
			<img src="{{url('public/img/about/culture - open management initiative.png')}}" class="img-responsive">
		</div>
	</div>

	<div class="row post-area">

		<div class="col-xs-12 col-md-6 col-md-push-6  post">
			<div class="post-content">
        <h3>Analytics</h3>
				<h3>The Solution Impact Calculator Process</h3>
				<p>


Measurement is very important to the WEattitude platform. The aim is to deliver solutions and initiatives that provide the most positive possible under the given circumstances, not just initiatives that make participants feel good about themselves.
To accomplish this every recommended solution is passed through a system dynamic model to estimate the impact of the initiative and prioritize amongst various approaches to solving an issue.

				</p>
			</div>

		</div>
		<div class="col-xs-12 col-md-6 col-md-pull-6  post-img">
			<img src="{{url('public/img/about/analytics - the solution impact calculator process.png')}}" class="img-responsive">
		</div>
		
	</div>

  <div class="row post-area">


    <div class="col-xs-12 col-md-6   post">
      <div class="post-content">
        <h3>Analytics</h3>
        <h3>The Skills-to-Issues Ranking Process</h3>
        <p>

Impactful positive solutions are sought after on the WEattitude.org platform, not just solutions that make volunteers feel good about themselves.
To this end, when a participant's skills are matched against initiatives to tackle issues, a numeric ranking process matches the individual's skills and interests so as to prioritize each philanthropy opportunity in such a way that a participant's effort is maximized.
        </p>
      </div>

    </div>   
    <div class="col-xs-12  col-md-6  post-img">
      <img src="{{url('public/img/about/analytics - the skills to issues ranking process.png')}}" class="img-responsive">
    </div>     
  </div>

  <div class="row post-area">


    <div class=" col-xs-12 col-md-6 col-md-push-6 post">
      <div class="post-content">
        <h3>Funds – Inflow and Outflow</h3>
        <h3>Funds Transparency</h3>
        <p>


Financial transparency is at the core of the WEattitude.org philosophy. Monthly details of inflow and outflow of finances are made publicly available.


        </p>
        <a href="{{route('funds')}}" style="color:#000;">View More…</a>
      </div>

    </div>  
    <div class="col-xs-12 col-md-6 col-md-pull-6  post-img">
      <img src="{{url('public/img/about/funds - inflow and outflow funds transparency.png')}}" class="img-responsive">
    </div>      
  </div>
  <div class="row post-area">


    <div class="col-md-6  col-xs-12 post">
      <div class="post-content">
 
        <h3>Why Participate?</h3>
        <p>
         <li>Case Study 1: Career Opportunities</li> 
         <li>Case Study 2: Skill Development</li> 
         <li>Case Study 3: Self Fulfilment</li> 
         <li>Case Study 4: Help Communities You Care About</li> 
         <li>Case Study 5: Networking and Exposure for Success</li> 
         <li>Case Study 6: Supplemental Income</li> 

        </p>
        <a href="{{route('whyParticipate')}}" style="color:#000;">View More…</a>
      </div>

    </div>   
    <div class="col-md-6 col-xs-12  post-img">
      <img src="{{url('public/img/about/why participate.jpg')}}" class="img-responsive">
    </div>     
  </div>    

</div>
<!--image content end-->



@endsection

@section('js')

@endsection