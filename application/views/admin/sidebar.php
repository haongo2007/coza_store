<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-content scroll-scrolly_visible" style="position: relative;">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="<?php echo admin_url() ?>">
                  <img src="<?php echo public_url('admin') ?>/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
              $action = $this->uri->rsegment(1);
            ?>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'home') ? 'active' : '' ?> " href="<?php echo admin_url() ?>">
                                <i class="ni ni-tv-2 text-primary"></i><span class="nav-link-text">Bảng Điều Khiển</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'transaction') ? 'active' : '' ?>" href="<?php echo admin_url('transaction') ?>">
                                <i class="ni ni-cart text-pink"></i><span class="nav-link-text">Giao Dịch</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'product') ? 'active' : '' ?>" href="<?php echo admin_url('product') ?>">
                                <i class="ni ni-app text-red"></i><span class="nav-link-text">Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'theme') ? 'active' : '' ?>" href="<?php echo admin_url('theme') ?>">
                                <i class="ni ni-shop text-orange"></i><span class="nav-link-text">Giao Diện</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'category') ? 'active' : '' ?>" href="<?php echo admin_url('category') ?>">
                                <i class="ni ni-archive-2 text-blue"></i><span class="nav-link-text">Danh Mục</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'brand') ? 'active' : '' ?>" href="<?php echo admin_url('brand') ?>">
                                <i class="ni ni-check-bold text-yellow"></i><span class="nav-link-text">Nhãn Hiệu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'admin') ? 'active' : '' ?>" href="<?php echo admin_url('admin') ?>">
                                <i class="ni ni-single-02 text-green"></i><span class="nav-link-text">Quản Trị Viên</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($action == 'slide' or $action == 'info') ? 'active' : '' ?> " data-toggle="collapse" role="button" aria-expanded="<?php echo ($action == 'slide' or $action == 'info') ? 'true' : 'false' ?>" aria-controls="navbar-general-setting" href="#navbar-general-setting"> <i class="ni ni-settings-gear-65 text-blue"></i><span class="nav-link-text">Cài Đặt Chung</span>
                            </a>
                            <div class="collapse <?php echo ($action == 'slide' or $action == 'info') ? 'show' : '' ?>" id="navbar-general-setting">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?php echo admin_url('slide') ?>" class="nav-link">Tài Nguyên</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo admin_url('info') ?>" class="nav-link">Thông Tin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo admin_url('payment') ?>" class="nav-link">Thanh Toán</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        <div class="scroll-element scroll-y scroll-scrollx_visible scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 468px; top: 0px;"></div></div></div>
    </div>
</nav>