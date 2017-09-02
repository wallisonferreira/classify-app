<div class="col-md-3">
    <row>
        <div class="ui card">
            <div class="content">
                <img class="ui avatar image large" src="{{ asset('img/user_perfil.png') }}" width="42">{{ $user->name }}
            </div>
                <div class="content">
                    <div class="meta">
                    <span class="date">Criado em: {{  date_format($user->created_at, 'd-m-Y') }}</span>
                    </div>
                    <div class="content">
                    @if (Auth::user()->curador == 1)
                        <div>Membro Curador<i class="spy icon large pull-right"></i></div>
                    @else
                        <div>Membro Comum<i class="user icon large pull-right"></i></div>
                    @endif
                    </div>
                </div>
        </div>
    </row>
    &nbsp
    <row class="ui sticky">
        <div class="panel panel-default">
            <div class="panel-heading">Acervo</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="{{ url('/') }}" class="list-group-item">Início<i class="pull-right home icon large"></i></a>
                    <a href="{{ url('/lista') }}" class="list-group-item">Lista Pessoal<i class="pull-right list icon large"></i></a>
                    <a href="{{ url('/favoritos') }}" class="list-group-item">Favoritos<i class="pull-right favorite icon large"></i></a>
                    <a href="{{ url('/assistidos') }}" class="list-group-item">Assistidos<i class="pull-right eye icon large"></i></a>
                </div>
            </div>
        </div>
    </row>
</div>
