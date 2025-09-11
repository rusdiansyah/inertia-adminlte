<script setup>
defineProps({
    label: {
        type: String,
        required: true,
        default: "Simpan",
    },
    type: {
        type: String,
        default: "submit",
    },
});
</script>
<template>
    <button :type="type" class="btn bg-gradient-primary">
        <i class="fas fa-save"></i> {{ label }}
    </button>
</template>
