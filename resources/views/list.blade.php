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
                            @foreach ($mylist as $list)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                            <a href="{{ url('/ver/titulo/' . $list->id) }}">
                                                <img src="{{ $list->poster }}" width="150">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ url('/ver/titulo/' . $list->id) }}" class="header">{{ $list->title }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $list->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p style="text-align: justify;"><strong>{{ $list->overview }}</strong></p>
                                            </div>
                                            <br/>
                                            <p>Assistido <strong>{{ $list->play_count }}</strong> Vezes</p>
                                            <p>Por <strong>{{ $list->watcher_count }}</strong> Pessoas</p>

                                            <div class="pull-right">
                                                <a href="{{ url('/remover/lista/' . $list->id) }}" class="ui icon button">
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
