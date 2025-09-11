<script setup>
import { onMounted } from 'vue';
import ButtonSimpan from '../Components/ButtonSimpan.vue';
import SelectInput from '../Components/SelectInput.vue';
import TextInput from '../Components/TextInput.vue';
import {
    useForm
} from "@inertiajs/vue3";


const props = defineProps({
    title: String,
    listRole: {
        type: Array,
        required: true,
    },
    data: Object
});

const form = useForm({
    id: props.data.id ?? null,
    name: props.data.name ?? null,
    email: props.data.email ?? null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: props.data.avatar ? '/storage/'+props.data.avatar : null,
    role: props.data.role ?? null,
    isActive: !!props.data.isActive ?? false,
});

const change = (e) => {
  form.avatar = e.target.files[0];
  form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("user.store"));
};
</script>
<template>
    <Head :title="props.title" />
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">{{ props.title }}</h3>
            <div class="card-tools">
                <Link :href="route('user.index')" class="btn btn-sm btn-warning">
                <i class="fas fa-backward"></i> Kembali</Link>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <TextInput name="name" label="Full Name" v-model="form.name" :message="form.errors.name"
                            placeholder="Input Full Name" />
                    </div>
                    <div class="col-md-6">
                        <TextInput name="email" type="email" label="Email" v-model="form.email"
                            placeholder="Input Email" :message="form.errors.email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <TextInput name="password" type="password" label="Password" v-model="form.password"
                            placeholder="Input Password" :message="form.errors.password" />
                    </div>
                    <div class="col-md-6">
                        <TextInput name="password_confirmation" type="password" label="Password Confirm"
                            v-model="form.password_confirmation" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <SelectInput name="role" label="Role" v-model="form.role" :message="form.errors.role">
                            <option value="" selected>-Pilih-</option>
                            <option v-for="role in listRole" :key="role" :value="role">
                                {{ role }}
                            </option>
                        </SelectInput>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Avatar</label>
                                <input type="file" class="form-control" @change="change">
                                <div class="form-text text-danger" v-if="form.errors.avatar">
                                    {{ form.errors.avatar }}
                                </div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>
                            <div class="col-md-6">
                                <img v-if="form.preview" :src="form.preview" class="img-circle elevation-2" alt="User Image" width="170">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" v-model="form.isActive" class="form-check-input" id="isActive">
                    <label class="form-check-label" for="isActive">Aktif</label>
                </div>
            </div>
            <div class="card-footer text-center">
                <ButtonSimpan />
            </div>
        </form>
    </div>
</template>
