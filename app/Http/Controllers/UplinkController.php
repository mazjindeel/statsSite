<?php
namespace App\Http\Controllers;

use App\Models\Mode;
use App\Models\Map;
use App\Models\MapMode;
use App\Models\Game;
use App\Models\Uplink;
use App\Models\UplinkPlayer;
use App\Models\Match;
use App\Models\Pick;

use Input;
use Redirect;
use View;

class UplinkController extends BaseModeAdminController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function update() {
        //TODO: need to remove UplinkPlayers where player was "unselected"
        $match = Match::find(Input::get('match_id'));
        $game = Game::find(Input::get('game_id'));
        $scoreTypeId = Input::get('score_type_id');
        $mode = Uplink::find(Input::get('mode_id'));
        $kills = Input::get('kills');
        $deaths = Input::get('deaths');
        $uplinks = Input::get('uplinks');
        $interceptions = Input::get('interceptions');
        $carries = Input::get('carries');
        $throws = Input::get('throws');
        $aplayerids = Input::get('aplayers');
        $bplayerids = Input::get('bplayers');
        $aplayers = [];
        //first, set game variables
        //TODO: set mapmode id
        $modeid = $game->mode()->first()->id;
        $mapmode = MapMode::where('map_id', '=', Input::get('map'))->where('mode_id', '=', $modeid)->first();
        $game->map_mode_id = $mapmode->id;
        $game->score_type_id = $scoreTypeId;
        $game->save();
        //next, set hp variables
        //TODO:set host stuff
        $mode->team_a_score = Input::get('a_score');
        $mode->team_b_score = Input::get('b_score');
        $mode->game_time = Input::get('minutes') * 60 + Input::get('seconds');
        $mode->a_victory = $mode->team_a_score > $mode->team_b_score ? 1 : 0;
        $mode->save();
        //get rid of extra players
        $extras = UplinkPlayer::whereNotIn('player_id', $aplayerids + $bplayerids)->where('uplink_id', '=', $mode->id);
        foreach($extras as $extra)
        {
            $extra->delete();
        }

        //set new players
        $i = 0;
        foreach($aplayerids as $aplayerid)
        {
            $aplayer = UplinkPlayer::where('player_id', '=', $aplayerid)->where('uplink_id', '=', $mode->id)->first();
            if(!$aplayer) //if a different player is selected
                $aplayer = new UplinkPlayer;
            $aplayer->player_id = $aplayerid;
            $aplayer->uplink_id = $mode->id;
            $aplayer->kills = $kills[$i];
            $aplayer->deaths = $deaths[$i];
            $aplayer->uplinks = $uplinks[$i];
            $aplayer->interceptions = $interceptions[$i] == "" ? null : $interceptions[$i];
            $aplayer->carries = $carries[$i];
            $aplayer->throws = $throws[$i];
            $aplayer->save();
            $i++;
            //TODO: host stuff
        }

        foreach($bplayerids as $bplayerid)
        {
            $bplayer = UplinkPlayer::where('player_id', '=', $bplayerid)->where('uplink_id', '=', $mode->id)->first();
            if(!$bplayer) //if a different player is selected
                $bplayer = new UplinkPlayer;
            $bplayer->player_id = $bplayerid;
            $bplayer->uplink_id = $mode->id;
            $bplayer->kills = $kills[$i];
            $bplayer->deaths = $deaths[$i];
            $bplayer->uplinks = $uplinks[$i];
            $bplayer->interceptions = $interceptions[$i] == "" ? null : $interceptions[$i];
            $bplayer->carries = $carries[$i];
            $bplayer->throws = $throws[$i];
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }

        //update picks
        parent::update_picks($game->id);
        //update specialists
        parent::update_specialist($game->id);

        //start process to refill cache for this event
        parent::refresh_cache($match->event_id);

        return Redirect::action('AdminController@dashboard');
    }
    public function edit($id) {
        //id is game id for now (change this later?)
        $game = Game::findOrFail($id);
        $match = $game->match()->first();
        $mode = $game->uplink()->first();
        $gameMode = $game->mode()->first();
        $game->mode = $gameMode;
        $map = $game->map()->first();
        $game->map = $map;
        $maplinks = $gameMode->maplink()->get();
        $maps = [];
        foreach($maplinks as $maplink)
            $maps[] = $maplink->map()->first();

        //all players in the uplink game
        $players = $mode->players()->get();
        //lists of all players per roster
        $aplayers = $match->rostera()->first()->playermap()->get();
        $bplayers = $match->rosterb()->first()->playermap()->get();
        foreach($aplayers as $aplayer) {
            $aplayerarr[$aplayer->player->id] = $aplayer->player->alias;
        }
        foreach($bplayers as $bplayer) {
            $bplayerarr[$bplayer->player->id] = $bplayer->player->alias;
        }
        //generate list of players by roster
        $ascores = [];
        foreach($players as $player)
            foreach($aplayers as $aplayer)
                if($player->player_id == $aplayer->player->id)
                {
                    $player->alias = $aplayer->player->alias;
                    if($player->host)
                        $mode->pHost = $player->player_id;
                    $ascores[] = $player;
                }
        $bscores = [];
        foreach($players as $player)
            foreach($bplayers as $bplayer)
                if($player->player_id == $bplayer->player->id)
                {
                    $player->alias = $bplayer->player->alias;
                    if($player->host)
                        $mode->pHost = $player->player_id;
                    $bscores[] = $player;
                }

        $items = parent::get_pick_items($match->event_id);
        $picks = Pick::where('game_id', $game->id)->orderBy('number')->get();

        $specialist_players = parent::get_specialist_players($game->id);
        $specialists = parent::get_specialists($match->event_id);

        return View::make('admin.game.uplink', compact('game', 'match', 'mode',
            'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores',
            'aplayerarr', 'bplayerarr', 'picks', 'items', 'specialist_players',
            'specialists'));
    }
}
