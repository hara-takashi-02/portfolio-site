<template>
  <div class="c-widset">
    <div class="c-section--head"><h2 class="c-title">PRODUCT</h2></div>

    <div class="c-form">
      <form v-on:submit.prevent="submit">
        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="title" />
          </label>
        </div>

        <div class="c-textarea">
          <label for="url" class="">
            <p>URL</p>
            <textarea class="" id="url" v-model="url" />
          </label>
        </div>

        <div class="c-img">
          <label for="file" class="">
            <p>IMAGE</p>
            <input type="file" class="" id="file" @change="onChange" />
          </label>
        </div>

        <p v-if="validation" class="error">
          {{ validation }}
        </p>
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
      product: {},
      type: "0",
      title: "",
      url: "",
    };
  },
  props: ["auth_type"],

  computed: {
    validation: function () {
      if (this.title.length < 1) {
        return "タイトルは必須です";
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
      data2.append("file_name", this.file);
      data2.append("url", this.url);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("/api/product", data2, config)
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