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
                        <div class="panel-title"><h3>{{ $subject }} - Fonte IMDB</h3></div>
                    </div>

                    <div class="panel-body">
                        <div class="ui five column grid">
                            @foreach ($most_watcheds as $watched)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                        <img src="{{ $watched->poster }}" width="150">
                                        </div>
                                        <div class="content">
                                            <a class="header">{{ $watched->name }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $watched->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p style="text-align: justify;"><strong>{{ $watched->overview }}</strong></p>
                                            </div>
                                            <br/>
                                            <p>Assistido <strong>{{ $watched->play_count }}</strong> Vezes</p>
                                            <p>Por <strong>{{ $watched->watcher_count }}</strong> Pessoas</p>
                                            
                                            <div class="btn-group pull-right">
                                                <a href="{{ url('/adicionar/lista/' . $watched->id) }}" class="btn btn-default">
                                                    <i class="right list icon"></i>
                                                </a>
                                                <a href="{{ url('/adicionar/favorito/' . $watched->id) }}" class="btn btn-default">
                                                    <i class="right favorite icon"></i>
                                                </a>
                                                <a href="{{ url('/adicionar/assistido/' . $watched->id) }}" class="btn btn-default">
                                                    <i class="right eye icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>         
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
