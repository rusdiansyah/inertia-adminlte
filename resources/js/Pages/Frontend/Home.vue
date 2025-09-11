<script setup>
import FrontEnd from '@/Layouts/FrontEnd.vue';
import Card from '../Components/Frontend/Card.vue';
defineOptions({
    layout: FrontEnd,
});
defineProps({
    berita: Object,
})
</script>
<template>

    <Head :title="` | Home`" />
    <div class="col-12 pb-4">
        <div class="row">
            <Card :berita="berita" />
        </div>
    </div>
</template>
