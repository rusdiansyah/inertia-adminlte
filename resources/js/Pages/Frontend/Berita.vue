<script setup>
import FrontEnd from '@/Layouts/FrontEnd.vue';
import CardDetail from '../Components/Frontend/CardDetail.vue';
defineOptions({
    layout: FrontEnd,
});
defineProps({
    berita: Object,
    beritaTerkait: Object,
})
</script>
<template>

    <Head :title="` | Home`" />
    <div class="content-header" style="margin-top:-30px">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <i class="fas fa-home"></i>
                            <Link :href="route('home')">Home</Link>
                        </li>
                        <li class="breadcrumb-item active">Detail Berita</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col-md-9 pb-3">
                <CardDetail :berita="berita" />
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;" :class="$page.props.cardColor">
                    <div class="card-header">
                        Link Terkait
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="bt in beritaTerkait" :key="bt.id">
                           <Link :href="route('berita-detail',bt.slug)">
                            {{ bt.judul }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
