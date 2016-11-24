<?php

namespace App\Http\Controllers;
use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EventController extends Controller
{
  public function index()
    {
      //$m = get_class_methods('');
      //var_dump($m);
      $events = \App\EventModel::all(); //EventModel implements MaddHatter\LaravelFullcalendar\Event
      $calendar = \Calendar::addEvents($events, [ //set custom color fo this event
      'backgroundColor' => '#800','textColor'=> 'black','editable'=> 'true'
      ])->setOptions([ //set fullcalendar options
       'firstDay' => 1
      ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
      //'viewRender' => 'function() {alert("Event Added!");}']
      'eventAfterAllRender' => 'function() {
       $(\'.fc-content\').css(\'height\', \'80px\');
       $(\'.fc-content\').css("background","url(\'http://static.food2fork.com/Buffalo2BChicken2BChowder2B5002B0075c131caa8.jpg\') no-repeat");
       $(\'.fc-content\').css("background-size", \'cont\');
     }',
   //Add event click callback
    'eventClick' => "function(event,element) {
        alert(event.id);
      }",
      //Add event drop callback
      'eventDrop' => 'function(event){
        if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }else{
            $.ajax({
               type:\'POST\',
               url:\'events/update\',
               data: {\'id\': event.id,
                      \'title\': event.title,
                      \'start_time\': event.start.format(),
                      \'end_time\': event.start.format(),
                    },
            });
        }
      }'
]);
  return view('main_page', compact('calendar'));
    }
  public function Create()
    {
      return view('event/create');
    }
  public function store(Request $request)
    {
     $time = explode(" - ", $request->input('time'));
     $event = new Event;
     $event->name = $request->input('name');
     $event->title = $request->input('title');
     $event->start_time = $time[0];
     $event->end_time = $time[1];
     $event->save();
     $request->session()->flash('success', 'The event was successfully saved!');
     return redirect('events/create');
    }
  public function show($id)
    {
     //return view('events/view', ['events' => Event::findOrFail($id)]);
    }
  public function edit($id)
    {
     return view('event/edit', ['event' => Event::findOrFail($id)]);
    }
  public function update(Request $request)
    {
      $title = $request->title;
      $id = $request->id;
      $start_time = $request->start_time;
      $end_time = $request->end_time;
      $e = \App\EventModel::find($request->id);
      $e->start_time = $start_time;
      $e->end_time = $end_time;
      $e->save();
    }
  public function destroy($id)
    {
     $event = Event::find($id);
     $event->delete();

     return redirect('events');
    }
    Public function welcome(){
      $event = Event::all();
      return $events;
      //return view('events/welcome');
    }
}
