<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <div class="pl-6 bg-gray-200 w-48 h-screen border-r-2 border-gray-400">
                <nav class="pt-4">
                    <router-link to="/">
                        <h1 class="text-blue-600 text-2xl pl-1 pr-2 pt-2">My Blog</h1>
                    </router-link>

                    <p class="pt-12 text-gray-500 text-xs uppercase font-bold">Create</p>

                    <router-link to="/contacts/create" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3"> Add New</div>
                    </router-link>

                    <p class="pt-12 text-gray-500 text-xs uppercase font-bold">General</p>

                    <router-link to="/contacts" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3"> Contacts</div>
                    </router-link>

                    <router-link to="/birthdays" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3"> Birthdays</div>
                    </router-link>

                    <p class="pt-12 text-gray-500 text-xs uppercase font-bold">Settings</p>

                    <router-link to="/logout" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3">Logout</div>
                    </router-link>
                </nav>
            </div>
            <div class="flex flex-1 flex-col h-screen overflow-y-hidden">
                <div class="h-16 px-6 border-b border-gray-400 flex items-center justify-between">
                    <div>
                        {{title}}
                    </div>
                    <div class="flex items-center">
                        <SearchBar />
                        <UserCircle :name="user.name" /> 
                    </div>
                </div>
                <div class="flex flex-col flex-1 overflow-y-hidden">
                    <router-view class="p-6 overflow-x-hidden"></router-view> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserCircle from '../components/UserCircle';
    import SearchBar from '../components/SearchBar';

    export default {
        name: 'App',
        props: [
            'user'
        ],
        components: {
            UserCircle,
            SearchBar
        },
        created() {
            this.title = this.$route.meta.title;
            window.axios.interceptors.request.use(
                (config) => {
                    if (config.method === 'get') {
                        config.url = config.url + '?api_token=' + this.user.api_token;
                    } else {
                        config.data = {
                            ...config.data,
                            api_token: this.user.api_token
                        };
                    }

                    return config;
                }
            )
        },

        data() {
            return {
                title: ''
            }
        },

        watch: {
            $route(to, from) {
                this.title = to.meta.title;
            },
            title() {
                document.title = this.title + ' | Jot - The SPA App'
            }
        },

    }
</script>

<style scoped>

</style>