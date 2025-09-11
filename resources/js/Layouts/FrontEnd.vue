<script setup>
import Footer from '@/Layouts/Footer.vue';
import MainHeader from '../Pages/Components/Frontend/MainHeader.vue';
import Carousel from '../Pages/Components/Frontend/Carousel.vue';
defineProps({
    banner:Object,
})
</script>
<template>

    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <MainHeader />

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container">
                        <Carousel :banner="banner" />
                    </div>
                </div>

                <div class="content">
                    <div class="container">
                        <slot />
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    </body>
</template>
