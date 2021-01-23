<template>
    <jet-action-section>
        <template #title>
            Todo List
        </template>

        <template #description>
            할 일 목록입니다.
        </template>

        <template #content>
            <div class="flex mb-4 items-center" v-for="(todoItem, index) in todoItems" :key="index">
                <p class="w-full text-left" :class="[ todoItem.completed ? 'text-green-600 line-through' : 'text-grey-600' ]">{{ todoItem.name }}</p>
                <button class="flex-none p-2 ml-4 mr-2 border-2 rounded hover:text-white" :class="[ todoItem.completed ? 'text-gray-500 border-gray-500 hover:bg-gray-500' : 'text-green-600 border-green-600 hover:bg-green-600' ]" @click="changeState(todoItem)">{{ todoItem.completed ? 'Not Done' : 'Done' }}</button>
                <button class="flex-none p-2 ml-2 border-2 rounded text-red-600 border-red-600 hover:text-white hover:bg-red-600" @click="remove(todoItem.id)">Remove</button>
            </div>
        </template>

    </jet-action-section>
</template>

<script>

import JetActionSection from '@/Jetstream/ActionSection'
import JetFormSection from '@/Jetstream/FormSection'

export default {
    props: ['todoItems'],
    methods: {
        changeState(todoItem) {
            this.$inertia.put(route('todo.store'), todoItem);
        },
        remove(id) {
            this.$inertia.delete(route('todo.delete', {
                id
            }));
        }
    },
    components: {
        JetActionSection,
        JetFormSection,
    }
}
</script>
