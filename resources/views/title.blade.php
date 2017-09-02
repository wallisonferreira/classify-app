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
                                        <div class="ui items">
                                            <a href="{{ url('/adicionar/lista/' . $title->id) }}" class="ui icon button" data-content="Adicionar o título à lista pessoal">
                                                <i class="right add icon"></i>
                                            </a>
                                            <a href="{{ url('/adicionar/favorito/' . $title->id) }}" class="ui icon button">
                                                <i class="right favorite icon"></i>
                                            </a>
                                            <a href="{{ url('/adicionar/assistido/' . $title->id) }}" class="ui icon button">
                                                <i class="right eye icon"></i>
                                            </a>
                                        </div>
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
                                        <p>Assistido Por <strong>{{ $title->watcher_count }}</strong> Pessoas</p>
                                        <p><strong>Gênero: </strong>{{ $title->genre }}</p>
                                        <p><strong>Diretor: </strong>{{ $title->director }}</p>
                                        <p><strong>Escrito por: </strong>{{ $title->writer }}</p>
                                        <p><strong>Premiações: </strong>{{ $title->awards }}</p>

                                    </div>
                                </div>
                            </div>         
                            <div class="ui horizontal divider"><i class="comment outline icon"></i></div>
                                <form action="{{ url('/adicionar/comentario/' . $title->id) }}" method="get" class="ui form">
                                    <div class="field">
                                        <textarea name="texto" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="ui blue labeled icon button">
                                        <i class="icon edit"></i> Publicar
                                    </button>
                                </form>
                                <div class="ui comments">
                                    <h3 class="ui dividing header">Comentários</h3>
                                    @if ($title->comments->count() == 0)
                                        <h3>Não tem comentários</h3>
                                    @else
                                        @foreach ($title->comments as $comment)
                                        <div class="comment">
                                            <a class="avatar">
                                            <img src="{{ asset('img/user_perfil.png') }}" width="42">
                                            </a>
                                            <div class="content">
                                            <a class="author">{{ $comment->user->name }}</a>
                                            <div class="metadata">
                                                <span class="date">{{ $comment->created_at  }}</span>
                                            </div>
                                            <div class="text">
                                                {{ $comment->texto }}
                                            </div>
                                            <div class="actions">
                                                <a href="{{ url('/remover/comentario/' . $comment->id . '/' . Auth::user()->id . '/' . $title->id) }}" class="remove">Remover</a>
                                            </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    

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
