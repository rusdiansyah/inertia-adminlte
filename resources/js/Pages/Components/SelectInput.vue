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
});
</script>
<template>
    <div class="form-group">
        <label for="{{ name }}">{{ label }}</label>
        <select class="form-control" id="{{ name }}" v-model="model">
            <slot/>
        </select>
        <div class="form-text text-danger" v-if="message">
            {{ message }}
        </div>
    </div>
</template>
