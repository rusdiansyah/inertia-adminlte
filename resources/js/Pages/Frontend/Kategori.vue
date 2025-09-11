<script setup>
import FrontEnd from '@/Layouts/FrontEnd.vue';
import Card from '../Components/Frontend/Card.vue';
defineOptions({
    layout: FrontEnd,
});
defineProps({
    berita: Object,
    kategori: Object,
})
</script>
<template>

    <Head :title="` | Home`" />
    <div class="content-header" style="margin-top:-30px">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ kategori.nama }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                          <i class="fas fa-home"></i>  <Link :href="route('home')">Home</Link>
                        </li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <Card :berita="berita" />
        </div>
    </div>
</template>
