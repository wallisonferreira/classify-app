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
                            @foreach ($watcheds as $watched)
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
                                                <p>{{ $watched->overview }}</p>
                                            </div>
                                            
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
