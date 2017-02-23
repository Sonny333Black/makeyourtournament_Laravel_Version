@if($tour->owner == Auth::id() && $tour->status == 2)
    <tr>
        {!! Form::open(array('url' => 'saveMatchKO')) !!}
        <td>
            @if(\App\Team::find($match->teamA))
                {!! \App\Team::find($match->teamA)->name.' ('. \App\Team::find($match->teamA)->user->username .')' !!}
            @else
                -
            @endif
        </td>
        <td>
            @if($match->goalB == -1 && $match->teamA != -1 && $match->teamB != -1)
                {!! Form::number('goalA',null,['class'=>'form-control','min'=>0]) !!}
            @else
                @if($match->goalA != -1)
                    {!! $match->goalA !!}
                @endif
            @endif
        </td>
        <td>
            :
        </td>
        <td>
            @if($match->goalB == -1 && \App\Team::find($match->teamA) && \App\Team::find($match->teamB))
                {!! Form::number('goalB',null,['class'=>'form-control','min'=>0]) !!}
            @else
                @if($match->goalB != -1)
                    {!! $match->goalB !!}
                @endif
            @endif
        </td>
        <td>
            @if(\App\Team::find($match->teamB))
                {!! \App\Team::find($match->teamB)->name.' ('. \App\Team::find($match->teamB)->user->username .')' !!}
            @else
                -
            @endif
        </td>
        @if($match->goalA == -1||$match->goalB == -1)
        <td>
@if(\App\Team::find($match->teamA) && \App\Team::find($match->teamB))
            {!! Form::hidden('match_id', $match->id) !!}
            {!! Form::button('<i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'style' => '', 'id' => ''] ) !!}
            {!! Form::close() !!}
@endif
        </td>
        @endif
    </tr>
@else
    <tr>
        <td>
            @if(\App\Team::find($match->teamA))
                {!! \App\Team::find($match->teamA)->name.' ('. \App\Team::find($match->teamA)->user->username .')' !!}
                @else
                -
            @endif
        </td>
        <td>
            @if($match->goalB != -1)
                {!! $match->goalA !!}
            @else
                -
            @endif
        </td>
        <td>
            :
        </td>
        <td>
            @if($match->goalB != -1)
                {!! $match->goalB !!}
            @else
                -
            @endif
        </td>
        <td>
            @if(\App\Team::find($match->teamB))
                {!! \App\Team::find($match->teamB)->name.' ('. \App\Team::find($match->teamB)->user->username .')' !!}
            @else
                -
            @endif
        </td>
    </tr>
@endif