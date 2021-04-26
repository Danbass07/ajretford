<div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <ul class="navbar-nav mr-auto">
            <x-navigation-item :href="route('welcome')" >
                <x-navigation-label text="Aj Taxi Retford" icon="fas fa-globe" />
            </x-navigation-item>
            <x-navigation-item :href="route('bookings')" >
                <x-navigation-label text="Bookings" icon="fas fa-globe" />
            </x-navigation-item>
            @if (Route::has('login'))
            @auth
            <x-navigation-item :href="route('dashboard')" >
                <x-navigation-label text="Dashboard" icon="fas fa-globe" />
            </x-navigation-item>
            @else
            <x-navigation-item :href="route('login')" >
                <x-navigation-label text="Log in" icon="fas fa-globe" />
            </x-navigation-item>
            @if (Route::has('register'))

                            <x-navigation-item :href="route('register')" >
                <x-navigation-label text="Register" icon="fas fa-globe" />
            </x-navigation-item>
                        @endif
                        @endauth
            @endif
        </ul>
    </nav>

   <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Aj Taxi Retford</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/bookings">Bookings</a>
        </li>

      </ul>

      @if (Route::has('login'))
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
                    @auth
                        <a class="nav-link active" href="{{ url('/dashboard') }}" class="">Dashboard</a>

                    @else
                        <a href="{{ route('login') }}" class="">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">Register</a>
                        @endif
                    @endauth

            @endif

    </li>
    </ul>
  </div>
</nav> -->


</div>
