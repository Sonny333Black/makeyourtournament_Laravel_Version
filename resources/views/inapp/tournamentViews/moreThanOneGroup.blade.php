<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @for ($i = 0; $i < $tour->countGroups; $i++)
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="text-center">
                            Gruppe {!! $i+1 !!}
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
                                    @if($card->groupNumber === $i+1)
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
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="text-center">
                            Paarungen Gruppe {!! $i+1 !!}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php $count = 0 ?>
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
                                @foreach($tour->matchings->where('round_id',1) as $match)
                                    <?php
                                    $haveMatch= false;
                                    $teamA="-";
                                    $teamB="-";
                                    ?>

                                    @foreach($tour->groupCards as $card)
                                        @if($card->groupNumber === $i+1)
                                            <?php
                                            if($match->teamA == $card->team->id){
                                                $teamA=$card->team->name;
                                                $haveMatch=true;
                                            }
                                            if($match->teamB == $card->team->id){
                                                $teamB=$card->team->name;
                                            }
                                            ?>
                                        @endif
                                    @endforeach
                                    @if($haveMatch)
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
                                    @endif
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        @endfor
    </div>

    <div class="col-md-1"></div>
</div>
@if($tour->status == 3)
    @include('inapp/tournamentViews/tournamentKO')
@endif