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
    <div class="card mb-3">
        <img :src="'/storage/' + berita.gambar" class="card-img-top" :alt="berita.judul">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ berita.judul }}</h5>
            <p class="card-text" v-html="berita.isi"></p>
        </div>
        <div class="card-footer">
            <small class="text-muted">
            <i class="fas fa-user"></i>{{ berita.user.name }}
            <i class="fas fa-calendar"></i> {{ getDate(berita.created_at) }}
            <i class="fas fa-tag"></i> {{ berita.kategori.nama }}
            </small>
        </div>
    </div>
</template>
