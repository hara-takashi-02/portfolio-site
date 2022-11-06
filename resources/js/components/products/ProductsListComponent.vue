<template>
  <section
    class="c-section c-widset adminProducts js-navSection"
    id="adminProducts"
  >
    <p
      class="c-message"
      v-bind:class="{ 'is-view': view, 'is-view-err': view_err }"
    >
      {{ message }}
    </p>

    <div class="c-section--head">
      <h2 class="c-title">PRODUCTS</h2>
      <router-link v-bind:to="{ name: 'product.create' }">
        <button class="c-btn" href="#">ADD</button>
      </router-link>
    </div>

    <draggable
      v-model="productsNew"
      v-bind="options"
      handle=".handle"
      @end="endSort_products"
      tag="ul"
      class="adminItems js-adminItems-main"
    >
      <li class="u-flex" v-for="(product, index) in productsNew" :key="index">
        <div class="c-item btns" :id="product.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>

          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{
                name: 'product.edit',
                params: { productId: product.id },
              }"
            ></router-link>
          </button>

          <button
            class="c-icoBtn c-icoBtn--d"
            v-on:click="deleteProduct(product.id)"
          ></button>
        </div>
        <div class="c-item image">
          <p class="subItemTitle">IMAGE</p>
          <p class="subItemTxt">
            <img
              v-if="product.file_path"
              :src="'/storage/' + product.file_path"
              alt=""
            />
            <span v-else class="noimg">NO IMAGE</span>
          </p>
        </div>
        <div class="c-contentRight">
          <div class="c-item title">
            <p class="subItemTitle">TITLE</p>
            <p class="subItemTxt">{{ product.title }}</p>
          </div>
          <div class="content">
            <p class="subItemTitle">URL</p>
            <p class="subItemTxt">{{ product.url }}</p>
          </div>
        </div>
      </li>
    </draggable>
  </section>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: { draggable },
  props: ["products"],

  data: function () {
    return {
      productsNew: this.products,
      options: {
        animation: 200,
      },
      view: false, //フラッシュメッセージ
      view_err: false,
      message: null,
    };
  },

  methods: {
    // API経由で全タスクを取得
    getProducts() {
      axios
        .get("/api/product")
        .then((res) => {
          this.productsNew = res.data;
          console.log("成功");
          console.log(res);
        })
        .catch((error) => {
          console.log("失敗");
          console.log(error);
        });
    },

    // API経由で指定IDのタスクを削除
    deleteProduct(id) {
      axios
        .delete("/api/product/" + id)
        .then((res) => {
          this.getProducts();
          console.log("成功");
          console.log(res);
          this.message = "UPDATE！";
          this.view = !this.view;
          setTimeout(() => {
            this.view = false;
          }, 800);
        })
        .catch((error) => {
          console.log("失敗");
          console.log(error);
          this.message = "ERROR！";
          this.view_err = !this.view_err;
          setTimeout(() => {
            this.view_err = false;
          }, 800);
        });
    },

    //並び替え
    endSort_products(event) {
      this.productsNew.map((product, index) => {
        product.order = index + 1;
      });
      axios
        .put("/api/product/", {
          products: this.productsNew,
        })
        .then((res) => {
          console.log("成功");
          console.log(res);
          this.message = "UPDATE！";
          this.view = !this.view;
          setTimeout(() => {
            this.view = false;
          }, 800);
        })
        .catch((error) => {
          console.log("失敗");
          console.log(error);
          this.message = "ERROR！";
          this.view_err = !this.view_err;
          setTimeout(() => {
            this.view_err = false;
          }, 800);
        });
    },
  },

  //マウントし終わったらAPIでタスク取得する。
  mounted() {
    this.getProducts();
  },
};
</script>