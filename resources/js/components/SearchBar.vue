<template>
    <div>
        <input type="text" placeholder="Search..." id="searchTerm" v-model="searchTerm"  
        class="w-64 mr-6 bg-gray-200 border border-gray-400 pl-2 pr-3 py-1 rounded-full text-sm focus:outline-none focus:border-blue-500 focus:shadow focus:bg-gray-100">
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data() {
        return {
            searchTerm: ''
        }
    },
}
</script>