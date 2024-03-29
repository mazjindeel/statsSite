<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\EventType;
use App\Models\GameTitle;
use App\Models\Event;

use View;
use Input;
use Redirect;

class EventController extends Controller {

	public function __construct() {
        $this->middleware('auth');
	}

	public function create() {
		$event_types = EventType::all();
		$game_titles = GameTitle::all();
		return View::make('admin.event.create', compact('event_types', 'game_titles'));
	}

	public function store() {
		$event = new Event;
		$event->name = Input::get('event_name');
		$event->game_title_id = Input::get('game_title');
		$event->event_type_id = Input::get('event_type');
		$event->save();
		return Redirect::action('AdminController@dashboard');
	}
	
	public function manage() {
		$events = Event::all();
		return View::make('admin.event.manage', compact('events'));
	}

	public function delete($id) {
		Event::destroy($id);
		return Redirect::action('EventController@manage');
	}
}
