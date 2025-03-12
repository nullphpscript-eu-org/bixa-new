<!-- Begin page -->
<div id="layout-wrapper">    
    <!-- Topbar -->
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="<?= base_url().'/admin' ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= $this->base->get_favicon() ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= $this->base->get_slogo() ?>" alt="" height="24">
                        </span>
                    </a>

                    <a href="<?= base_url().'/admin' ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= $this->base->get_favicon() ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= $this->base->get_slogo() ?>" alt="" height="24">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= base_url() ?>" class="btn btn-primary"><i data-feather="eye" class="icon-lg layout-mode-dark"></i> View Website</a>
                <!-- Theme Toggle Button -->
                <div class="dropdown">
                    <button type="button" class="btn header-item" id="mode-setting-btn">
                        <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                        <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                    </button>
                </div>

                <!-- User Menu -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="<?= $this->admin->get_avatar() ?>" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= $this->admin->get_name() ?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?= base_url() ?>admin/settings">
                            <i class="mdi mdi-cog font-size-16 align-middle me-1"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>a/logout">
                            <i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Left Sidebar -->
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <!-- Dashboard -->
                    <li class="<?php if (isset($active) && $active == 'home') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Clients -->
                    <li class="<?php if (isset($active) && $active == 'client') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>client/list">
                            <i data-feather="users"></i>
                            <span>My Clients</span>
                        </a>
                    </li>

                    <!-- MOFH Accounts -->
                    <li class="<?php if (isset($active) && $active == 'account') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/account/list">
                            <i data-feather="server"></i>
                            <span>MOFH Accounts</span>
                        </a>
                    </li>

                    <!-- Support Tickets -->
                    <li class="<?php if (isset($active) && $active == 'ticket') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/ticket/list">
                            <i data-feather="message-square"></i>
                            <span>Support Tickets</span>
                        </a>
                    </li>

                    <li class="menu-title">Content Management</li>

                    <!-- HTML Content -->
                    <li class="<?php if (isset($active) && $active == 'html') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/html">
                            <i data-feather="code"></i>
                            <span>HTML Content</span>
                        </a>
                    </li>

                    <!-- Ads Management -->
                    <li class="<?php if (isset($active) && $active == 'ads') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/ads">
                            <i data-feather="dollar-sign"></i>
                            <span>Manage Ads</span>
                        </a>
                    </li>

                    <li class="menu-title">Settings</li>

                    <!-- Site Settings -->
                    <li class="<?php if (isset($active) && $active == 'site_settings') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>admin/site">
                            <i data-feather="settings"></i>
                            <span>Site Settings</span>
                        </a>
                    </li>

                    <!-- API Settings -->
                    <li class="<?php if (isset($active) && $active == 'api_settings') : ?>mm-active<?php endif ?>">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="code"></i>
                            <span>API Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url() ?>api/settings/mofh">MOFH Settings</a></li>
                            <li><a href="<?= base_url() ?>api/settings/sitepro">SitePro Settings</a></li>
                        </ul>
                    </li>

                    <!-- Email Settings -->
                    <li class="<?php if (isset($active) && $active == 'email_settings') : ?>mm-active<?php endif ?>">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="mail"></i>
                            <span>Email Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url() ?>api/settings/smtp">SMTP Settings</a></li>
                            <li><a href="<?= base_url() ?>email/templates">Email Templates</a></li>
                        </ul>
                    </li>

                    <!-- Security Settings -->
                    <li class="<?php if (isset($active) && strpos($active, '_settings') !== false) : ?>mm-active<?php endif ?>">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="shield"></i>
                            <span>Security</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url() ?>api/settings/ssl">SSL Settings</a></li>
                            <li><a href="<?= base_url() ?>api/settings/captcha">Captcha Settings</a></li>
                            <li><a href="<?= base_url() ?>api/settings/oauth">OAuth Settings</a></li>
                        </ul>
                    </li>

                    <!-- Domain Management -->
                    <li class="<?php if (isset($active) && $active == 'domain') : ?>mm-active<?php endif ?>">
                        <a href="<?= base_url() ?>domain/list">
                            <i data-feather="globe"></i>
                            <span>Domain Extensions</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>