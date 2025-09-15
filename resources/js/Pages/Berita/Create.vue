<script setup>
import ButtonSimpan from '../Components/ButtonSimpan.vue';
import SelectInput from '../Components/SelectInput.vue';
import TextInput from '../Components/TextInput.vue';
import {
    useForm
} from "@inertiajs/vue3";


const props = defineProps({
    title: String,
    listKategori: {
        type: Array,
        required: true,
    },
    data: Object,
});

const form = useForm({
    id: props.data.id ?? null,
    kategori_id: props.data.kategori_id ?? null,
    judul: props.data.judul ?? null,
    gambar: null,
    preview: props.data.gambar ? '/storage/' + props.data.gambar : null,
    isi: props.data.isi ?? null,
    isPublish: !!props.data.isPublish ?? false,
});

const change = (e) => {
    form.gambar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("berita.store"));
};
</script>
<template>
    <Head :title="props.title" />
    <div class="card" :class="$page.props.cardColor">
        <div class="card-header border-0">
            <h3 class="card-title">{{ props.title }}</h3>
            <div class="card-tools">
                <Link :href="route('berita.index')" class="btn btn-sm btn-warning">
                <i class="fas fa-backward"></i> Kembali</Link>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <SelectInput name="kategori" label="Kategori" v-model="form.kategori_id"
                            :message="form.errors.kategori_id">
                            <option value="" selected>-Pilih-</option>
                            <option v-for="kategori in listKategori" :key="kategori.id" :value="kategori.id">
                                {{ kategori.nama }}
                            </option>
                        </SelectInput>
                    </div>
                    <div class="col-md-6">
                        <TextInput name="judul" label="Judul" v-model="form.judul" placeholder="Input Judul"
                            :message="form.errors.judul" />
                    </div>
                </div>
                <div class="col-12">
                    <textarea rows="6" v-model="form.isi" class="form-control col-12"></textarea>
                    <div v-if="form.errors.isi" class="text-danger">{{ form.errors.isi }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Avatar</label>
                        <input type="file" class="form-control" @change="change">
                        <div class="form-text text-danger" v-if="form.errors.gambar">
                            {{ form.errors.gambar }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img v-if="form.preview" :src="form.preview" class="img-fluid" alt="User Image" width="200">
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" v-model="form.isPublish" class="form-check-input" id="isPublish">
                    <label class="form-check-label" for="isPublish">Publish</label>
                </div>
            </div>
            <div class="card-footer text-center">
                <ButtonSimpan />
            </div>
        </form>
    </div>
</template>
