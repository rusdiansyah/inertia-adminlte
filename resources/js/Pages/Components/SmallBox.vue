<script setup>
defineProps({
    routeName: String,
    jmlData: String,
    judul: String,
    icon: String,
    bg: String,
});
</script>
<template>
    <div class="col-lg-3 col-6">
        <div class="small-box" :class="bg">
            <div class="inner">
                <h3>{{ jmlData }}</h3>
                <p>{{ judul }}</p>
            </div>
            <div class="icon">
                <i class="ion" :class="icon"></i>
            </div>
            <Link :href="route(routeName)" class="small-box-footer">More info
                <i class="fas fa-arrow-circle-right"></i>
            </Link>
        </div>
    </div >
</template >
