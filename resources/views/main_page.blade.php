<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delicious</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="fullcalendar/dist/fullcalendar.css"/>
  <link rel="stylesheet" href="fullcalendar/dist/fullcalendar.print.css" media='print'/>
  <script src='fullcalendar/node_modules/jquery/dist/jquery.min.js'></script>
  <script src='js/jquery-ui-1.12.1.custom/jquery-ui.js'></script>
  <script src='fullcalendar/node_modules/moment/moment.js'></script>
  <script src='fullcalendar/dist/fullcalendar.js'></script> 
  <script src='js/jquery.pinto.js'></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>
  <script>

    $('#recipe_list').pinto();

  </script>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 100%}

    /* Set gray background color and 100% height */
    .sidenav {
      margin-top: 75px;
      padding-top: 30px;
      background-color:gray;
      height: 300px;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>

</head>
<body style="background-color:#34495e;">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center" id="main_container">
  <div class="row content">
    <div class="col-sm-9 text-left">
      <br>
      {!! $calendar->calendar() !!}
      {!! $calendar->script() !!}
      <hr>

    </div>
    <div class="container col-md-3 sidenav text-centered" id="left_panel">
        <div id="form">
          {!! Form::open(['url' => 'events/search']) !!}
            {{ csrf_field() }}
            <div class="form-group">
              {!! Form::label('title', 'Recipe Title') !!}
              {!! Form::text('recipe', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              {!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
          </div>
          {!! Form::close() !!}
        </div>
        <div class="recipe-panel col-md-3">
          <div id ="recipe_list" class="container span6 offset6">
            <!-- These are our grid blocks -->
        </div>
        </div>
        </div>
        
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
   <script>
    $("form").on('submit', function (e) {
      
        e.preventDefault();
        var recipe = $("input[name='recipe']").val();
        $.ajax({
            type: "POST",
            url:'events/search',
            data: $('form').serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function( response ){
                // Handle your response..
              var recipe_ids = response.listOfId;
              var recipe_titles = response.listOfTitle;
              var recipe_images = response.listOfImages;
             // var recipe_urls = response.listOfRecipe_Url;
              var recipe_panel = $("#recipe_list");
              for ( var i = 0, l = recipe_ids.length; i < l; i++ ) {
                  //list all recipes results
                  recipe_panel.append("<div class=\'draggable-box\'" + "id =" + recipe_ids[i] + "><a href=#" + "><img src=" + recipe_images[i] + "></a><h3>" + recipe_titles[i] + "</h3></div>");
                 $('#' + recipe_ids[i]).on('click', function() {
                  // alert($(this).text());
                  // alert(recipe_urls[i]);
                   
                 });
                $('#' + recipe_ids[i]).draggable({
                  
                  zIndex:999,
                  helper: 'clone',
                  init: function(){
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                      };
                      
                      // store the Event Object in the DOM element so we can get to it later
                      $(this).data('eventObject', eventObject);
                  },
                  start: function() {
                    
                      $('.recipe-panel').css("overflow", "visible");
                        
                  },
                  stop: function() {
                      $('.recipe-panel').css("overflow", "scroll");
                      //alert(eventObject.text());
                  },
                
                  revert: true
                  });            
              }
         }
         ,
            error: function( _response ){
                // Handle error
              alert("No Data error");
             // var recipe_panel = $("#recipe_list");
             
              //recipe_panel.append("<div class=\'draggable-box\'" + "id =1" + "><img src=img\item-02.png" + "><h3>Chicken</h3></div>");
              }    
        });
    });
   </script>

  <script>
  $('fc-content').each(function() {
      
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };
        
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        
        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 999,
          start: function() {
            
              $('.recipe-panel').css("overflow", "visible");
          },
          stop: function() {
               $('.recipe-panel').css("overflow", "scroll");
          },
                  
          revert: true,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      
    
      });
    
  </script>
</footer>

</body>
</html>
