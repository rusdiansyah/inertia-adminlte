<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    title: String,
    data: Object,
});

</script>
<template>
    <Head :title="title" />
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">{{ title }}</h3>
                <div class="card-tools">
                    <Link :href="route('kategori.create')" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah</Link>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Aktif</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in data" :key="row.id">
                            <td>{{ row.nama }}</td>
                            <td>
                                <i v-if="row.isActive" class="fas fa-check text-success"></i>
                            </td>
                            <td>
                                <Link :href="route('kategori.edit',row.id)" class="btn btn-info btn-xs p-1 m-1"><i class="fas fa-edit"></i>Edit</Link>
                                <Link :href="route('kategori.destroy',row.id)" method="DELETE" class="btn btn-danger btn-xs p-1 m-1"><i class="fas fa-trash"></i>Delete</Link>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div><!-- /.card -->
    </div>
</template>
