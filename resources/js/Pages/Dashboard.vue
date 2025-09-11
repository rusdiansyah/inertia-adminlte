<script setup>
import '/public/assets/js/pages/dashboard3.js';
import Berita from '../Pages/Dashboard/Berita.vue';
import SmallBox from './Components/SmallBox.vue';
const props = defineProps({
    berita: Object,
    jmlUser: String,
    jmlKategori: String,
    jmlBerita:String,
    jmlBanner:String,
});
</script>
<template>
    <Head :title="props.title" />
    <div class="row">
        <SmallBox bg="bg-info" routeName="user.index" :jmlData="jmlUser" judul="User" icon="ion-person-add" />
        <SmallBox bg="bg-success" routeName="kategori.index" :jmlData="jmlKategori" judul="Kategori" icon="ion-bag" />
        <SmallBox bg="bg-warning" routeName="berita.index" :jmlData="jmlBerita" judul="Berita" icon="ion-clipboard" />
        <SmallBox bg="bg-danger" routeName="banner.index" :jmlData="jmlBanner" judul="Banner" icon="ion-edit" />
    </div>

    <Berita :berita="berita" />
</template>
