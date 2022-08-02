<template>
  <div v-if="post" class="md-layout-item md-size-66 md-small-size-100">
    <div class="md-layout-item md-size-100">
      <form ref="update_post_form" @submit.prevent="updatePost">
        <md-card>
          <md-card-header class="md-card-header-icon">
            <div class="card-icon">
              <md-icon>perm_identity</md-icon>
            </div>
            <h4 class="title">
              update Post
            </h4>
          </md-card-header>

          <md-card-content>
            <div class="md-layout">
              <div class="md-layout-item md-size-100">
                <md-field class="md-invalid">
                  <label>Title</label>
                  <md-input v-model="post.title" type="text" aria-required="true" required/>
                  <validation-error/>
                </md-field>
                <md-field class="md-invalid">
                  <ckeditor v-model="post.content" :config="editorConfig" required></ckeditor>
                  <validation-error/>
                </md-field>
              </div>
            </div>
          </md-card-content>

          <md-card-actions>
            <md-button type="submit">
              update
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
// import store from "@/store";

// console.log(this);
export default {

  name: "update-post-page",

  components: {ValidationError, ckeditor: CKEditor.component},

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
      // console.log(this.post, this.$route.params.id);
    },
    async updatePost() {
      const post = {
        id: this.post.id,
        // author_id: this.post.author_id,
        type: "posts",
        title: this.post.title,
        content: this.post.content,
        "author": {
          type: "users",
          id: this.post.author_id.toString(),
        },
        relationshipNames: ['author']
      }

      try {
        await this.$store.dispatch("posts/update", post)
        // await this.$store.dispatch("posts/get", post)
        await this.$store.dispatch("alerts/error", "Post updated successfully.")
      } catch (e) {
        await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
        this.setApiValidation(e.response.data.errors)
      }

    }
  }
};
</script>
