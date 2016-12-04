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

</head>
<body>
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
        <li><a id ="somediv" href="#">Projects</a></li>
        <li><a id = "contact-btn" href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a id ="login-link" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center" id="main_container">
  <div class="row content">
    <div class="col-sm-9 text-left" id=calendar-frame>
      <br>
      {!! $calendar->calendar() !!}
      {!! $calendar->script() !!}
      <hr>

    </div>
    <div class="container text-centered" id="left_panel">
        <div class ="row col-md-offset-4">
          <div id="form" class= "col-md-6">
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
        </div>
        <div class ="row">
          <div class="recipe-panel">
            <div id ="recipe_list" class="container-fluid">
           <!--  <ul>
            <li class="span3">
              <a href="#">
                <img src="img/item-01.png" alt="Test">
                <div class="trihondaThumb">
                  <strong>Chicken</strong>
                    <span>dry runn</span>
                </div>
                </a>
            </li>
            </ul> -->
                <!-- These are our grid blocks -->
            </div>
          </div>
        </div>
    </div>
        
    </div>
  </div>
</div>

<footer class="footer centered">
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
              var recipe_urls = response.listOfUrls;
              var recipe_panel = $("#recipe_list");
              for ( var i = 0, l = recipe_ids.length; i < l; i++ ) {
                  //list all recipes results
            
                  recipe_panel.append("<div class=\'draggable-box span3\'" + "id =" + recipe_ids[i] + "><img src=" + recipe_images[i] + "><h3>" + recipe_titles[i] + "</h3></div>");
                  // recipe_panel.append("<div class=\'draggable-box span3\'" + "id =" + recipe_ids[i] + "><a href=" + recipe_urls[i] + "><img src=" + recipe_images[i] + "><h3>" + recipe_titles[i] + "</h3></a></div>");
                 $('#' + recipe_ids[i]).on('click', function() {
                  //opendialog(""+ recipe_urls[i] + "/");

                   alert("" + recipe_urls[i] + "");
                   
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
                            r = parseInt($('#calendar-frame').css('right'), 10);
                            $('#calendar-frame')

                                .animate(
                                    {
                                        
                                        right: r ? 0 : 100
                                    },1000
                                    
                                    );
                    
                        
                        
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
           // alert("stop");
               $('.recipe-panel').css("overflow", "scroll");
               

          },
                  
          revert: true,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      
    
      });
    
  </script>
  <script>
    $('#login-link').click(function(){
        r = parseInt($('#calendar-frame').css('right'), 10);
        $('#calendar-frame')

            .animate(
              { 
                right: r ? 0 : 100
              },1000
                
            );
    });

  </script>
  <script>
   $('#contact-btn').click(function(){
  r = parseInt($('#calendar-frame').css('right'), 10);
      $('#calendar-frame')

          .animate(
              { 
                  right: 0 ? 0 : 1000
              },1000
              
              );

  });

  </script>
  <script>
  $("#somediv").click(function() {
  opendialog("http://www.closetcooking.com/2011/11/buffalo-chicken-chowder.html/");
});

function opendialog(page) {
  var $dialog = $('#somediv')
  .html('<iframe style="border: 0px; " src="' + page + '" width="100%" height="100%"></iframe>')
  .dialog({
    title: "Page",
    autoOpen: false,
    dialogClass: 'dialog_fixed,ui-widget-header',
    modal: true,
    height: 500,
    minWidth: 400,
    minHeight: 400,
    draggable:true,
    /*close: function () { $(this).remove(); },*/
    buttons: { "Ok": function () { $(this).dialog("close"); } }
  });
  $dialog.dialog('open');
} 

  </script>
  <script>
  $(".recipe-panel").click(function() {
   
  r = parseInt($('#calendar-frame').css('right'), 10);
          $('#calendar-frame')

          .animate(
              { 
                  right: 0 ? 0 : 1000
              },1000
              
              );
        });
  </script>
</footer>

</body>
</html>
