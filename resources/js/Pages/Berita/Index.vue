<script setup>
import { ref, watch, computed } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { debounce } from "lodash";

const props = defineProps({
    title: String,
    data: Object,
    searchTerm: String,
    listKategori: Object,
    filterKategori: String,
});

const form = useForm({
    filterKategori: props.filterKategori, // Tambahkan prop untuk nilai filter awal
    search: props.searchTerm,
});

watch(
    () => form.search,
    debounce(() => {
        router.get(
            "berita",
            { search: form.search, filterKategori: form.filterKategori },
            { preserveState: true, preserveScroll: true }
        );
    }, 500)
);

watch(
    () => form.filterKategori,
    () => {
        router.get(
            "berita",
            { search: form.search, filterKategori: form.filterKategori },
            { preserveState: true, preserveScroll: true }
        );
    }
);

const change = (e) => {
    router.get(route("berita.publishUpdate", e));
};

const confirmDelete = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        router.delete(route("berita.destroy", id));
    }
};
// Logika Bulk Delete
const selectedIds = ref([]);
const allSelected = computed({
    get() {
        return props.data.length > 0 && selectedIds.value.length === props.data.length;
    },
    set(value) {
        if (value) {
            selectedIds.value = props.data.map((row) => row.id);
        } else {
            selectedIds.value = [];
        }
    },
});

const toggleAll = () => {
    allSelected.value = !allSelected.value;
};

const bulkDelete = () => {
    if (selectedIds.value.length === 0) {
        alert("Pilih setidaknya satu item untuk dihapus.");
        return;
    }
    if (
        confirm(
            `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} data yang dipilih?`
        )
    ) {
        router.post(
            route("berita.bulkDestroy"),
            { ids: selectedIds.value },
            {
                onSuccess: () => {
                    selectedIds.value = []; // Reset setelah berhasil
                },
            }
        );
    }
};
</script>
<template>

    <Head :title="props.title" />
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">{{ props.title }}</h3>
                <div class="card-tools">
                    <Link :href="route('berita.create')" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah</Link>
                    <button v-if="selectedIds.length > 0" @click="bulkDelete" class="btn btn-danger btn-sm m-2">
                        <i class="fas fa-trash"></i> Hapus {{ selectedIds.length }} Item
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="col-md-3 float-left">
                    <select class="form-control" v-model="form.filterKategori">
                        <option value="">-Filter Kategori-</option>
                        <option v-for="kategori in listKategori" :key="kategori.id" :value="kategori.id">
                            {{ kategori.nama }}
                        </option>
                    </select>
                </div>
                <div class="col-md-3 float-right">
                    <input type="search" v-model="form.search" class="form-control" placeholder="Pencarian..." />
                </div>

                <table class="table table-striped table-valign-middle table-hover">
                    <thead>
                        <tr>
                            <th width="10">
                                <input type="checkbox" v-model="allSelected" />
                            </th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Publish</th>
                            <th>User</th>
                            <th>Visit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in data" :key="row.id">
                            <td>
                                <input type="checkbox" :value="row.id" v-model="selectedIds" />
                            </td>
                            <td>
                                <img :src="row.gambar ? 'storage/' + row.gambar : ''" alt="{{ row->judul }}"
                                    class="img-circle img-size-32 mr-2" />
                                {{ row.judul }}
                            </td>
                            <td>{{ row.kategori.nama }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" :id="row.id"
                                            :checked="row.isPublish == 1" @change="change(row.id)" />
                                        <label class="custom-control-label" :for="row.id"></label>
                                    </div>
                                </div>
                            </td>
                            <td>{{ row.user.name }}</td>
                            <td>{{ row.diklik }}</td>
                            <td>
                                <Link :href="route('berita.edit', row.id)" class="btn btn-info btn-xs p-1 m-1"><i
                                    class="fas fa-edit"></i>Edit</Link>
                                <button @click="confirmDelete(row.id)" class="btn btn-danger btn-xs p-1 m-1">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>
