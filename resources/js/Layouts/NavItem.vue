<script setup>
defineProps({
  routeName: String,
  componentName: String,
  icon: String,
});
</script>
<template>
  <li class="nav-item">
    <Link
      :href="route(routeName)"
      class="nav-link"
      :class="{ active: $page.component === componentName }"
    >
      <i v-if="icon" class="fas nav-icon" :class="icon"></i>
      <slot/>
    </Link>
  </li>
</template>
