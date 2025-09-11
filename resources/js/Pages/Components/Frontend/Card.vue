<script setup>
defineProps({
    berita: Object,
})
const getDate = (date) =>
    new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
</script>
<template>
    <div class="card m-1" style="width: 22.9rem;" v-for="row in berita" :key="row.id">
        <img :src="'/storage/' + row.gambar" class="card-img-top" :alt="row.judul">
        <div class="card-body">
            <span class="badge badge-success">
                <i class="fas fa-user"></i> {{ row.user.name }}
            </span>
            <span class="badge badge-success ml-1">
                <i class="fas fa-calendar"></i> {{ getDate(row.created_at) }}
            </span>
            <h5 class="card-title pt-2">{{ row.judul }}</h5>
        </div>
        <div class="card-footer">
            <Link :href="route('kategori-berita', row.kategori.slug)" class="btn btn-info float-left">
            <i class="fas fa-tag"></i> {{ row.kategori.nama }}
            </Link>
            <Link :href="route('berita-detail', row.slug)" class="btn btn-primary float-right">
            <i class="fas fa-align-justify"></i> Selengapnya ...
            </Link>
        </div>
    </div>
</template>
