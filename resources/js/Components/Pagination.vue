<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>
<template>
    <div v-if="data.links.length > 3" class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between w-full">
            <div class="text-center">
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Mostrando
                    <span class="font-medium" v-text="data.from"></span>
                    a
                    <span class="font-medium" v-text="data.to"></span>
                    de
                    <span class="font-medium" v-text="data.total"></span>
                    resultados
                </p>
            </div>
            <div class="text-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px flex-wrap" aria-label="Pagination">
                    <template v-for="page in data.links">
                        <template v-if="page.url === null">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-gray-300 hover:bg-gray-50 cursor-not-allowed opacity-50" aria-current="page" v-html="page.label"></span>
                        </template>
                        <template v-else>
                            <Link :href="page.url" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-gray-300 hover:bg-gray-50" aria-current="page" v-html="page.label" :class="{'dark:bg-indigo-700 dark:text-white': page.active}"></Link>
                        </template>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>
