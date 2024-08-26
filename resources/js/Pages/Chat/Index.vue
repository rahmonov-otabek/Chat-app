<template >
    <div class="flex">
         <div class="w-1/2 border border-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis excepturi inventore reiciendis doloribus odio nulla alias. Similique error quisquam voluptate deserunt repudiandae autem ducimus optio sapiente maxime! Maiores, voluptates ex.
         </div>
         <div class="w-1/2 border border-gray-600">
            <h3 class="text-gray-700 mb-4 text-lg">Users</h3>
            <div v-if="users">
                <div v-for="user in users" class="flex items-center pb-4 mb-4 border-b border-gray-600">
                    <p class="mr-2">{{  user.id }}</p>
                    <p class="mr-4">{{ user.name }}</p>
                    <a class="inline-block bg-sky-400 text-white text-xs px-3 py-2 rounded-lg" href="">Message</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Main from '@/Layouts/Main.vue';

export default {
    name: 'Index',

    props: [
        'users',
    ],

    layout: Main
}
</script>

<style scoped>
    
</style>