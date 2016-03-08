@extends('layouts.frontend')
@section('title')
    {!!$event->name!!}
@stop

{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">--}}
  
@section('banner')
    <img src="images/events/cod-world-league.png" alt="" />
  <a href="#" class="photo-credit">Photograph by @somebody123</a>  
@stop

@section('content')
<header class="details">
  <div class="wrap">
    <nav class="section-nav">
      <ul>
        <li class="active"><a href="{!!'/event/' . $event->id!!}">Standings</a></li>
        <li><a href="{!!'/event/leaderboard/' . $event->id!!}">Leaderboards</a></li>
        <li><a href="{!!'/event/GameTypeStats/' . $event->id!!}">Game Type</a></li>
        <li><a href="{!!'/event/records/' . $event->id!!}">Records</a></li>
        <li><a href="{!!'/event/specialist/' . $event->id!!}">Specialists</a></li>
        <li><a href="{!!'/event/pickban/' . $event->id!!}">Pick/Bans</a></li>
        <li><a href="{!!'/event/stdev/' . $event->id!!}">STDEV Stats</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT DETAILS
================================================== -->
<section class="section gray stats event">
  <div class="wrap">
    <h3>Top Performers</h3>
    <div class="row">
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/seth-abner.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">{!!$topkd->name!!}</a></span>
          <span class="player-detail">Highest K/D<em>1.29</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/matt-haag.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">Nadeshot</a></span>
          <span class="player-detail">Most HP Caps<em>129</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/ian-porter.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="#">Crimsixian</a></span>
          <span class="player-detail">Most UL Caps<em>42</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/matthew-piper.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">Formal</a></span>
          <span class="player-detail">Time in HP<em>3:40</em></span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <table id="kdr" class="data">
              <thead>
                <tr>
                  <td>#</td>
                  <td class="title">Team Standings</td>
                  <td>Wins</td>
                  <td>Losses</td>
                  <td>Win %</td>
                  <td>Map Wins</td>
                  <td>Map Losses</td>
                  <td>K/D Ratio</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.12</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.08</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.078</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.02</td>
                </tr>
                <tr>
                  <td>5/6</td>
                  <td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.1</td>
                </tr>
                <tr>
                  <td>5/6</td>
                  <td class="title"><a href=""><img src="images/teams/team-justus.png" alt="" class="table-icon" />Team JusTus</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.03</td>
                </tr>
                <tr>
                  <td>7/8</td>
                  <td class="title"><a href=""><img src="images/teams/epsilon-esports-2.jpg" alt="" class="table-icon" />Epsilon Esports</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.03</td>
                </tr>
                <tr>
                  <td>7/8</td>
                  <td class="title"><a href=""><img src="images/teams/dream-team.png" alt="" class="table-icon" />Dream Team</a></td>
                  <td>5</td>
                  <td>0</td>
                  <td>100%</td>
                  <td>12</td>
                  <td>4</td>
                  <td>1.03</td>
                </tr>
              </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
      
  </div>

</section><!-- /event listings -->
@stop
