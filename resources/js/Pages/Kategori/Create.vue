<script setup>
import ButtonSimpan from '../Components/ButtonSimpan.vue';
import TextInput from '../Components/TextInput.vue';
import {
    useForm
} from "@inertiajs/vue3";


const props = defineProps({
    title: String,
    data: Object,
});

const form = useForm({
    id: props.data.id ?? null,
    nama: props.data.nama ?? null,
    isActive: !!props.data.isActive ?? false,
});

const submit = () => {
    form.post(route("kategori.store"));
};
</script>
<template>
    <Head :title="props.title" />
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">{{ props.title }}</h3>
            <div class="card-tools">
                <Link :href="route('kategori.index')" class="btn btn-sm btn-warning">
                <i class="fas fa-backward"></i> Kembali</Link>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <TextInput name="nama" label="Nama" v-model="form.nama" :message="form.errors.nama"
                            placeholder="Isi Nama Kategori" />
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" v-model="form.isActive" class="form-check-input" id="isActive">
                    <label class="form-check-label" for="isActive">Aktif</label>
                </div>
            </div>
            <div class="card-footer text-center">
                <ButtonSimpan :disabled="form.processing" />
            </div>
        </form>
    </div>
</template>
