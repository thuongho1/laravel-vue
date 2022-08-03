<template>
  <div class="md-layout-item md-size-66 md-small-size-100">
    <div class="md-layout-item md-size-100">
      <form ref="create_post_form" @submit.prevent="createPost">
        <md-card>
          <md-card-header class="md-card-header-icon">
            <div class="card-icon">
              <md-icon>perm_identity</md-icon>
            </div>
            <h4 class="title">
              Create Post
            </h4>
          </md-card-header>

          <md-card-content>
            <div class="md-layout">
              <div class="md-layout-item md-size-100">
                <md-field class="md-invalid">
                  <label>Title</label>
                  <md-input v-model="title" type="text" aria-required="true" required/>
                  <validation-error/>
                </md-field>
                <md-field class="md-invalid">
                  <ckeditor v-model="content" :config="editorConfig" required></ckeditor>
                  <validation-error/>
                </md-field>
              </div>
            </div>
          </md-card-content>

          <md-card-actions>
            <md-button type="submit">
              Create
            </md-button>
          </md-card-actions>
        </md-card>

      </form>
    </div>
  </div>
</template>

<script>
import {ValidationError} from "@/components";
import formMixin from "@/mixins/form-mixin";
import CKEditor from 'ckeditor4-vue';
import store from "@/store";
// import DashboardLayout from "../../../Dashboard/Layout/DashboardLayout.vue";
// import DashboardLayout from "@/pages/Dashboard/Layout/DashboardLayout.vue";
//
// import UserMenu from "@pag";

// import {Use} from "@/components";

// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {

  name: "create-post-page",
  // props: {
  //   user: Object
  // },

  components: {ValidationError, ckeditor: CKEditor.component},

  mixins: [formMixin],

  data: () => ({
    title: null,
    content: null,
    // editor: ClassicEditor,
    editorConfig: {
      // toolbar: [ [ 'Bold' ] ]
    }
  }),
  created() {
    // this.user = this.$store.getters.getProfile;
    // console.log(this.user);
    this.getProfile();
  },
  methods: {
    async getProfile() {
      await this.$store.dispatch("profile/me")
      this.user = await this.$store.getters["profile/me"];
    },

    async createPost() {
      const post = {
        user_id: this.user.id,
        type: "posts",
        title: this.title,
        content: this.content,
        "user": {
          type: "users",
          id: this.user.id,
        },
        relationshipNames: ['user']
      }

      try {
        await this.$store.dispatch("posts/add", post)
        await this.$store.dispatch("alerts/error", "Post created successfully.")
        this.$router.push({name: "List Posts"})
      } catch (e) {
        await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
        this.setApiValidation(e.response.data.errors)
      }

    }
  }
};
</script>
