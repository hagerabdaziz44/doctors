<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="index.html">
                        <img class="brand-logo" alt="modern admin logo"
                             src="{{asset('assets/admin/images/logo/logo.png')}}">
                        <h3 class="brand-text">الرئيسية</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">مرحبا {{auth()->user()->name}}
                  <span
                      class="user-name text-bold-700"> </span>
                </span>
                <div class="dropdown-menu dropdown-menu-right">


            <form class="dropdown-item" method="GET" action="{{ route('logout','web') }}">
                @csrf
                <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"> <i class="fa fa-sign-out fa-lg"></i>تسجيل الخروج</a>
            </form>
        </div>
                         </a>

                    </li>

                      <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">
                
                     
                      @if(App::getLocale() == 'ar')
                      
                        <span
                        class="user-name text-bold-700"> اللغة العربية </span>
                     
                      
                          
                      @else
                      
                        <span
                        class="user-name text-bold-700"> English </span>
                      
                         
                      @endif
                </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>

                                <div class="dropdown-divider"></div>
                            @endforeach
                        </div>
                    </li>



                </ul>
            </div>
        </div>
    </div>
</nav>
