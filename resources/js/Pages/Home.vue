<template>
    <AppLayout title="Panel de administración">
        <div>
            <h1>Home Page</h1>
            <Link :href="route('about')">About</Link>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
