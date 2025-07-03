<?php
$menuItems = [
    ## Dashboard
    [
        "icon" => "fa fa-home",
        "title" => "Dashboard",
        "href" => "#",
        "itemClass" => "selected",
    ],

    ## Cadastro
    [
        "icon" => "fa fa-file-text",
        "title" => "Cadastro",
        "itemClass" => "arrow",
        "subMenus" => [
            [
                "title" => "Cliente",
                "href" => "#",
            ],
            [
                "title" => "Fornecedor",
                "href" => "#",
            ],
            [
                "title" => "Produtos",
                "href" => "#"
            ],
            [
                "title" => "Perfil de acesso",
                "href" => "#"
            ],
            [
                "title" => "Usuário",
                "href" => "#",
            ],
        ]
    ],

    ## Relatório
    [
        "icon" => "fa fa-bar-chart-o",
        "title" => "Relatório",
        "itemClass" => "arrow",
        "subMenus" => [
            [
                "title" => "Cliente",
                "href" => "#",
            ],
            [
                "title" => "Faturamento",
                "href" => "#",
            ],
            [
                "title" => "Produtos",
                "href" => "#"
            ],
        ]
    ]
]

?>

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="extra_search.html" method="POST">
                    <div class="form-container">
                        <div class="input-box">
                            <a href="javascript:;" class="remove"></a>
                            <input type="text" placeholder="Search..." />
                            <input type="button" class="submit" value=" " />
                        </div>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <?php
            foreach ($menuItems as $key => $menu):
                $menu = (object) $menu;
            ?>
                <li class="<?= $key == 0 ? "start active" : "" ?>">
                    <a href="<?= $menu->href ?? "" ?>">
                        <i class="<?= $menu->icon ?? "" ?>"></i>

                        <span class="title">
                            <?= $menu->title ?? "" ?>
                        </span>

                        <span class="<?= $menu->itemClass ?? "" ?>">
                        </span>
                    </a>
                    <?php if (isset($menu->subMenus)): ?>
                        <ul class="sub-menu">
                            <?php foreach ($menu->subMenus as $subMenu): ?>
                                <?php $subMenu = (object) $subMenu ?>
                                <li>
                                    <a href="<?= $subMenu->href ?>"><?= $subMenu->title ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>

            <?php endforeach ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->