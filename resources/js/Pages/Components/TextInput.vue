<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    message: String,
    placeholder: String,
});
</script>
<template>
    <div class="form-group">
        <label for="{{ name }}">{{ label }}</label>
        <input :type="type" v-model="model" :class="{ 'is-invalid': message }" class="form-control" id="{{ name }}"
        :placeholder="placeholder">
        <div class="form-text text-danger" v-if="message">
            {{ message }}
        </div>
    </div>
</template>
