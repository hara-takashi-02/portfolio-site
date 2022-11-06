<template>
  <div class="c-widset">
    <div class="c-section--head"><h2 class="c-title">PROFILE</h2></div>

    <div class="c-form">
      <form v-on:submit.prevent="submit">
        <div class="c-input">
          <label for="myname" class="">
            <p>NAME</p>
            <input type="text" class="" id="myname" v-model="myname" />
          </label>
        </div>

        <div class="c-input">
          <label for="age" class="">
            <p>AGE</p>
            <input
              type="number"
              step="1"
              max="100"
              class=""
              id="age"
              v-model="age"
            />
          </label>
        </div>

        <div class="c-input">
          <label for="place" class="">
            <p>PLACE</p>
            <input type="text" class="" id="place" v-model="place" />
          </label>
        </div>

        <div class="c-input">
          <label for="school" class="">
            <p>SCHOOL</p>
            <textarea type="text" class="" id="school" v-model="school" />
          </label>
        </div>

        <div class="c-textarea">
          <label for="content" class="">
            <p>CONTENT</p>
            <textarea class="" id="content" v-model="content" />
          </label>
        </div>

        <p v-if="validation" class="error">{{ validation }}</p>
        <button v-if="!validation" type="submit" class="c-btn c-btn--submit">
          SUBMIT
        </button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  data: function () {
    return {
      profile: {},
      myname: "",
      age: "",
      place: "",
      school: "",
      content: "",
    };
  },

  computed: {
    validation: function () {
      if (this.myname.length < 1) {
        return "名前は必須です";
      }
      return "";
    },
  },

  methods: {
    submit() {
      let data2 = new FormData();
      data2.append("myname", this.myname);
      data2.append("age", this.age);
      data2.append("place", this.place);
      data2.append("school", this.school);
      data2.append("content", this.content);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("/api/profile", data2, config)
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