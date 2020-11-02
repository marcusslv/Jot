<template>
    <div>
        <div class="flex justify-between">
            <a href="#" @click="$router.back()" class="text-blue-400"> < Back</a>
        </div>
        <form @submit.prevent="submitForm()" class="pt-2">
            <InputField name="name" 
                label="Contact Name" placeholder="Contact Name" @update:field="form.name = $event"  :errors="errors" :data="form.name" />
            <InputField name="email" 
                label="Contact Email" placeholder="Contact Email" @update:field="form.email = $event"  :errors="errors" :data="form.email"/>
            <InputField name="company" 
                label="Company" placeholder="Company" @update:field="form.company = $event" :errors="errors" :data="form.company"/>
            <InputField name="birthday" 
                label="Birthday" placeholder="MM/DD/YYYY" @update:field="form.birthday = $event" :errors="errors" :data="form.birthday" />
            <div class="flex justify-end">
                <button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
                <button type="submit" class="py-2 px-4 rounded bg-blue-500 text-white hover:bg-blue-400">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
    import InputField from '../components/InputField';

    export default {
        name: 'ContactsEdit',
        components: {
            InputField
        },
        mounted() {
            axios.get('/api/contacts/' + this.$route.params.id)
            .then(response => {
                this.form = response.data.data;
                // this.loading = false;
            })
            .catch(error => {
                // this.loading = false;

                if (error.response.status === 404) {
                    this.$router.push('/contacts');
                }
            })
        },
        data() {
            return {
                form: {
                    name    : '',
                    email   : '',
                    company : '',
                    birthday: '',
                },
                errors: null
            }
        },
        methods: {
            submitForm() {
                axios.patch('/api/contacts/' + this.$route.params.id, this.form)
                    .then(response => {
                        this.$router.push(response.data.links.self);
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors;
                    });
            }
        },
    }
</script>