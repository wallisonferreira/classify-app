@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @component('layouts.panel_left', [
            'user' => $user
        ])@endcomponent

        <div class="col-md-9">

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Informações do título - Fonte IMDB</h3></div>
                    </div>

                    <div class="panel-body">
                        <div class="ui five column grid">
                        <div class="ui horizontal divider"><i class="tag icon"></i>Títulos</div>

                            <div class="ui divided items">
                                <div class="item">
                                    <div class="image">
                                        <a href="{{ url('/ver/titulo/' . $title->id) }}">
                                            <img src="{{ $title->poster }}" width="150">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="{{ url('/ver/titulo/' . $title->id) }}" class="header">{{ $title->title }}</a>
                                        <div class="meta">
                                            <span class="cinema">{{ $title->network }}</span>
                                        </div>
                                        <div class="description">
                                            <p style="text-align: justify;"><strong>{{ $title->overview }}</strong></p>
                                        </div>
                                        <br/>
                                        <p><strong>Ano:<strong> {{ $title->year }} </p>
                                        <p>Assistido <strong>{{ $title->play_count }}</strong> Vezes</p>
                                        <p>Por <strong>{{ $title->watcher_count }}</strong> Pessoas</p>
                                        
                                        <div class="pull-right">
                                            <a href="{{ url('/adicionar/lista/' . $title->id) }}" class="ui icon button" data-content="Adicionar o título à lista pessoal">
                                                <i class="right list icon"></i>
                                            </a>
                                            <a href="{{ url('/adicionar/favorito/' . $title->id) }}" class="ui icon button">
                                                <i class="right favorite icon"></i>
                                            </a>
                                            <a href="{{ url('/adicionar/assistido/' . $title->id) }}" class="ui icon button">
                                                <i class="right eye icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                            <div class="ui horizontal divider"><i class="circle icon"></i></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
