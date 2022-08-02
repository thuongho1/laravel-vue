<template v-if="post">
  <div class="md-layout-item md-size-66 md-small-size-100">
    <div class="md-layout-item md-size-100">
      <form ref="delete_post_form" @submit.prevent="deletePost">
        <md-card>
          <md-card-header class="md-card-header-icon">
            <div class="card-icon">
              <md-icon>perm_identity</md-icon>
            </div>
            <h4 class="title">
              Delete Post
            </h4>
          </md-card-header>
          <md-card-actions>
            <md-button type="submit">
              delete
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
import store from "@/store";

export default {

  name: "delete-post-page",
  // props: {
  //   user: Object
  // },
  components: {},

  mixins: [formMixin],
  data: () => ({
    post: null,
    title: null,
    content: null,
    // editor: ClassicEditor,
    editorConfig: {
      // toolbar: [ [ 'Bold' ] ]
    }
  }),
  created() {
    this.getPost();
  },
  methods: {
    async getPost() {
      await this.$store.dispatch("posts/get", this.$route.params.id);
      this.post = await this.$store.getters["posts/post"];
      console.log(this.post);
      if (!this.post) {
        this.$router.push({name: "List Posts"})
      }
    },
    async deletePost() {
      // const post = {
      //   id: this.post.id,
      // }

      try {
        await this.$store.dispatch("posts/destroy", this.post.id)
        await this.$store.dispatch("alerts/error", "Post deleted successfully.")
        this.$router.push({name: "List Posts"})
      } catch (e) {
        await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
        this.setApiValidation(e.response.data.errors)
      }

    }
  }
};
</script>
