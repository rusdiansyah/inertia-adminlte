<script setup>
import NavItem from './NavItem.vue';
const config = ["Setting", "Banner/Index", "User/Index"];
const berita = ["Kategori/Index", "Berita/Index"];
</script>

<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
            <img src="/public/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text font-weight-light">
                {{ $page.props.appName }}
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/public/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
                </div>
                <div class="info">
                    <Link :href="route('profile')" class="d-block">{{ $page.props.auth.user.name }}</Link>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavItem routeName="dashboard" componentName="Dashboard" icon="fa-tachometer-alt">
                        Dashboard
                    </NavItem>
                    <li class="nav-item" :class="{'menu-open' : config.includes($page.component) }">
                        <a href="#" class="nav-link" :class="{'active' : config.includes($page.component) }">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Config
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <NavItem routeName="setting.index" componentName="Setting" icon="fa-laptop-code">
                                Setting
                            </NavItem>
                            <NavItem routeName="banner.index" componentName="Banner/Index" icon="fa-file-alt">
                                Banner
                            </NavItem>
                            <NavItem routeName="user.index" componentName="User/Index" icon="fa-user-group">
                                User
                            </NavItem>
                        </ul>
                    </li>

                    <li class="nav-item" :class="{'menu-open' : berita.includes($page.component) }">
                        <a href="#" class="nav-link" :class="{'active' : berita.includes($page.component) }">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Berita
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <NavItem routeName="kategori.index" componentName="Kategori/Index" icon="fa-circle">
                                Kategori
                            </NavItem>
                            <NavItem routeName="berita.index" componentName="Berita/Index" icon="fa-circle">
                                Berita
                            </NavItem>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>
