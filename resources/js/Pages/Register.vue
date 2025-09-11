<script setup>
    import '/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'
    import Auth from '@/Layouts/Auth.vue';
    import {
        useForm
    } from "@inertiajs/vue3";

    defineOptions({
        layout: Auth,
    });
    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    });
    const submit = () => {
        form.post(route("register"), {
            onError: () => form.reset("password", "password_confirmation"),
        });
    };
</script>
<template>
    <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Full Name" v-model="form.name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <span v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</span>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email" v-model="form.email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span  v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</span>
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
                <span  v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</span>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Retype password"
                    v-model="form.password_confirmation">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <Link :href="route('login')" class="text-center">I already have a membership</Link>
    </div>
</template>
