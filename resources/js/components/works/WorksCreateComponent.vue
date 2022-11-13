<template>
  <div class="c-widset">
    <div class="c-section--head"><h2 class="c-title">WORKS</h2></div>

    <div class="c-form">
      <form v-on:submit.prevent="submit">
        <div class="c-radio">
          <p>TYPE</p>
          <label for="1">
            <input type="radio" id="1" v-model="type" value="0" />
            <span>MAIN</span>
          </label>
          <label for="2">
            <input type="radio" id="2" v-model="type" value="1" />
            <span>SUB</span>
          </label>
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input required type="text" class="" id="title" v-model="title" />
          </label>
        </div>

        <div class="c-textarea" v-if="type === '0'">
          <label for="content" class="">
            <p>CONTENT</p>
            <textarea class="" id="content" v-model="content" />
          </label>
        </div>

        <div class="c-textarea" v-else-if="type === '1'">
          <label for="free_txt" class="">
            <p>FREE TEXT</p>
            <textarea class="" id="free_txt" v-model="free_txt" />
          </label>
        </div>

        <div class="c-img" v-if="type === '0'">
          <label for="file" class="">
            <p>IMAGE</p>
            <input type="file" class="" id="file" @change="onChange" />
          </label>
        </div>

        <p v-if="validation" class="error">{{ validation }}</p>
        <button v-if="auth_type != 0" class="c-btn c-btn--submit" disabled>
          show only
        </button>
        <button v-else-if="validation" class="c-btn c-btn--submit" disabled>
          SUBMIT
        </button>
        <button v-else-if="!validation" type="submit" class="c-btn c-btn--submit">SUBMIT</button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  data: function () {
    return {
      work: {},
      type: "0",
      title: "",
      content: "",
      free_txt: "",
    };
  },
  props: ["auth_type"],

  computed: {
    validation: function () {
      if (!this.type) {
        return "投稿タイプは必須です";
      }
      if (this.title.length < 1) {
        return "タイトルは必須です";
      }
      if (this.type == 0 && !this.content) {
        return "コンテンツは必須です";
      }
      if (this.type == 1 && !this.free_txt) {
        return "テキストは必須です";
      }
      return "";
    },
  },

  methods: {
    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();
      data2.append("title", this.title);
      data2.append("type", this.type);
      if (this.type == 0) {
        data2.append("content", this.content);
        data2.append("file_name", this.file);
      } else {
        data2.append("free_txt", this.free_txt);
      }

      let config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("/api/work", data2, config)
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
};
</script>