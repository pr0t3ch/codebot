<template>
  <div>
    <h3>menu: {{ menu.locale }}</h3>

    <p>
      <router-link class="btn" :to="{path: '/menus'}">voltar</router-link>
      <a @click.prevent="sentToFacebook()" class="btn green">sicronizar</a>
      <a @click.prevent="remove()" class="btn red">remover</a>
    </p>

    <div class="card red" v-if="menu.menu_buttons.length > 0">
      <div
        v-bind:key="menu_buttons.id"
        v-for="menu_buttons in menu.menu_buttons"
        v-if="menu_buttons.parent_id === 0"
      >
        <div class="waves-effect waves-light btn-large grey">
          {{ menu_buttons.title }}
          <small>{{ menu_buttons.type | menus_types }} {{ menu_buttons.value }}</small>
        </div>
      </div>

      <div class="waves-effect waves-light child grey">
        <div
          v-bind:key="child_menu_buttons.id"
          v-for="child_menu_buttons in menu.menu_buttons"
          v-if="child_menu_buttons.parent_id === menu_buttons.id"
        >
          <div class="waves-effect waves-light btn-large grey">
            {{ child_menu_buttons.title }}
            <small>{{ child_menu_buttons.type | menus_types }} {{ child_menu_buttons.value }}</small>
          </div>
        </div>
      </div>
    </div>

    <div class="card red" v-if="menu.menu_buttons.length === 0">
      <div class="card-content white-text">Nenhum botao</div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    menu() {
      let menu = this.$store.state.menu.menu;
      return menu.menu_buttons ? menu : { menu_buttons: [] };
    }
  },
  mounted() {
    this.$store.dispatch("getMenu", this.$route.params.id);
  }
};
</script>