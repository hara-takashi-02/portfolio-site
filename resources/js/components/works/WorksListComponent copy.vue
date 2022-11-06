<template>
  <section class="c-section c-widset adminWorks js-navSection" id="adminWorks">
    <p
      class="c-message"
      v-bind:class="{ 'is-view': view, 'is-view-err': view_err }"
    >
      {{ message }}
    </p>

    <div class="c-section--head">
      <h2 class="c-title">WORKS</h2>
      <router-link v-bind:to="{ name: 'work.create' }">
        <button class="c-btn" href="#">ADD</button>
      </router-link>
    </div>

    <p class="c-subTitle">MAIN</p>

    <draggable
      v-model="worksNew"
      v-bind="options"
      handle=".handle"
      @end="endSort_works"
      tag="ul"
      class="adminItems js-adminItems-main"
    >
      <li class="u-flex" v-for="(work, index) in worksNew" :key="index">
        <div class="c-item btns" :id="work.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>

          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{ name: 'work.edit', params: { workId: work.id } }"
            ></router-link>
          </button>

          <button
            class="c-icoBtn c-icoBtn--d"
            v-on:click="deleteWork(work.id)"
          ></button>
        </div>
        <div class="c-item image">
          <p class="subItemTitle">IMAGE</p>
          <p class="subItemTxt">
            
            <img
              v-if="work.file_path"
              :src="'/storage/' + work.file_path"
              alt=""
            />
            <span v-else class="noimg">NO IMAGE</span>
          </p>
        </div>
        <div class="c-contentRight">
          <div class="c-item title">
            <p class="subItemTitle">TITLE</p>
            <p class="subItemTxt">{{ work.title }}</p>
          </div>
          <div class="content">
            <p class="subItemTitle">CONTENT</p>
            <p class="subItemTxt">{{ work.content }}</p>
          </div>
        </div>
      </li>
    </draggable>

    <p class="c-subTitle">SUB</p>

    <draggable
      v-model="worksNew2"
      v-bind="options"
      handle=".handle"
      @end="endSort_works"
      tag="ul"
      class="adminItems js-adminItems-sub"
    >
      <li class="" v-for="(work, index) in worksNew2" :key="index">
        <div class="c-item btns">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>
          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{ name: 'work.edit', params: { workId: work.id } }"
            ></router-link>
          </button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-on:click="deleteWork(work.id)"
          ></button>
        </div>
        <div class="c-item title">
          <p class="subItemTitle">TITLE</p>
          <p class="subItemTxt">{{ work.title }}</p>
        </div>
        <div class="content">
          <p class="subItemTitle">WORKS_FREETEXT</p>
          <p v-html="work.free_txt" class="subItemTxt"></p>
        </div>
      </li>
    </draggable>
  </section>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: { draggable },
  props: ["works"],

  data: function () {
    return {
      worksNew: this.works,
      worksNew2: this.works,
      worksNew3: null, //クラス判定用
      options: {
        animation: 200,
      },
      view: false, //フラッシュメッセージ
      view_err: false,
      message: null,
      class: null, //クラス判定用
    };
  },

  methods: {
    // API経由で全タスクを取得
    getWorks() {
      axios
        .get("/api/work")
        .then((res) => {
          //this.worksNew = res.data;
          this.worksNew = res.data.filter((work) => work.type == 0);
          this.worksNew2 = res.data.filter((work) => work.type == 1);
          console.log("成功");
          console.log(res);
        })
        .catch((error) => {
          console.log("失敗");
          console.log(error);
        });
    },

    // API経由で指定IDのタスクを削除
    deleteWork(id) {
      axios
        .delete("/api/work/" + id)
        .then((res) => {
          this.getWorks();
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
    endSort_works(event) {
      //console.log(event.from._prevClass);
      this.class = event.from._prevClass;
      if (this.class.match(/main/)) {
        //console.log("メインです");
        this.worksNew.map((work, index) => {
          work.order = index + 1;
        });
        this.worksNew3 = this.worksNew;
      } else {
        //console.log("サブです");
        this.worksNew2.map((work, index) => {
          work.order = index + 1;
        });
        this.worksNew3 = this.worksNew2;
      }

      axios
        .put("/api/work/", {
          works: this.worksNew3,
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
    this.getWorks();
  },

  computed: {
    /*worksNew () {
        return this.works.filter(work => work.type == 0)
    },*/
  },
};
</script>