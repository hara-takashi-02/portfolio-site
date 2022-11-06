<template>
  <div class="c-widset c-section">
    <div class="c-section--head"><h2 class="c-title">SKILL</h2></div>

    <div class="c-form">
      <div v-show="loading" class="loader">Now loading...</div>

      <form v-show="!loading" v-on:submit.prevent="submit">
        <div class="c-input">
          <input type="hidden" class="" readonly id="id" v-model="skill.id" />
        </div>

        <div class="c-radio">
          <p>TYPE</p>
          <label for="1">
            <input type="radio" id="1" v-model="skill.type" value="0" />
            <span>BACKEND</span>
          </label>
          <label for="2">
            <input type="radio" id="2" v-model="skill.type" value="1" />
            <span>FRONTEND</span>
          </label>
          <label for="3">
            <input type="radio" id="3" v-model="skill.type" value="2" />
            <span>OTHER</span>
          </label>
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="skill.title" />
          </label>
        </div>

        <div class="c-input">
          <label for="meter" class="">
            <p>METER</p>
            <input type="number" step="5" max="100" class="" id="meter" v-model="skill.meter" />
          </label>
        </div>

        <p v-if="validation" class="error">{{ validation }}</p>
        <button
          v-if="!validation"
          type="submit"
          class="c-btn c-btn--submit"
          @click="displayUpdate(skill)"
        >
          SUBMIT
        </button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  props: {
    skillId: [String, Number],
  },

  data: function () {
    return {
      skill: {},
      title: "",
      meter: "",
      loading: true, //ロード開始
    };
  },

  computed: {
    validation: function () {
      if (!this.skill.title) {
        return "タイトルは必須です";
      }
      return "";
    },
  },

  methods: {
    getSkill() {
      axios
        .get("/api/skill/" + this.skillId)
        .then((res) => {
          this.skill = res.data;
          console.log("成功 ");
          console.log(res);
          this.loading = false; //ロード終了
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },

    displayUpdate(skill) {
      this.updateType = skill.type;
      this.updateTitle = skill.title;
      this.updateMeter = skill.meter;
    },

    submit() {
      let data2 = new FormData();
      data2.append("type", this.updateType);
      data2.append("title", this.updateTitle);
      data2.append("meter", this.updateMeter);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
      };

      axios
        .post("/api/skill/" + this.skillId, data2, config)
        .then((res) => {
          console.log("成功 ");
          console.log(res);
          this.$router.push({ name: "task.list" });
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },
  },

  mounted() {
    this.getSkill();
  },
};
</script>