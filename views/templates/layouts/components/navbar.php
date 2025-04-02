<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        
    </div>
    <div class="page-main-header col">
        <div class="header-left">
            <form class="form-inline search-full col" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Admiro .." name="q" title="" autofocus="autofocus" />
                            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="form-group-header d-lg-block d-none">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative d-flex align-items-center">
                        <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100" type="text" placeholder="Recherche..." name="q" title="" /><i class="search-bg iconly-Search icli"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-right">
            <ul class="header-right">
                
                <li class="search d-lg-none d-flex">
                    <a href="javascript:void(0)">
                        <svg>
                            <use href="assets/svg/iconly-sprite.svg#Search"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="dark-mode" href="javascript:void(0)">
                        <svg>
                            <use href="assets/svg/iconly-sprite.svg#moondark"></use>
                        </svg>
                    </a>
                </li>
                <li class="profile-nav custom-dropdown">
                    <div class="user-wrap">
                        <div class="user-img"><img src="assets/images/profile.png" alt="user" /></div>
                        <div class="user-content">
                            <h6><?= getSession("user")["username"] ?></h6>
                            <p class="mb-0"><?= getSession("user")["role"] ?><i class="fa-solid fa-chevron-down"></i></p>
                        </div>
                    </div>
                    <div class="custom-menu overflow-hidden">
                        <ul class="profile-body">
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="assets/svg/iconly-sprite.svg#Login"></use>
                                </svg><a class="ms-2" href="/pressingapp/logout">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>