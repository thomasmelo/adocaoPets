<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Pets</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">
                    Olá {{ Auth::user()->name }}
                    |
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adocao.index') }}">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        Adoções
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pet.index') }}">
                        <i class="fa-solid fa-paw"></i>
                        Pets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cliente.index') }}">
                       <i class="fa-solid fa-users"></i>
                        Pessoas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('raca.index') }}">
                        <i class="fa-solid fa-feather-pointed"></i>
                        Raças
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('especie.index') }}">
                        <i class="fa-solid fa-seedling"></i>
                        Espécies
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
