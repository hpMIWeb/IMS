<?php
include_once("commoncss.php");
// session_start();
$userName = (isset($_SESSION['userName']) && $_SESSION['userName'] != '') ? $_SESSION['userName'] : '';
$userRoleId = (isset($_SESSION['userRole']) && $_SESSION['userRole'] != '') ? $_SESSION['userRole'] : '';

$RoleWiseMenu = array();
$superAdminMenu = array(
    array(
        "displayName" => "Dashboard",
        "redirectPage" => "./dashboard.php",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
        "icon" => "nav-icon fas fa-tachometer-alt"
        
    ),
    array(
        "displayName" => "Stock",
        "redirectPage" => "./stock.php",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
        "icon" => "nav-icon fas fa-clipboard"
    ),
    array(
        "displayName" => "Add Item",
        "redirectPage" => "list-item.php",
        "icon" => "nav-icon fas fa-plus",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "New Item Issue",
        "redirectPage" => "items-allocate.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "New Item Return",
        "redirectPage" => "items-allocate.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Defective Item Receive",
        "redirectPage" => "defactive-master.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Make Invoice",
        "redirectPage" => "invoice-list.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon fas fa-file-invoice",
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "AMC Management",
        "redirectPage" => "amc-list.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon fas fa-bars",
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Reports",
        "redirectPage" => "reports.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon fas fa-table",
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Phone Book",
        "redirectPage" => "#",
        "isHasSubMenu" => true,
        "icon" => "nav-icon fas fa-address-book",
        "submenuArray" => array(
            array(
                "displayName" => "Category",
                "redirectPage" => "category.php",
                "icon" => "nav-icon fas fa-plus"
            ),  array(
                "displayName" => "Phone book Master",
                "redirectPage" => "phonebook-master.php",
                "icon" => "nav-icon fas fa-address-book"
            ), array(
                "displayName" => "Phone book List",
                "redirectPage" => "phonebook-master-list.php",
                "icon" => "nav-icon fas fa-bars"
            ),

        ),
    ),
    /* array(
        "displayName" => "Client",
        "redirectPage" => "client-list.php",
        "isHasSubMenu" => true,
        "icon" => "nav-icon fas fa-user",
        "submenuArray" => array(
            array(
                "displayName" => "Create",
                "redirectPage" => "create-client.php",
                "icon" => "nav-icon fas fa-plus"
            ),  array(
                "displayName" => "List",
                "redirectPage" => "client-list.php",
                "icon" => "nav-icon fas fa-list"
            ),

        ),

        ),
        

    )*/
    array(
        "displayName" => "Vendor",
        "redirectPage" => "vendor-list.php",
        "isHasSubMenu" => true,
        "icon" => "nav-icon fas fa-user-secret",
        "submenuArray" => array(
            array(
                "displayName" => "Create",
                "redirectPage" => "create-vendor.php",
                "icon" => "nav-icon fas fa-plus"
            ),  array(
                "displayName" => "List",
                "redirectPage" => "vendor-list.php",
                "icon" => "nav-icon fas fa-list"
            ),

        ),
    ),
    array(
        "displayName" => "User Accounts",
        "redirectPage" => "list-item.php",
        "isHasSubMenu" => true,
        "icon" => "nav-icon fas fa-users",
        "submenuArray" => array(
            array(
                "displayName" => "Create",
                "redirectPage" => "create-users.php",
                "icon" => "nav-icon fas fa-plus"
            ),  array(
                "displayName" => "List",
                "redirectPage" => "user-list.php",
                "icon" => "nav-icon fas fa-list"
            ),

        ),

    ),
    array(
        "displayName" => "Logout",
        "redirectPage" => "logout.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon far fa-circle nav-icon",
        "submenuArray" => array(),
    ),
);

$backOfficeMenu =   array(
    array(
        "displayName" => "Dashboard",
        "redirectPage" => "./dashboard.php",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
        "icon" => "nav-icon fas fa-tachometer-alt"
    ),
    array(
        "displayName" => "Add Item",
        "redirectPage" => "list-item.php",
        "icon" => "nav-icon fas fa-plus",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "New Item Issue",
        "redirectPage" => "items-allocate.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "New Item Return",
        "redirectPage" => "items-allocate.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Defective Item Receive",
        "redirectPage" => "defactive-master.php",
        "icon" => "nav-icon fas fa-tag",
        "isHasSubMenu" => false,
        "submenuArray" => array(),
    ),

    array(
        "displayName" => "User Accounts",
        "redirectPage" => "list-item.php",
        "isHasSubMenu" => true,
        "icon" => "nav-icon fas fa-users",
        "submenuArray" => array(
            array(
                "displayName" => "Create",
                "redirectPage" => "create-users.php",
                "icon" => "nav-icon fas fa-plus"
            ),  array(
                "displayName" => "List",
                "redirectPage" => "user-list.php",
                "icon" => "nav-icon fas fa-list"
            ),

        ),

    ),
    array(
        "displayName" => "Logout",
        "redirectPage" => "logout.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon far fa-circle nav-icon",
        "submenuArray" => array(),
    ),
);

$userMenu  = array(
    array(
        "displayName" => "Invoice-Bill",
        "redirectPage" => "invoice.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon fas fa-file-invoice",
        "submenuArray" => array(),
    ),
    array(
        "displayName" => "Logout",
        "redirectPage" => "logout.php",
        "isHasSubMenu" => false,
        "icon" => "nav-icon far fa-circle nav-icon",
        "submenuArray" => array(),
    ),
);
if ($userRoleId == '1') {
    //manage Super admin Menu
    $RoleWiseMenu = $superAdminMenu;
} elseif ($userRoleId == '2') {
    //manage  back Office user Menu
    $RoleWiseMenu = $backOfficeMenu;
} else {
    //manage sales user Menu
    $RoleWiseMenu = $userMenu;
}


?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="./dashboard.php" class="brand-link">
        <img src="./assets/dist/img/Milogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">IMS</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">


                <a href="" class="d-block">

                    <?php echo $userName ?>

                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <?php
                foreach ($RoleWiseMenu as $key => $menuData) {
                    $subMenuFlag = isset($menuData['isHasSubMenu']) ? $menuData['isHasSubMenu'] : false;
                    $submenuArray = isset($menuData['submenuArray']) ? $menuData['submenuArray'] : [];
                    if ($subMenuFlag) { ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="<?php echo $menuData['icon']; ?>"></i>
                        <p>
                            <?php echo $menuData['displayName']; ?>
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php
                                foreach ($submenuArray as $key => $subMenuData) { ?>

                        <li class="nav-item">
                            <a href="<?php echo $subMenuData['redirectPage']; ?>" class="nav-link">
                                <i class="<?php echo $subMenuData['icon']; ?>"></i>
                                <p><?php echo $subMenuData['displayName']; ?></p>
                            </a>
                        </li>
                        <?php } ?>


                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a href="<?php echo $menuData['redirectPage']; ?>" class="nav-link">
                        <i class="<?php echo $menuData['icon']; ?>"></i>
                        <p>
                            <?php echo $menuData['displayName']; ?>
                        </p>
                    </a>
                </li>
                <?php }
                }
                ?>
            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>