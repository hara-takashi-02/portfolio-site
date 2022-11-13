<template>
  <section
    class="c-section c-widset adminskills js-navSection"
    id="adminskills"
  >
    <p
      class="c-message"
      v-bind:class="{ 'is-view': view, 'is-view-err': view_err }"
    >
      {{ message }}
    </p>

    <div class="c-section--head">
      <h2 class="c-title">SKILLS</h2>
      <router-link v-bind:to="{ name: 'skill.create' }">
        <button class="c-btn" href="#">ADD</button>
      </router-link>
    </div>

    <p class="c-subTitle">BACKEND</p>
    <draggable
      v-model="skillsNew"
      v-bind="options"
      handle=".handle"
      @end="endSort_skills"
      tag="ul"
      class="adminItems skillsBack js-adminItems-back"
    >
      <li
        class="u-flex u-justify-between u-align-end"
        v-for="(skill, index) in skillsNew"
        :key="index"
      >
        <div class="c-item btns" :id="skill.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>
          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{ name: 'skill.edit', params: { skillId: skill.id } }"
            ></router-link>
          </button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-if="auth_type == 0"
            v-on:click="deleteSkill(skill.id)"
          ></button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-else
            v-on:click="messegeEvent('show only！', 1)"
          ></button>
        </div>
        <div class="u-flex">
          <div class="content">
            <p class="subItemTitle">METER</p>
            <p class="subItemTxt">{{ skill.meter }}</p>
          </div>
        </div>
        <div class="meter">
          <p :style="'width: ' + skill.meter + '%'">{{ skill.title }}</p>
        </div>
      </li>
    </draggable>

    <p class="c-subTitle">FRONTEND</p>
    <draggable
      v-model="skillsNew2"
      v-bind="options"
      handle=".handle"
      @end="endSort_skills"
      tag="ul"
      class="adminItems skillsFront js-adminItems-front"
    >
      <li
        class="u-flex u-justify-between u-align-end"
        v-for="(skill, index) in skillsNew2"
        :key="index"
      >
        <div class="c-item btns" :id="skill.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>
          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{ name: 'skill.edit', params: { skillId: skill.id } }"
            ></router-link>
          </button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-if="auth_type == 0"
            v-on:click="deleteSkill(skill.id)"
          ></button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-else
            v-on:click="messegeEvent('show only！', 1)"
          ></button>
        </div>
        <div class="u-flex">
          <div class="content">
            <p class="subItemTitle">METER</p>
            <p class="subItemTxt">{{ skill.meter }}</p>
          </div>
        </div>
        <div class="meter">
          <p :style="'width: ' + skill.meter + '%'">{{ skill.title }}</p>
        </div>
      </li>
    </draggable>

    <p class="c-subTitle">OTHER</p>
    <draggable
      v-model="skillsNew3"
      v-bind="options"
      handle=".handle"
      @end="endSort_skills"
      tag="ul"
      class="adminItems skillsOther js-adminItems-other"
    >
      <li
        class="u-flex u-justify-between u-align-end"
        v-for="(skill, index) in skillsNew3"
        :key="index"
      >
        <div class="c-item btns" :id="skill.id">
          <button scope="row" class="c-icoBtn c-icoBtn--s handle"></button>
          <button class="c-icoBtn c-icoBtn--e">
            <router-link
              v-bind:to="{ name: 'skill.edit', params: { skillId: skill.id } }"
            ></router-link>
          </button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-if="auth_type == 0"
            v-on:click="deleteSkill(skill.id)"
          ></button>
          <button
            class="c-icoBtn c-icoBtn--d"
            v-else
            v-on:click="messegeEvent('show only！', 1)"
          ></button>
        </div>
        <div class="u-flex">
          <div class="content">
            <p class="subItemTitle">METER</p>
            <p class="subItemTxt">{{ skill.meter }}</p>
          </div>
        </div>
        <div class="meter">
          <p :style="'width: ' + skill.meter + '%'">{{ skill.title }}</p>
        </div>
      </li>
    </draggable>
  </section>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: { draggable },
  props: ["skills"],
  props: ["auth_type"],

  data: function () {
    return {
      skillsNew: this.skills,
      skillsNew2: this.skills,
      skillsNew3: this.skills,
      skillsNewLast: null, //クラス判定用
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
    getSkills() {
      axios
        .get("/api/skill")
        .then((res) => {
          //this.skillsNew = res.data;

          this.skillsNew = res.data.filter((skill) => skill.type == 0);
          this.skillsNew2 = res.data.filter((skill) => skill.type == 1);
          this.skillsNew3 = res.data.filter((skill) => skill.type == 2);

          console.log("成功");
          //console.log(res);
        })
        .catch((error) => {
          console.log("失敗");
          //console.log(error);
        });
    },

    // API経由で指定IDのタスクを削除
    deleteSkill(id) {
      axios
        .delete("/api/skill/" + id)
        .then((res) => {
          this.getSkills();
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
    endSort_skills(event) {
      if (this.auth_type == 0) {
        this.class = event.from._prevClass;
        if (this.class.match(/back/)) {
          this.skillsNew.map((skill, index) => {
            skill.order = index + 1;
          });
          this.skillsNewLast = this.skillsNew;
        } else if (this.class.match(/front/)) {
          this.skillsNew2.map((skill, index) => {
            skill.order = index + 1;
          });
          this.skillsNewLast = this.skillsNew2;
        } else {
          this.skillsNew3.map((skill, index) => {
            skill.order = index + 1;
          });
          this.skillsNewLast = this.skillsNew3;
        }

        axios
          .put("/api/skill/", {
            skills: this.skillsNewLast,
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
    this.getSkills();
  },
};
</script>