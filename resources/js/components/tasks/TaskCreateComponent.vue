<template>
  <div class="container 2">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">

          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="title"
              v-model="title"
            />

          </div>
          <div class="form-group row">
            <label for="content" class="col-sm-3 col-form-label">Content</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="content"
              v-model="content"
            />
          </div>
          <div class="form-group row">
            <label for="person-in-charge" class="col-sm-3 col-form-label"
              >Person In Charge</label
            >
            <input
              type="text"
              class="col-sm-9 form-control"
              id="person-in-charge"
              v-model="person_in_charge"
            />
          </div>
          <div class="form-group row">
            <label for="file" class="col-sm-3 col-form-label">file</label>
            <input
              type="file"
              class="col-sm-9 form-control"
              id="file"
              @change="onChange"
            />
          </div>

          <p v-if="validation" class="error">{{validation}}</p>
          <button v-if="!validation" type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data: function () {
    return {
      task: {},
      title: "",
      content: "",
      person_in_charge: "",
    };
  },

  computed:{
    validation: function() {
      if (this.title.length < 1) {
        return 'タイトルは必須です';
      }
      if (!this.content) {
        return 'コンテンツは必須です';
      }
      return '';
    }
  },

  methods: {
    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      let data2 = new FormData();
      data2.append("file_name", this.file);
      data2.append("title", this.title);
      data2.append("content", this.content);
      data2.append("person_in_charge", this.person_in_charge);
      let config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      axios
        .post("/api/task", data2, config)
        .then((res) => {
          console.log("成功 ");
          console.log(res);
          this.$router.push({ name: "task.list" });
        })
        .catch(function (error) {
          console.log("失敗");
        });
    },
  },
};
</script>