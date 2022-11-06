<template>
  <div class="c-widset c-section">
    <div class="c-section--head"><h2 class="c-title">PROFILE</h2></div>

    <div class="c-form">
      <div v-show="loading" class="loader">Now loading...</div>

      <form v-show="!loading" v-on:submit.prevent="submit">
        <div class="c-input">
          <input type="hidden" class="" readonly id="id" v-model="profile.id" />
        </div>

        <div class="c-input">
          <label for="myname" class="">
            <p>NAME</p>
            <input type="text" class="" id="myname" v-model="profile.myname" />
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
              v-model="profile.age"
            />
          </label>
        </div>

        <div class="c-input">
          <label for="place" class="">
            <p>PLACE</p>
            <input type="text" class="" id="place" v-model="profile.place" />
          </label>
        </div>

        <div class="c-input">
          <label for="school" class="">
            <p>SCHOOL</p>
            <textarea type="text" class="" id="school" v-model="profile.school" />
          </label>
        </div>

        <div class="c-textarea">
          <label for="content" class="">
            <p>CONTENT</p>
            <textarea class="" id="content" v-model="profile.content" />
          </label>
        </div>

        <p v-if="validation" class="error">{{ validation }}</p>
        <button
          v-if="!validation"
          type="submit"
          class="c-btn c-btn--submit"
          @click="displayUpdate(profile)"
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
    profileId: [String, Number],
  },

  data: function () {
    return {
      profile: {},
      myname: "",
      age: "",
      place: "",
      school: "",
      content: "",
      loading: true, //ロード開始
    };
  },

  computed: {
    validation: function () {
      if (!this.profile.myname) {
        return "タイトルは必須です";
      }
      return "";
    },
  },

  methods: {
    getProfile() {
      axios
        .get("/api/profile/" + this.profileId)
        .then((res) => {
          this.profile = res.data;
          console.log("成功 ");
          console.log(res);
          this.loading = false; //ロード終了
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },

    displayUpdate(profile) {
      this.updateMyname = profile.myname;
      this.updateAge = profile.age;
      this.updatePlace = profile.place;
      this.updateSchool = profile.school;
      this.updateContent = profile.content;
    },

    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();

      data2.append("myname", this.updateMyname);
      data2.append("age", this.updateAge);
      data2.append("place", this.updatePlace);
      data2.append("school", this.updateSchool);
      data2.append("content", this.updateContent);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
      };

      axios
        .post("/api/profile/" + this.profileId, data2, config)
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
    this.getProfile();
  },
};
</script>