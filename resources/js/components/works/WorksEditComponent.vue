<template>
  <div class="c-widset c-section">
    <div class="c-section--head"><h2 class="c-title">WORKS</h2></div>

    <div class="c-form">
      <div v-show="loading" class="loader">Now loading...</div>

      <form v-show="!loading" v-on:submit.prevent="submit">
        <div class="c-input">
          <input type="hidden" class="" readonly id="id" v-model="work.id" />
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="work.title" />
          </label>
        </div>

        <div class="c-textarea" v-if="work.type === 0">
          <label for="content" class="">
            <p>CONTENT</p>
            <textarea class="" id="content" v-model="work.content" />
          </label>
        </div>

        <div class="c-textarea" v-else-if="work.type === 1">
          <label for="free_txt" class="">
            <p>FREE TEXT</p>
            <textarea
              name="editor"
              class="ckeditor"
              id="free_txt"
              v-model="work.free_txt"
            />
          </label>
        </div>

        <div class="c-img" v-if="work.type === 0">
          <label for="file" class="">
            <p>IMAGE</p>
            <input
              type="file"
              class=""
              id="file"
              name="file"
              @change="onChange"
            />
          </label>
          <img
            v-if="work.file_path"
            :src="'/storage/' + work.file_path"
            alt=""
          />
        </div>

        <p v-if="validation" class="error">{{ validation }}</p>

        <button v-if="auth_type != 0" class="c-btn c-btn--submit" disabled>
          show only
        </button>
        <button v-else-if="validation" class="c-btn c-btn--submit" disabled>
          SUBMIT
        </button>
        <button @click="displayUpdate(work)" v-else-if="!validation" type="submit" class="c-btn c-btn--submit">SUBMIT</button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  props: {
    workId: [String, Number],
    auth_type: [],
  },

  data: function () {
    return {
      work: {},
      title: "",
      content: "",
      free_txt: "",
      loading: true, //ロード開始
      isTestDisabled: false,
    };
  },

  computed: {
    validation: function () {
      if (!this.work.title) {
        return "タイトルは必須です";
      }
      if (this.work.type == 0 && !this.work.content) {
        return "コンテンツは必須です";
      }
      if (this.work.type == 1 && !this.work.free_txt) {
        return "テキストは必須です";
      }
      return "";
    },
  },

  methods: {
    getWork() {
      axios
        .get("/api/work/" + this.workId)
        .then((res) => {
          this.work = res.data;
          console.log("成功 ");
          //console.log(res);
          this.loading = false; //ロード終了
        })
        .catch(function (error) {
          console.log("失敗");
          //console.log(error);
        });
    },

    displayUpdate(work) {
      this.updateTitle = work.title;
      if (this.work.type == 0) {
        this.updateContent = work.content;
      } else {
        this.updateFreeTxt = work.free_txt;
      }
    },

    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();

      data2.append("type", this.work.type);
      data2.append("title", this.updateTitle);
      if (this.work.type == 0) {
        data2.append("content", this.updateContent);
        data2.append("file_name", this.file);
      } else {
        data2.append("free_txt", this.updateFreeTxt);
      }

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
      };

      axios
        .post("/api/work/" + this.workId, data2, config)
        .then((res) => {
          console.log("成功 ");
          //console.log(res);
          this.$router.push({ name: "task.list" });
        })
        .catch(function (error) {
          console.log("失敗");
          //console.log(error);
        });
    },
  },

  mounted() {
    this.getWork();
  },
};
</script>