<template>
  <section
    class="c-section c-widset adminHistorys js-navSection"
    id="adminHistorys"
  >
    <p
      class="c-message"
      v-bind:class="{ 'is-view': view, 'is-view-err': view_err }"
    >
      {{ message }}
    </p>

    <div class="c-section--head">
      <h2 class="c-title">HISTORYS</h2>
      <router-link v-bind:to="{ name: 'history.create' }">
        <button class="c-btn" href="#">ADD</button>
      </router-link>
    </div>

    <draggable
      v-model="historysNew"
      v-bind="options"
      handle=".handle"
      @end="endSort_historys"
      tag="ul"
      class="adminItems js-adminItems-main"
    >
      <li class="u-flex" v-for="(history, index) in historysNew" :key="index">
        <div class="c-item btns" :id="history.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>

          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{
                name: 'history.edit',
                params: { historyId: history.id },
              }"
            ></router-link>
          </button>

          <button
            class="c-icoBtn c-icoBtn--d"
            v-if="auth_type == 0"
            v-on:click="deleteHistory(history.id)"
          ></button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-else
            v-on:click="messegeEvent('show only！', 1)"
          ></button>
        </div>
        <div class="c-item image">
          <p class="subItemTitle">IMAGE</p>
          <p class="subItemTxt">
            <img
              v-if="history.file_path"
              :src="'/storage/' + history.file_path"
              alt=""
            />
            <span v-else class="noimg">NO IMAGE</span>
          </p>
        </div>
        <div class="c-contentRight">
          <div class="c-item title">
            <p class="subItemTitle">TITLE</p>
            <p class="subItemTxt">{{ history.title }}</p>
          </div>
          <div class="content">
            <p class="subItemTitle">CONTENT</p>
            <p class="subItemTxt">
              {{ history.age_st }} ~ {{ history.age_ed }}歳
            </p>
            <p class="subItemTxt">{{ history.content }}</p>
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
  props: ["historys"],
  props: ["auth_type"],

  data: function () {
    return {
      historysNew: this.historys,
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
    getHistorys() {
      axios
        .get("/api/history")
        .then((res) => {
          this.historysNew = res.data;
          console.log("成功");
          //console.log(res);
        })
        .catch((error) => {
          console.log("失敗");
          //console.log(error);
        });
    },

    // API経由で指定IDのタスクを削除
    deleteHistory(id) {
      axios
        .delete("/api/history/" + id)
        .then((res) => {
          this.getHistorys();
          console.log("成功");
          //console.log(res);
          this.messegeEvent("UPDATE！", 0);
        })
        .catch((error) => {
          console.log("失敗");
          //console.log(error);
          this.messegeEvent("ERROR！", 1);
        });
    },

    //並び替え
    endSort_historys(event) {
      if (this.auth_type == 0) {
        this.historysNew.map((history, index) => {
          history.order = index + 1;
        });

        axios
          .put("/api/history/", {
            historys: this.historysNew,
          })
          .then((res) => {
            console.log("成功");
            //console.log(res);
            this.messegeEvent("UPDATE！", 0);
          })
          .catch((error) => {
            console.log("失敗");
            //console.log(error);
            this.messegeEvent("ERROR！", 1);
          });
      } else {
        this.messegeEvent("show only！", 1);
      }
    },
    messegeEvent(m, v) {
      this.message = m;
      if (v == 0) {
        this.view = !this.view;
      } else {
        this.view_err = !this.view_err;
      }
      setTimeout(() => {
        this.view = false;
        this.view_err = false;
      }, 800);
    },
  },

  //マウントし終わったらAPIでタスク取得する。
  mounted() {
    this.getHistorys();
  },

  computed: {
    /*historysNew () {
        return this.historys.filter(history => history.type == 0)
    },*/
  },
};
</script>