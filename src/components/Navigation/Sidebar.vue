<template>
    <aside class="w-80 h-screen bg-gray shadow-md w-fulll hidden sm:block">
        <div class="flex flex-col justify-between h-screen p-4 bg-gray-800">
            <div class="text-sm">
                <router-link to="/">
                    <div 
                        class="p-5 rounded cursor-pointer hover:bg-gray-700 hover:text-blue-300"
                        :class="{'bg-gray-700 text-blue-300': main, 'bg-gray-900 text-white': !main}"
                        >Main
                    </div>
                </router-link>
                <!-- <div class="bg-gray-900 text-white p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300">Backlog</div> -->
                <router-link to="/amg1">
                    <div 
                        :class="{'bg-gray-700 text-blue-300': amg1, 'bg-gray-900 text-white': !amg1}"
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase">
                        amg 1
                    </div>
                </router-link>
                <router-link to="/amg2">
                    <div 
                        :class="{'bg-gray-700 text-blue-300': amg2, 'bg-gray-900 text-white': !amg2}"
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase"
                        >
                        amg 2
                    </div>    
                </router-link>                
                <!-- <div class="bg-gray-900 flex justify-between items-center text-white p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300">
                    <span>Reports</span>
                    <span class="w-4 h-4 bg-blue-600 rounded-full text-white text-center font-normal text-xs">5</span>
                </div>
                <div class="bg-gray-900 text-white p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300">Releases</div>
                <div class="bg-gray-900 text-white p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300">Components</div> -->
                <router-link to="/amg3">
                    <div 
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase"
                        :class="{'bg-gray-900 text-white': !amg3, 'bg-gray-700 text-blue-300': amg3}"
                        >
                        amg 3
                    </div>
                </router-link>
                <router-link to="/amg4">
                    <div 
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase"
                        :class="{'bg-gray-900 text-white': !amg4, 'bg-gray-700 text-blue-300': amg4}"
                        >
                        amg4
                    </div>
                </router-link>
                 <router-link to="/amg5">
                    <div 
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase"
                        :class="{'bg-gray-900 text-white': !amg5, 'bg-gray-700 text-blue-300': amg5}"
                        >
                        amg5
                    </div>
                </router-link>
                 <router-link to="/amg6">
                    <div 
                        class="p-2 rounded mt-2 cursor-pointer hover:bg-gray-700 hover:text-blue-300 uppercase"
                        :class="{'bg-gray-900 text-white': !amg6, 'bg-gray-700 text-blue-300': amg6}"
                        >
                        amg6
                    </div>
                </router-link>
                
            </div>
            <!-- <button class="flex p-3 text-white bg-red-500 rounded cursor-pointer text-center text-sm" @click="logout()">
                <div class="rounded inline-flex items-center">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="font-semibold">Logout</span>
                </div>
            </button> -->
        </div>
    </aside>
</template>

<script>

export default {
    name: "Sidebar",
    methods: {
        
    },
    computed: {
        main(){
            return this.$route.name === "Home" ? true : false;
        },
        amg1(){
            return this.$route.name === "AMG1" ? true : false;
        },
        amg2(){
            return this.$route.name === "AMG2" ? true : false;
        },
        amg3(){
            return this.$route.name === "AMG3" ? true : false;
        },
        amg4(){
            return this.$route.name === "AMG4" ? true : false;
        },
        amg5(){
            return this.$route.name === "AMG5" ? true : false;
        },
        amg6(){
            return this.$route.name === "AMG6" ? true : false;
        }
    }
}
</script>

<style>

</style>