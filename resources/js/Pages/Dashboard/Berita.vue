<script setup>
defineProps ({
    berita: Object
})
</script>
<template>
    <div class="row">
        <div class="col-12">
            <div class="card" :class="$page.props.cardColor">
                <div class="card-header border-0">
                    <h3 class="card-title">Berita Terpopuler</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pembuat</th>
                                <th>Publish</th>
                                <th>Visit</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in berita" :key="row.id">
                                <td>
                                    <img :src="'/storage/'+row.gambar" alt="{{ row.judul }}"
                                        class="img-circle img-size-32 mr-2" />
                                    {{ row.judul }}
                                </td>
                                <td>{{ row.kategori.nama }}</td>
                                <td>{{ row.user.name }}</td>
                                <td>
                                    <i v-if="row.isPublish" class="fas fa-check text-success"></i>
                                </td>
                                <td>
                                    <small class="text-success mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        12%
                                    </small>
                                    {{ row.diklik }}
                                </td>
                                <td>
                                    <a :href="'/berita-detail/'+row.slug" class="text-muted" target="_blank">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
</template>
