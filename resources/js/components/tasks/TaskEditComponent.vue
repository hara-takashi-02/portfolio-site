<template>
  <div class="container edit--test">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">ID</label>
            <input
              type="text"
              class="col-sm-9 form-control-plaintext"
              readonly
              id="id"
              v-model="task.id"
            />
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="title"
              v-model="task.title"
            />
          </div>
          <div class="form-group row">
            <label for="content" class="col-sm-3 col-form-label">Content</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="content"
              v-model="task.content"
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
              v-model="task.person_in_charge"
            />
          </div>

          <div class="form-group row">
            <label for="file" class="col-sm-3 col-form-label">file</label>
            <input
              type="file"
              class="col-sm-9 form-control"
              id="file"
              name="file"
              @change="onChange"
            />

            <img v-if="task.file_path" :src="'/storage/'+task.file_path" alt="">
          </div>

          <button type="submit" class="btn btn-primary" @click="displayUpdate(task)">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  props: {
    taskId: [String, Number],
  },
  data: function () {
    return {
      task: {},
      title: "",
      content: "",
      person_in_charge: "",
    };
  },
  methods: {
    getTask() {
      axios.get("/api/task/" + this.taskId)
      .then((res) => {
        this.task = res.data;
        console.log("成功 ");
        console.log(res);
      })
      .catch(function (error) {
        console.log("失敗");
        console.log(error);
      });
    },

  displayUpdate(task) {
    this.updateTitle = task.title;
    this.updateContent = task.content;
    this.updatePerson = task.person_in_charge;
  },

    onChange(event) {
      this.file = event.target.files[0];
    },
    submit() {
      
      let data2 = new FormData();
      data2.append("file_name", this.file);
      data2.append("title", this.updateTitle);
      data2.append("content", this.updateContent);
      data2.append("person_in_charge", this.updatePerson);

      let config = {
        headers: {
          "content-type": "multipart/form-data",
          'X-HTTP-Method-Override': 'PUT',
        },
      };

      axios.post("/api/task/" + this.taskId, data2, config)
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
    this.getTask();
  },
};

</script>