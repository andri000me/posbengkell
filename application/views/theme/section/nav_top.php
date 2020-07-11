<style>
    .notification {
      color: white;
      text-decoration: none;
      padding: 15px 26px;
      position: relative;
      display: inline-block;
      border-radius: 2px;
    }

    .notification .badge {
      position: absolute;
      top: 10px;
      right: 0px;
      border-radius: 50%;
      background: red;
      color: white;
    }
</style>
<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);">
        <span class="feather-icon" style="color: black"><i data-feather="menu"></i></span>
    </a>
    <a class="d-flex auth-brand" href="<?= base_url(); ?>">
        <img class="brand-img" src="<?= base_url(); ?>assets_new/img/logo.png" alt="brand" width="50px"/>
    </a>
    <ul class="navbar-nav hk-navbar-content order-xl-2">
        <!-- <li class="nav-item">
            <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
        </li> -->
        <li class="nav-item">
            <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"style="color: black"><i data-feather="settings"></i></span></a>
        </li>
        <li class="nav-item dropdown dropdown-notifications">
            <a class="nav-link dropdown-toggle no-caret notification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span style="color: black;" class="feather-icon bell"><i data-feather="bell"></i></span>
                <span class="badge" id="count_notif">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
                <div class="notifications-nicescroll-bar" id="content_notification">                    
                </div>
            </div>
        </li>
        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            <img src="<?=base_url()?>assets_new/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>

                    <div class="media-body">
                        <span   style="color: black"><?php echo $this->session->userdata('userdata')[0]->username; ?><i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <!-- <a class="dropdown-item" href="profile.html"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a>
                <a class="dropdown-item" href="inbox.html"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a>
                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                <div class="dropdown-divider"></div>
                <div class="sub-dropdown-menu show-on-hover">
                    <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                    <div class="dropdown-menu open-left-side">
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
                    </div>
                </div> -->
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="<?=base_url('logout')?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
            </div>
        </li>
    </ul>
</nav>
