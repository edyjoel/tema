<script setup>
import {ref, watch} from 'vue';
import {Head, Link, router} from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import {useDisplay} from 'vuetify';

defineProps({
    title: String,
});

const drawer = ref(false);
const menu = ref(false);

const headerItems = ref([
    {
        text: 'About',
        value: 'about',
        route: 'about',
        icon: 'mdi-home'
    }
]);

const userItems = ref([
    {
        text: 'Profile',
        value: 'profile',
        route: 'profile.show',
        icon: 'mdi-account'
    }
]);

const {mobile} = useDisplay();
drawer.value = !mobile.value;

watch(mobile, (isMobile) => {
    drawer.value = !isMobile;
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <v-layout>
        <v-app-bar
            color="primary"
            prominent
        >
            <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Dashboard</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu
                v-model="menu"
                :close-on-content-click="false"
                location="bottom right"
            >
                <template v-slot:activator="{ props }">
                    <v-btn icon v-bind="props">
                        <v-avatar>
                            <img
                                :src="$page.props.auth.user.profile_photo_url ? $page.props.auth.user.profile_photo_url : 'https://ui-avatars.com/api/?name=' + $page.props.auth.user.name + '&color=7F9CF5&background=EBF4FF'"
                                :alt="$page.props.auth.user.name">
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card min-width="230">
                    <v-list>
                        <v-list-item
                            :prepend-avatar="$page.props.auth.user.profile_photo_url"
                            subtitle="Admin"
                            :title="$page.props.auth.user.name"
                        ></v-list-item>
                    </v-list>
                    <v-spacer class="border-b-thin"></v-spacer>
                    <v-list nav>
                        <Link v-for="item in userItems" :href="route(item.route)">
                            <v-list-item color="primary" :prepend-icon="item.icon" :title="item.text"
                                         :value="item.value"
                                         :active="route().current(item.route)"></v-list-item>
                        </Link>
                        <Link :href="route('logout')" method="post">
                            <v-list-item color="primary" title="Logout" value="logout"
                                         prepend-icon="mdi-logout"></v-list-item>
                        </Link>
                    </v-list>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            :location="$vuetify.display.mobile ? 'left' : undefined"
        >
            <v-list nav>
                <Link v-for="item in headerItems" :href="route(item.route)">
                    <v-list-item color="primary" :prepend-icon="item.icon" :title="item.text"
                                 :value="item.value"
                                 :active="route().current(item.route)"></v-list-item>
                </Link>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <v-container>
                <slot/>
            </v-container>
        </v-main>
    </v-layout>
    <Head :title="title"/>
    <Banner/>
</template>
