<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="text-center">
                            Liga
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover" >
                                <thead>
                                <th>
                                    Team
                                </th>
                                <th>
                                    User
                                </th>
                                <th>
                                    Spiele
                                </th>
                                <th>
                                    S
                                </th>
                                <th>
                                    U
                                </th>
                                <th>
                                    N
                                </th>
                                <th>
                                    T
                                </th>
                                <th>
                                    GT
                                </th>
                                <th>
                                    TD
                                </th>
                                <th>
                                    P
                                </th>
                                </thead>
                                <tbody>
                                @foreach($cards as $card)
                                        <tr>
                                            <td>
                                                {!! $card->team->name !!}
                                            </td>
                                            <td>
                                                {!! $card->team->user->username !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->totalgames !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->wins !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->draws !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->loses !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->goals !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->owngoals !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->goals-$card->statistic->owngoals !!}
                                            </td>
                                            <td>
                                                {!! $card->statistic->points !!}
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="text-center">
                        Paarungen der Liga
                    </h3>
                </div>
                <div class="panel-body">
                    <?php use App\Team;$count = 0 ?>
                    <div class="table-responsive">
                        <table class="table table-hover" >
                            <thead>
                            <th>
                                Heim
                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                            <th>
                                Auswärts
                            </th>
                            </thead>
                            @foreach($tour->matchings as $match)
                                <?php

                                $teamA='-';
                                if(Team::find($match->teamA)){
                                $teamA= Team::find($match->teamA)->name;
                                }
                                $teamB='-';
                                if(Team::find($match->teamB)){
                                $teamB=Team::find($match->teamB)->name;
                                }
                                ?>
                                    @if($tour->owner == Auth::id() && $tour->status == 1 && $match->goalB == -1)
                                        <tr>
                                            {!! Form::open(array('url' => 'saveMatch')) !!}
                                            <td>
                                                {!!$teamA !!}
                                            </td>
                                            <td>
                                                @if($match->goalB == -1)
                                                    {!! Form::number('goalA',null,['class'=>'form-control','min'=>0]) !!}
                                                @else
                                                    {!! Form::number('goalA',$match->goalA,['class'=>'form-control','min'=>0]) !!}
                                                @endif
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                @if($match->goalB == -1)
                                                    {!! Form::number('goalB',null,['class'=>'form-control','min'=>0]) !!}
                                                @else
                                                    {!! Form::number('goalB',$match->goalB,['class'=>'form-control','min'=>0]) !!}
                                                @endif
                                            </td>
                                            <td>
                                                {!!$teamB !!}
                                            </td>
                                            <td>
                                                {!! Form::hidden('match_id', $match->id) !!}
                                                {!! Form::button('<i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'style' => '', 'id' => ''] ) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                {!! $teamA !!}
                                            </td>
                                            <td class="text-right">
                                                @if($match->goalB != -1)
                                                    {!! $match->goalA !!}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td class="text-left">
                                                @if($match->goalB != -1)
                                                    {!! $match->goalB !!}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                {!!$teamB !!}
                                            </td>
                                        </tr>
                                    @endif
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
</div>