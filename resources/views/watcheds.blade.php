@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @component('layouts.panel_left', [
            'user' => $user
        ])@endcomponent

        <div class="col-md-9">

            @if (session('error'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Espere!</strong> {{ session('error') }}
            </div>
            @endif

            @if (session('feedback'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Ok!</strong> {{ session('feedback') }}
            </div>
            @endif

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><h3>{{ $subject }}</h3></div>
                    </div>

                    <div class="panel-body">
                        <div class="ui five column grid">
                        <div class="ui horizontal divider"><i class="tag icon"></i>Títulos</div>
                            @foreach ($myseens as $seen)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                        <a href="{{ url('/ver/titulo/' . $seen->id) }}">
                                            <img src="{{ $seen->poster }}" width="150">
                                        </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ url('/ver/titulo/' . $seen->id) }}" class="header">{{ $seen->title }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $seen->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p style="text-align: justify;"><strong>{{ $seen->overview }}</strong></p>
                                            </div>
                                            <br/>
                                            <p>Assistido <strong>{{ $seen->play_count }}</strong> Vezes</p>
                                            <p>Por <strong>{{ $seen->watcher_count }}</strong> Pessoas</p>

                                            <div class="btn-group pull-right">
                                                <a href="{{ url('/remover/assistido/' . $seen->id) }}" class="ui icon button">
                                                    Remover<i class="ui remove icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui horizontal divider"><i class="circle icon"></i></div>         
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
