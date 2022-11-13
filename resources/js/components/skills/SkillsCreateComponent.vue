<template>
  <div class="c-widset">
    <div class="c-section--head"><h2 class="c-title">SKILL</h2></div>

    <div class="c-form">
      <form v-on:submit.prevent="submit">
        <div class="c-radio">
          <p>TYPE</p>
          <label for="1">
            <input type="radio" id="1" v-model="type" value="0" />
            <span>BACKEND</span>
          </label>
          <label for="2">
            <input type="radio" id="2" v-model="type" value="1" />
            <span>FRONTEND</span>
          </label>
          <label for="3">
            <input type="radio" id="3" v-model="type" value="2" />
            <span>OTHER</span>
          </label>
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="title" />
          </label>
        </div>

        <div class="c-input">
          <label for="meter" class="">
            <p>METER</p>
            <input
              type="number"
              step="5"
              max="100"
              class=""
              id="meter"
              v-model="meter"
            />
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
      skill: {},
      type: "0",
      title: "",
      meter: "0",
    };
  },
  props: ["auth_type"],

  computed: {
    validation: function () {
      if (!this.type) {
        return "投稿タイプは必須です";
      }
      if (!this.title) {
        return "タイトルは必須です";
      }
      return "";
    },
  },

  methods: {
    submit() {
      let data2 = new FormData();
      data2.append("title", this.title);
      data2.append("type", this.type);
      data2.append("meter", this.meter);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("/api/skill", data2, config)
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
};
</script>