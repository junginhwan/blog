<template>
    <app-layout>
        <template #header>
            <Header />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <jet-form-section @submitted="submit">

                    <template #title>
                        Post
                    </template>

                    <template #description>
                        블로그를 작성하세요.
                    </template>

                    <template #form>
                        <div class="col-span-8 sm:col-span-6">
                            <jet-label for="subject" value="제목" />
                            <jet-input id="subject" type="text" class="mt-1 block w-full" v-model="form.subject" autocomplete="subject" />
                            <jet-input-error :message="form.errors.subject" class="mt-2" />
                        </div>

                        <div class="col-span-8 sm:col-span-6">
                            <jet-label for="enabled" value="노출여부" />
                            <div id="v-model-radiobutton">
                                <input type="radio" id="enabled-true" value="1" v-model="form.enabled" />
                                <label for="enabled-true" class="mr-2">노출</label>
                                <input type="radio" id="enabled-false" value="0" v-model="form.enabled" />
                                <label for="enabled-false">미노출</label>
                            </div>
                            <jet-input-error :message="form.errors.subject" class="mt-2" />
                        </div>

                        <div class="col-span-8 sm:col-span-6">
                            <jet-label for="content" value="내용" />
                            <textarea id="content" :value="form.content" class="mt-1 block w-full h-72 border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @input="update"></textarea>
                            <jet-input-error :message="form.errors.content" class="mt-2" />

                            <div class="markdown">
                                <div v-html="compiledMarkdown"></div>
                            </div>
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
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Header from './Header'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import marked from 'marked';


    export default {
        props: ['errors', 'post'],
        data() {
            return {
                form: this.$inertia.form({
                    _method: 'POST',
                    subject: this.post.subject,
                    content: this.post.content,
                    enabled: this.post.enabled,
                    id: this.post.id,
                }),
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.form.content, { sanitize: true });
            }
        },
        methods: {
            submit() {
                this.form.put(route('posts.update', {
                    post: this.post.id
                }), {
                    errorBag: 'submit',
                    preserveScroll: true
                });
            },
            update: _.debounce(function(e) {
                this.form.content = e.target.value;
            }, 300)
        },
        components: {
            AppLayout,
            Header,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage
        },
    }
</script>

<style scoped>
.markdown {

}
</style>
