    <!-- Page sidebar start-->
    <aside class="page-sidebar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div class="main-sidebar" id="main-sidebar">
            <ul class="sidebar-menu" id="simple-bar">
                <li class="pin-title sidebar-main-title">
                    <div>
                        <h5 class="sidebar-title f-w-700">Pinned</h5>
                    </div>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h5 class="lan-1 f-w-700 sidebar-title">General</h5>
                    </div>
                </li>

                <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i>
                    <a class="sidebar-link" href="/pressingapp">
                        <svg class="stroke-icon">
                            <use href="assets/svg/iconly-sprite.svg#Paper"></use>
                        </svg>
                        <h6 class="f-w-600">Facturation </h6>
                    </a>
                </li>
                <?php if($_SESSION["user"]["role"] === "admin"):?>
                <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i>
                    <a class="sidebar-link" href="/pressingapp/reporting">
                        <svg class="stroke-icon">
                            <use href="assets/svg/iconly-sprite.svg#Paper"></use>
                        </svg>
                        <h6 class="f-w-600">Rapport </h6>
                    </a>
                </li>
                
                <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i>
                    <a class="sidebar-link" href="/pressingapp/users_manage">
                        <svg class="stroke-icon">
                            <use href="assets/svg/iconly-sprite.svg#Profile"></use>
                        </svg>
                        <h6 class="f-w-600">Gestion utilisateurs </h6>
                    </a>
                </li>
                <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i>
                    <a class="sidebar-link" href="javascript:void(0)">
                        <svg class="stroke-icon">
                            <use href="assets/svg/iconly-sprite.svg#Setting"></use>
                        </svg>
                        <h6 class="f-w-600">Configurations</h6><i class="iconly-Arrow-Right-2 icli"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li> <a href="/pressingapp/config_manage">Produits & services</a></li>
                    </ul>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </aside>
    <!-- Page sidebar end-->