<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="fullcalendar/dist/fullcalendar.css"/>
    <link rel="stylesheet" href="fullcalendar/dist/fullcalendar.print.css" media='print'/>
    <script src='fullcalendar/node_modules/jquery/dist/jquery.min.js'></script>
    <script src='fullcalendar/node_modules/moment/moment.js'></script>
    <script src='fullcalendar/dist/fullcalendar.js'></script>




    <script>

/*
  jQuery document ready
*/
$(document).ready(function(){

$('#calendar').fullCalendar({
  header: {
    left: 'prevYear,prev,next,nextYear',
    center: 'title',
    right: ''
},
  height: 580,
  aspectRatio: 2,
  editable: true,
  draggable: false,
  events: [
        {
            title: 'Event1',
            start: '2016-10-25'
        },
        {
            title: 'Event2',
            start: '016-10-26'
        }
        // etc...
    ],
    color: 'yellow',   // an option!
    textColor: 'black',// an option!
   eventRender: function(event, element) {
       element.qtip({
           content: event.description
       });
   },

  dayClick: function(date) {

    var view = $('#calendar').fullCalendar('getDate');
    alert('a day has been clicked! ' + date.format());
    $(this).css('background-color', 'red');

  },

  });

});




    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Executives">
    <meta name="author" content="Alvarez.is - BlackTie.co">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title>Executives</title>

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="js/main.js"></script>
    <script src="js/smoothscroll.js"></script>


  </head>

  <body data-spy="scroll" data-offset="0" data-target="#navigation">

    <!-- Fixed navbar -->
	    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#"><b>Executives</b></a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li class="active"><a href="#home" class="smothscroll">Home</a></li>
	            <li><a href="#desc" class="smothscroll">Description</a></li>
	            <li><a href="#showcase" class="smothScroll">Showcase</a></li>
	            <li><a href="#contact" class="smothScroll">Contact</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
            <!--/End nav- -->

	<section id="home" name="home"></section>
	<div id="headerwrap">
    <div class="row">
        <div class="calendar-side col-md-8" style="color:#fbeed5;" id="calendar"></div>
        <div class="container col-md-3 centered" style="height:600px; background-color:gray; margin-top:53px;">
          <div class="container"><br>
            <form action="/" method="get">
              <input type="text" name="ingredient">
              <input type="submit">
            </form>
        </div><br>
        <div class=" container receipe-panel">
          @if (count($errors) === 0)
            	@for ($i = 0; $i < count($listOfRecipesTitle); $i++)

                <div class="row col-md-12">
                <div class="pin">
                  <img src="{{$listOfRecipesImage[$i]}}"><br>
                  <div class="row">
                  <p>{{$listOfRecipesTitle[$i]}} </p><br>
                </div>
                </div>
              </div>

              @endfor
              @endif
              </div>
          </div>
	    </div> <!--/ .container -->
	</div><!--/ #headerwrap -->


	<section id="desc" name="desc"></section>
	<!-- INTRO WRAP -->
	<div id="intro">
		<div class="container">
			<div class="row centered">
				<h1>Designed To Excel</h1>
				<br>
				<br>
				<div class="col-lg-4">
					<img src="img/intro01.png" alt="">
					<h3>Community</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</div>
				<div class="col-lg-4">
					<img src="img/intro02.png" alt="">
					<h3>Schedule</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</div>
				<div class="col-lg-4">
					<img src="img/intro03.png" alt="">
					<h3>Monitoring</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</div>
			</div>
			<br>
			<hr>
	    </div> <!--/ .container -->
	</div><!--/ #introwrap -->

	<!-- FEATURES WRAP -->
	<div id="features">
		<div class="container">
			<div class="row">
				<h1 class="centered">What's New?</h1>
				<br>
				<br>
				<div class="col-lg-6 centered">
					<img class="centered" src="img/mobile.png" alt="">
				</div>

				<div class="col-lg-6">
					<h3>Some Features</h3>
					<br>
				<!-- ACCORDION -->
		            <div class="accordion ac" id="accordion2">
		                <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
		                        First Class Design
		                        </a>
		                    </div><!-- /accordion-heading -->
		                    <div id="collapseOne" class="accordion-body collapse in">
		                        <div class="accordion-inner">
								<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								</div><!-- /accordion-inner -->
		                    </div><!-- /collapse -->
		                </div><!-- /accordion-group -->
		                <br>

		                <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
		                        Retina Ready Theme
		                        </a>
		                    </div>
		                    <div id="collapseTwo" class="accordion-body collapse">
		                        <div class="accordion-inner">
								<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								</div><!-- /accordion-inner -->
		                    </div><!-- /collapse -->
		                </div><!-- /accordion-group -->
		                <br>

		                 <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
		                        Awesome Support
		                        </a>
		                    </div>
		                    <div id="collapseThree" class="accordion-body collapse">
		                        <div class="accordion-inner">
								<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								</div><!-- /accordion-inner -->
		                    </div><!-- /collapse -->
		                </div><!-- /accordion-group -->
		                <br>

		                 <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
		                        Responsive Design
		                        </a>
		                    </div>
		                    <div id="collapseFour" class="accordion-body collapse">
		                        <div class="accordion-inner">
								<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								</div><!-- /accordion-inner -->
		                    </div><!-- /collapse -->
		                </div><!-- /accordion-group -->
		                <br>
					</div><!-- Accordion -->
				</div>
			</div>
		</div><!--/ .container -->
	</div><!--/ #features -->


	<section id="showcase" name="showcase"></section>
	<div id="showcase">
		<div class="container">
        <div class="col-md-12" style="color:white;" id="calendar"></div>
			<div class="row">
				<h1 class="centered">Some Screenshots</h1>
				<br>
				<div class="col-lg-8 col-lg-offset-2">

				</div>
			</div>
			<br>
			<br>
			<br>
		</div><!-- /container -->
	</div>


	<section id="contact" name="contact"></section>
	<div id="footerwrap">
		<div class="container">
			<div class="col-lg-5">
				<h3>Address</h3>
				<p>
				Av. Greenville 987,<br/>
				New York,<br/>
				90873<br/>
				United States
				</p>
			</div>

			<div class="col-lg-7">
				<h3>Drop Us A Line</h3>
				<br>
				<form role="form" action="#" method="post" enctype="plain">
				  <div class="form-group">
				    <label for="name1">Your Name</label>
				    <input type="name" name="Name" class="form-control" id="name1" placeholder="Your Name">
				  </div>
				  <div class="form-group">
				    <label for="email1">Email address</label>
				    <input type="email" name="Mail" class="form-control" id="email1" placeholder="Enter email">
				  </div>
				  <div class="form-group">
				  	<label>Your Text</label>
				  	<textarea class="form-control" name="Message" rows="3"></textarea>
				  </div>
				  <br>
				  <button type="submit" class="btn btn-large btn-success">SUBMIT</button>
				</form>
			</div>
		</div>
	</div>
	<div id="c">
		<div class="container">
			<p>Created by <a href="http://www.blacktie.co">BLACKTIE.CO</a></p>

		</div>
	</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
	<script>
	$('.carousel').carousel({
	  interval: 3500
	})
	</script>

  </body>
</html>
