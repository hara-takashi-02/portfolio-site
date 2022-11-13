<template>
  <div class="c-widset c-section">
    <div class="c-section--head"><h2 class="c-title">HISTORY</h2></div>

    <div class="c-form">
      <div v-show="loading" class="loader">Now loading...</div>

      <form v-show="!loading" v-on:submit.prevent="submit">
        <div class="c-input">
          <input type="hidden" class="" readonly id="id" v-model="history.id" />
        </div>

        <div class="c-input">
          <label for="title" class="">
            <p>TITLE</p>
            <input type="text" class="" id="title" v-model="history.title" />
          </label>
        </div>

        <div class="c-input">
          <label for="age_st" class="">
            <p>AGE_START</p>
            <input
              type="number"
              step="1"
              max="100"
              class=""
              id="age_st"
              v-model="history.age_st"
            />
          </label>
        </div>

        <div class="c-input">
          <label for="age_ed" class="">
            <p>AGE_END</p>
            <input
              type="number"
              step="1"
              max="100"
              class=""
              id="age_ed"
              v-model="history.age_ed"
            />
          </label>
        </div>

        <div class="c-textarea">
          <label for="content" class="">
            <p>CONTENT</p>
            <textarea class="" id="content" v-model="history.content" />
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
            v-if="history.file_path"
            :src="'/storage/' + history.file_path"
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
        <button @click="displayUpdate(history)" v-else-if="!validation" type="submit" class="c-btn c-btn--submit">SUBMIT</button>
      </form>
    </div>
  </div>
</template>
 
<script>
export default {
  props: {
    historyId: [String, Number],
    auth_type: [],
  },

  data: function () {
    return {
      history: {},
      title: "",
      content: "",
      age_st: "",
      age_ed: "",
      loading: true, //ロード開始
    };
  },

  computed: {
    validation: function () {
      if (!this.history.title) {
        return "タイトルは必須です";
      }
      return "";
    },
  },

  methods: {
    getHistory() {
      axios
        .get("/api/history/" + this.historyId)
        .then((res) => {
          this.history = res.data;
          console.log("成功 ");
          //console.log(res);
          this.loading = false; //ロード終了
        })
        .catch(function (error) {
          console.log("失敗");
          //console.log(error);
        });
    },

    displayUpdate(history) {
      this.updateTitle = history.title;
      this.updateContent = history.content;
      this.updateAge_st = history.age_st;
      this.updateAge_ed = history.age_ed;
    },

    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();

      data2.append("title", this.updateTitle);
      data2.append("content", this.updateContent);
      data2.append("file_name", this.file);
      data2.append("age_st", this.updateAge_st);
      data2.append("age_ed", this.updateAge_ed);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT",
        },
      };

      axios
        .post("/api/history/" + this.historyId, data2, config)
        .then((res) => {
          console.log("成功 ");
          //console.log(res);
          this.$router.push(
            { name: "task.list", query: { modal: "opened" } },
            undefined,
            { scroll: false }
          );
        })
        .catch(function (error) {
          console.log("失敗");
          //console.log(error);
        });
    },

  },

  mounted() {
    this.getHistory();
  },
};
</script>