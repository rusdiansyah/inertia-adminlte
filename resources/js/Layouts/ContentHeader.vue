<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $page.component }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><Link :href="route('dashboard')">Dashboard</Link></li>
                        <!-- <li class="breadcrumb-item active">Dashboard v3</li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>
