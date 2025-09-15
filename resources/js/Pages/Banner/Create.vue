<script setup>
import ButtonSimpan from "../Components/ButtonSimpan.vue";
import TextInput from "../Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
    data: Object,
});

const form = useForm({
    id: props.data.id ?? null,
    judul: props.data.judul ?? null,
    gambar: null,
    preview: props.data.gambar ? '/storage/' + props.data.gambar : null,
    isPublish: !!props.data.isPublish ?? false,
});
const change = (e) => {
    form.gambar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("banner.store"));
};
</script>
<template>

    <Head :title="props.title" />
    <div class="card" :class="$page.props.cardColor">
        <div class="card-header border-0">
            <h3 class="card-title">{{ props.title }}</h3>
            <div class="card-tools">
                <Link :href="route('banner.index')" class="btn btn-sm btn-warning">
                <i class="fas fa-backward"></i> Kembali</Link>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <TextInput name="judul" label="Judul" v-model="form.judul" :message="form.errors.judul"
                            placeholder="Isi Judul" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-4">
                            <input type="checkbox" v-model="form.isPublish" class="form-check-input" id="isPublish" />
                            <label class="form-check-label" for="isPublish">Publish</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Gambar</label>
                        <input type="file" class="form-control" @change="change" />
                        <div class="form-text text-danger" v-if="form.errors.gambar">
                            {{ form.errors.gambar }}
                        </div>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                    </div>
                    <div class="col-md-6">
                        <img v-if="form.preview" :src="form.preview" class="img-fluid" alt="User Image" width="170" />
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <ButtonSimpan />
            </div>
        </form>
    </div>
</template>
