<template>
  <div class="c-widset c-section">
    <div class="c-section--head"><h2 class="c-title">PRODUCT</h2></div>

    <div class="c-form">
      <div v-show="loading" class="loader">Now loading...</div>

      <form v-show="!loading" v-on:submit.prevent="submit">
        <div class="c-input">
          <input type="hidden" class="" readonly id="id" v-model="product.id" />
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="product.title" />
          </label>
        </div>

        <div class="c-textarea">
          <label for="url" class="">
            <p>URL</p>
            <textarea class="" id="url" v-model="product.url" />
          </label>
        </div>

        <div class="c-img">
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
            v-if="product.file_path"
            :src="'/storage/' + product.file_path"
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
        <button @click="displayUpdate(product)" v-else-if="!validation" type="submit" class="c-btn c-btn--submit">SUBMIT</button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  props: {
    productId: [String, Number],
    auth_type: [],
  },

  data: function () {
    return {
      product: {},
      title: "",
      url: "",
      loading: true, //ロード開始
    };
  },

  computed: {
    validation: function () {
      if (!this.product.title) {
        return "タイトルは必須です";
      }
      return "";
    },
  },

  methods: {
    getProduct() {
      axios
        .get("/api/product/" + this.productId)
        .then((res) => {
          this.product = res.data;
          console.log("成功 ");
          //console.log(res);
          this.loading = false; //ロード終了
        })
        .catch(function (error) {
          console.log("失敗");
          //console.log(error);
        });
    },

    displayUpdate(product) {
      this.updateTitle = product.title;
      this.updateUrl = product.url;
    },
    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();

      data2.append("title", this.updateTitle);
      data2.append("url", this.product.url);
      data2.append("file_name", this.file);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
      };

      axios
        .post("/api/product/" + this.productId, data2, config)
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
    this.getProduct();
  },
};
</script>