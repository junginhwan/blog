<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div>
                    <todo-input></todo-input>
                    <jet-section-border />
                </div>

                <div>
                    <todo-list :todoItems="todoItems"></todo-list>
                    <jet-section-border />
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import TodoInput from './TodoInput.vue';
    import TodoList from './TodoList.vue';

    export default {
        props: ['todoItems'],
        methods: {

        },
        components: {
            AppLayout,
            JetSectionBorder,
            TodoInput,
            TodoList,
        }
    }
</script>
