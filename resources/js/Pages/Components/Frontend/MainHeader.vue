<script setup>
import NavItem from "../../../Layouts/NavItem.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
const props = defineProps({
  searchTerm: String,
});

const search = ref(props.searchTerm);

watch(
  search,
  debounce((q) => router.get("/", { search: q }, { preserveState: true }), 500)
);
</script>
<template>
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <Link :href="route('home')" class="navbar-brand">
        <img
          :src="'/assets/img/AdminLTELogo.png'"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">{{ $page.props.appName }}</span>
      </Link>

      <button
        class="navbar-toggler order-1"
        type="button"
        data-toggle="collapse"
        data-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <NavItem routeName="home" componentName="Frontend/Home" icon="fa-home">Home</NavItem>
          <li class="nav-item dropdown">
            <a
              id="dropdownSubMenu1"
              href="#"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
              class="nav-link dropdown-toggle"
              >Kategori</a
            >
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li v-for="row in $page.props.listKategori" :key="row.id">
                <Link :href="route('kategori-berita',row.slug)" class="dropdown-item">{{ row.nama }} </Link>
              </li>
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input
              class="form-control form-control-navbar"
              type="search"
              v-model="search"
              placeholder="Search"
              aria-label="Search"
            />
          </div>
        </form>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <Link class="nav-link" :href="route('login')" role="button">
            <i class="fas fa-sign-in"></i> Login
          </Link>
        </li>
      </ul>
    </div>
  </nav>
</template>
