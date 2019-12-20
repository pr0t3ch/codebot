<template>
  <div>
    <h3>Menus do bot</h3>
    <button class="btn red" @click.prevent="removeMenu()">Limpar menu no Facebook</button>

    <div v-if="menus.data.length > 0" class="row">
      <router-link
        v-bind:key="menu.id"
        v-for="menu in menus.data"
        class="card waves-effect waves-light btn-large light-green"
        :to="{path: 'menu/' + menu.id}"
      >
        {{ menu.locale }}
        <small>Campo de mensagem: {{ menu.composer_input_disabled ? 'ativado' : 'desativado' }}</small>
      </router-link>
    </div>

    <hr />

    <form @submit.prevent="save()">
      <div class="row">
        <legend>Novo menu</legend>
        <div class="input-group col s6">
          <input type="text" placeholder="Locale" v-model="locale" required />
        </div>
        <div class="input-group col s6">
          <p>
            <a
              href="https://developers.facebook.com/docs/messenger-platform"
              target="_blank"
            >Docs do Facebook</a>
          </p>
        </div>
        <div class="input-group col s12">
          <input
            id="composer_input_disabled"
            type="checkbox"
            v-model="composer_input_disabled"
            checked
          />
          <label for="composer_input_disabled">Exibir campo de mensagem?</label>
        </div>
        <div class="input-group col s12">
          <button type="submit" class="btn">+</button>
        </div>
      </div>
    </form>

    <div class="card red" v-if="menus.data.length === 0">
      <div class="card-content white-text">Nenhum menu</div>
    </div>
  </div>
</template>

<script>
import swal from "sweetalert";
export default {
  data: function() {
    return {
      locale: "default",
      composer_input_disabled: true
    };
  },
  computed: {
    menus() {
      return this.$store.state.menu.listMenus;
    }
  },
  mounted() {
    this.$store.dispatch("getMenus");
  },
  methods: {
    save: function() {
      let data = {
        locale: this.locale,
        composer_input_disabled: this.composer_input_disabled
      };

      this.$store.dispatch("newMenu", data).then(() => {
        this.$store.dispatch("getMenus");
        this.locale = "default";
        this.composer_input_disabled = true;
      });
    },
    removeMenu: function() {
      let item = this;
      swal({
        title: "Removendo os menus no facebook",
        text: "Você está removendo os menus",
        icon: "warning",
        dangerMode: true,
        buttons: true
      }).then(function(isConfirm) {
        if (isConfirm) {
          item.removeItens();
        }
      });
    },
    removeItens() {
      this.$store.dispatch("removeFromFacebook").then(() => {
        swal("Removido", "Removido com sucesso", "success");
        this.$store.dispatch("getMenus");
      });
    }
  }
};
</script>