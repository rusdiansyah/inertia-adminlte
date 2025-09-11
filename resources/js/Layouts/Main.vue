<script setup>
import ContentHeader from './ContentHeader.vue';
import Footer from './Footer.vue';
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';
</script>
<template>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <Navbar />
            <Sidebar />

            <div class="content-wrapper">
                <ContentHeader />
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="col-12">
                            <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> {{ $page.props.flash.message }}</h5>
                            </div>
                        </div>
                        <slot />
                    </div>
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            </aside>

            <!-- Main Footer -->
            <Footer />
        </div>
    </body>
</template>
