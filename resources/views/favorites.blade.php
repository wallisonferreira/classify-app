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
                            @foreach ($mylist as $list)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                        <img src="{{ $list->poster }}" width="150">
                                        </div>
                                        <div class="content">
                                            <a class="header">{{ $list->name }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $list->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p>{{ $list->overview }}</p>
                                            </div>
                                            <div class="extra">
                                                <a href="{{ url('/remover/lista/' . $list->id) }}" class="ui right floated primary button">
                                                    Remover da lista
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
