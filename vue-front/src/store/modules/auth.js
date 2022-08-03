import Vue from "vue";
import router from "@/router";
import store from "@/store";
import {VueAuthenticate} from "vue-authenticate";

import axios from "axios";
import VueAxios from "vue-axios";

Vue.use(VueAxios, axios);

const vueAuth = new VueAuthenticate(Vue.prototype.$http, {
  baseUrl: process.env.VUE_APP_API_BASE_URL,
  tokenName: "access_token",
  loginUrl: "/login",
  registerUrl: "/register"
});

export default {
  state: {
    isAuthenticated: localStorage.getItem("vue-authenticate.vueauth_access_token") !== null,
    currentUser: localStorage.getItem('current-user') || "",
  },

  getters: {
    isAuthenticated(state) {
      return state.isAuthenticated;
    },
    async getProfile(state) {
      return state.currentUser ? JSON.parse(state.currentUser) : {};
    }
  },

  mutations: {
    isAuthenticated(state, payload) {
      state.isAuthenticated = payload.isAuthenticated;
    },
    removeProfile() {
      localStorage.removeItem('current-user');
    },
    async setProfile(state) {
      await store.dispatch("profile/me");
      const currentUser = await store.getters["profile/me"];
      if (currentUser) {
        localStorage.setItem('current-user', JSON.stringify(currentUser));
      } else {
        localStorage.removeItem('vue-authenticate.vueauth_access_token');
        localStorage.removeItem('current-user');
      }
    },

  },

  actions: {
    login(context, payload) {
      return vueAuth.login(payload.user, payload.requestOptions).then(response => {
        context.commit("isAuthenticated", {
          isAuthenticated: vueAuth.isAuthenticated()
        });
        context.commit("setProfile");
        router.push({name: "Home"});
      });
    },

    register(context, payload) {
      return vueAuth.register(payload.user, payload.requestOptions).then(response => {
        context.commit("isAuthenticated", {
          isAuthenticated: vueAuth.isAuthenticated()
        });
        context.commit("setProfile");
        router.push({name: "Home"});
      });
    },

    logout(context, payload) {
      return vueAuth.logout().then(response => {
        context.commit("isAuthenticated", {
          isAuthenticated: vueAuth.isAuthenticated()
        });
        context.commit("removeProfile");
        router.push({name: "Login"});
      });
    }
  }
};
