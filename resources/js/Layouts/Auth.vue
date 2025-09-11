<template>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <Link :href="route('login')" class="h1"><b>{{ $page.props.appName }}</b></Link>
                </div>
                <slot />
            </div>
        </div>
    </body>
</template>
