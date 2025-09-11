<script setup>
defineProps({
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "submit",
    },
});
</script>
<template>
    <button :type="type" class="btn bg-gradient-primary">
        <slot/> {{ label }}
    </button>
</template>
