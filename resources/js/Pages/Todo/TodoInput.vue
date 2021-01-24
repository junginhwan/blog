<template>
    <jet-form-section @submitted="addTodo">

        <template #title>
            Todo
        </template>

        <template #description>
            할 일을 입력하세요.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Todo" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>

import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'


export default {
    data () {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: '',
            }),
        }
    },
    methods: {
        addTodo() {
            if (this.form.name) {
                this.form.post(route('todos.store'), {
                    errorBag: 'addTodo',
                    preserveScroll: true
                });
                this.form.name = "";
            }
        },
        clearInput() {
            this.newTodoItem = "";
        }
    },
    components: {
        JetFormSection,
        JetInput,
        JetButton,
        JetInputError,
        JetLabel,
        JetActionMessage
    }
}
</script>
