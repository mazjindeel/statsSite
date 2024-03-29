<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Match;
use App\Models\Event;
use App\Models\Team;
use App\Models\ScoreType;
use App\Models\MatchType;
use App\Models\Roster;

use View;
use Input;
use Redirect;

class MatchController extends Controller {
	public function __construct() {
        $this->middleware('auth');
	}
public function create() {
		$events = Event::all();
		$match_types = MatchType::all();
		$teams = Team::all();
		$score_types = ScoreType::all();
		return View::make('admin.match.create', compact('events', 'match_types', 'teams', 'score_types'));
	}

	public function update($id) {
		$events = Event::all();
		$match_types = MatchType::all();
		$teams = Team::all();
		$score_types = ScoreType::all();
		$match = Match::find($id);
		return View::make('admin.match.create', compact('events', 'match_types', 'teams', 'score_types', 'match'));

	}

    public function forfeit($id) {
        $match = Match::find($id);
        $roster_a = Roster::where('id', $match->roster_a_id)->with('team')->first();
        $roster_b = Roster::where('id', $match->roster_b_id)->with('team')->first();
        return View::make('admin.match.forfeit', compact('roster_a', 'roster_b', 'match'));
    }

    public function store_forfeit($id) {

        $match = Match::find($id);
        $match->forfeit_roster_id = Input::get('team');
        $match->save();
        return Redirect::action('AdminController@dashboard');
    }

	public function store() {
		$match = new Match;
		$match->event_id = Input::get('event');
		$match->roster_a_id = Team::find(Input::get('team_a'))->current->id;
		$match->roster_b_id = Team::find(Input::get('team_b'))->current->id;
		$match->match_type_id = Input::get('match_type');
		$match->score_type_id = Input::get('score_type');
		if($match->score_type_id == 3) {
			$match->a_map_count = Input::get('team_a_score');
			$match->b_map_count = Input::get('team_b_score');
		} else {
			$match->a_map_count = 0;
			$match->b_map_count = 0;
		}
		$match->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$matches = Match::all();
		return View::make('admin.match.manage', compact('matches'));
	}

	public function delete($id) {
		Match::destroy($id);
		return Redirect::action('MatchController@manage');
	}
}
