<template>
  <section
    class="c-section c-widset adminProfile js-navSection"
    id="adminProfile"
  >
    <p
      class="c-message"
      v-bind:class="{ 'is-view': view, 'is-view-err': view_err }"
    >
      {{ message }}
    </p>

    <div class="c-section--head">
      <h2 class="c-title">PROFILE</h2>
      <router-link v-bind:to="{ name: 'profile.create' }">
        <button class="c-btn" href="#">ADD</button>
      </router-link>
    </div>

    <draggable
      v-model="profilesNew"
      v-bind="options"
      handle=".handle"
      @end="endSort_profiles"
      tag="ul"
      class="adminItems js-adminItems-main"
    >
      <li class="u-flex" v-for="(profile, index) in profilesNew" :key="index">
        <div class="c-item btns" :id="profile.id">
          <!--<button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>-->
          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{
                name: 'profile.edit',
                params: { profileId: profile.id },
              }"
            ></router-link>
          </button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-if="auth_type == 0"
            v-on:click="deleteProfile(profile.id)"
          ></button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-else
            v-on:click="messegeEvent('show only！', 1)"
          ></button>
        </div>

        <div class="c-item content">
          <p class="subItemTitle">NAME</p>
          <p class="subItemTxt">{{ profile.myname }}</p>
        </div>
        <div class="c-item content">
          <p class="subItemTitle">AGE</p>
          <p class="subItemTxt">{{ profile.age }}歳</p>
        </div>
        <div class="c-item content">
          <p class="subItemTitle">PLACE</p>
          <p class="subItemTxt">{{ profile.place }}</p>
        </div>
        <div class="c-item content">
          <p class="subItemTitle">SCHOOL</p>
          <p class="subItemTxt">{{ profile.school }}</p>
        </div>
        <div class="c-item content">
          <p class="subItemTitle">CONTENT</p>
          <p class="subItemTxt">{{ profile.content }}</p>
        </div>
      </li>
    </draggable>
  </section>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: { draggable },
  props: ["profiles"],
  props: ["auth_type"],

  data: function () {
    return {
      profilesNew: this.profiles,
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
    getProfiles() {
      axios
        .get("/api/profile")
        .then((res) => {
          this.profilesNew = res.data;
          console.log("成功");
          //console.log(res);
        })
        .catch((error) => {
          console.log("失敗");
          //console.log(error);
        });
    },

    // API経由で指定IDのタスクを削除
    deleteProfile(id) {
      axios
        .delete("/api/profile/" + id)
        .then((res) => {
          this.getProfiles();
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
    endSort_profiles(event) {
      if (this.auth_type == 0) {
        this.profilesNew.map((profile, index) => {
          profile.order = index + 1;
        });

        axios
          .put("/api/profile/", {
            profiles: this.profilesNew,
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
    this.getProfiles();
  },
};
</script>