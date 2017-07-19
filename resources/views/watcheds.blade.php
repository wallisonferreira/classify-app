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
                            @foreach ($myseens as $seen)
                                <div class="ui divided items">
                                    <div class="item">
                                        <div class="image">
                                        <img src="{{ $seen->poster }}" width="150">
                                        </div>
                                        <div class="content">
                                            <a class="header">{{ $seen->name }}</a>
                                            <div class="meta">
                                                <span class="cinema">{{ $seen->network }}</span>
                                            </div>
                                            <div class="description">
                                                <p>{{ $seen->overview }}</p>
                                            </div>
                                            <div class="extra">
                                                <a href="{{ url('/remover/assistido/' . $seen->id) }}" class="ui right floated primary button">
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
