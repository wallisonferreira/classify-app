<div class="col-md-3">
    <row>
        <div class="ui card">
            <div class="image">
                <!--<img src="{{-- asset('img/perfil_padrao.jpg') --}}">-->
            </div>
            <div class="content">
                <a class="header">{{ $user->name }}</a>
                <div class="meta">
                <span class="date">Criado em: {{  date_format($user->created_at, 'd-m-Y H:i:s') }}</span>
                </div>
                <div class="description">
                Membro comum
                </div>
            </div>
            <!--<div class="extra content">
                <a>
                <i class="user icon"></i>
                22 Friends
                </a>
            </div>-->
        </div>
    </row>
    &nbsp
    <row>
        <div class="panel panel-default">
            <div class="panel-heading">Acervo</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="{{ url('/') }}" class="list-group-item">Início<i class="pull-right home icon"></i></a>
                    <a href="{{ url('/lista') }}" class="list-group-item">Lista Pessoal<i class="pull-right list icon"></i></a>
                    <a href="{{ url('/favoritos') }}" class="list-group-item">Favoritos<i class="pull-right favorite icon"></i></a>
                    <a href="{{ url('/assistidos') }}" class="list-group-item">Assistidos<i class="pull-right eye icon"></i></a>
                </div>
            </div>
        </div>
    </row>
</div>
