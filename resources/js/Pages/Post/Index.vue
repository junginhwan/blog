<template>
    <app-layout>
        <template #header>
            <Header />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Subject</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Created_ad</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0" v-for="(post, index) in posts" :key="post.id">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    {{ post.subject }}
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                                    <span class="rounded py-1 px-3 text-xs font-bold" :class="post.enabled ? 'bg-green-400' : 'bg-yellow-400'">{{ post.enabled ? '노출' : '미노출' }}</span>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    {{ post.created_at }}
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                    <inertia-link class="flex-none p-1 ml-4 mr-2 border-2 rounded hover:text-white focus:outline-none text-green-500 border-green-500 hover:bg-green-500" :href="route('posts.edit', {post: post.id})">Edit</inertia-link>
                                    <button class="flex-none p-1 ml-2 border-2 rounded text-red-600 border-red-600 hover:text-white hover:bg-red-600 focus:outline-none" @click="remove(post.id)">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-end">
                    <div class="py-3">
                        <inertia-link class="flex-none p-1 ml-2 right-0 border-2 rounded text-yellow-500 border-yellow-500 bg-white; hover:text-white hover:bg-yellow-500 hover:border-yellow-500 focus:outline-none" :href="route('posts.create')">New Post</inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Header from './Header'

    export default {
        props: ['posts'],
        methods: {
            remove(id) {
                this.$inertia.delete(route('posts.destroy', {
                    id
                }));
            }
        },
        components: {
            AppLayout,
            Header,
        },
    }
</script>
