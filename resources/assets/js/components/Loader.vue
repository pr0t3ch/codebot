<template>
    <div class="preloader-container" v-if="counter !== 0">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            counter: 0
        }
    },
    mounted() {
        axios.interceptors.request.use(config => {
            this.counter ++;
            return config
        }, error => {
            return Promise.reject(error)
        })

        axios.interceptors.response.use(config => {
            this.counter --
            return config
        }, error => {
            this.counter --
            return Promise.reject(error)
        })

    }
    
}
</script>

<style lang="scss">
    .preloader-container {
        background: rgba(255,255,255,0.5);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 999999;

        .preloader-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
</style>