<template>
    <div>
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="assets/img/leaf_background.jpg" />
                    </div>
                    <a>
                        <img
                            class="circle"
                            src="https://secure.gravatar.com/avatar/3fca4c87d0ca7200272c7c97d0f69d75"
                            alt
                        />
                    </a>
                    <a>
                        <span class="white-text name">Daniel Dauber</span>
                    </a>
                    <a href="https://github.com/danieldauber/">
                        <span class="white-text email">@danieldauber</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    mounted() {
        $('.sidenav').sidenav();
    }
    
}
</script>