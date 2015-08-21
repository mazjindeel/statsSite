@section('general')
    <div class="row" style="margin-bottom:10px">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
            {{--!!Form::label('map', 'Map')!!--}}
            <label for="map">Map</label>
            <select class="form-control" id="map" name="map">
                @foreach($maps as $mapoption)
                   @if($game->map->name == $mapoption->name) 
                        <option value="{!!$mapoption->id!!}" selected="selected"> {!! $mapoption->name!!}</option>
                   @else
                        <option value="{!!$mapoption->id!!}">{!!$mapoption->name!!}</option>
                    @endif
                @endforeach
            </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="form-group">
                <label for="game_number">Game Number</label>
                <input type="text" name="game_number" value={!!$game->game_number!!} class="form-control">                        
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="form-group">
            <label for="minutes">Minutes</label>
            <input type="text" name="minutes" class="form-control" size="5" value="{!!(int)($mode->game_time / 60)!!}">
            <label for="seconds">Seconds</label>
            <input type="text" name="seconds" class="form-control" size="5" value="{!!$mode->game_time % 60!!}">
            {{--{!!Form::label('game_time', 'Game Time (IN SECONDS (MINUTES*60 + SECONDS))')!!}--}}
            {{--{!! Form::text('game_time', '' , array('class'=>'form-control')) !!}--}}
            </div>
        </div>
    </div>
@endsection

@section('host')
    @if($match->event->type->name == "Online")
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            <label for="host">Team Host</label>
            {{--{!!Form::label('host', 'Team Host')!!}--}}
            {!! Form::select('host', ['' => 'Please Select A Team Host'] + $match->teams,[$mode->team_host_id], ['id' => 'host', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            {!!Form::label('p_host', 'Player Host')!!}
            {!!Form::select('p_host', ['' => 'Please Select A Player Host'] + $match->rostera->players + $match->rosterb->players, [$mode->pHost], ['class' => 'form-control'])!!}
            </div>
        </div>
    </div>
    @endif
@endsection