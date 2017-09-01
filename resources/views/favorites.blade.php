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
                <strong>Título Duplicado!</strong> {{ session('error') }}
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
                            @foreach ($myfavorites as $favorite)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                        <a href="{{ url('/ver/titulo/' . $favorite->id) }}">
                                            <img src="{{ $favorite->poster }}" width="150">
                                        </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ url('/ver/titulo/' . $favorite->id) }}" class="header">{{ $favorite->name }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $favorite->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p style="text-align: justify;"><strong>{{ $favorite->overview }}</strong></p>
                                            </div>
                                            <br/>
                                            <p>Assistido <strong>{{ $favorite->play_count }}</strong> Vezes</p>
                                            <p>Por <strong>{{ $favorite->watcher_count }}</strong> Pessoas</p>
                                            
                                            <div class="pull-right">
                                                <a href="{{ url('/remover/favorito/' . $favorite->id) }}" class="ui icon button">
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
