<script setup>
import '/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'
import Auth from '@/Layouts/Auth.vue';
import { useForm } from "@inertiajs/vue3";

defineOptions({
    layout: Auth,
});
const form = useForm({
    email: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route("login"), {
        onError: () => form.reset("password", "remember"),
    });
};

</script>
<template>
     <Head :title="` | ${$page.component}`" />
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email" v-model="form.email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</span>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" v-model="form.password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</span>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" v-model="form.remember" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mb-0">
            <Link :href="route('register')" class="text-center">Register a new membership</Link>
        </p>
    </div>
</template>
