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
                                            
                                            <div class="extra">
                                                <a href="{{ url('/adicionar/lista/' . $watched->id) }}" class="ui right floated primary button">
                                                    Adicionar à lista
                                                    <i class="right chevron icon"></i>
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
