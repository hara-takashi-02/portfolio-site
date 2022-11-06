<template>
  <div class="container">
    <section class="table--test">
      <h2 class="c-title">
        テスト
        <router-link v-bind:to="{ name: 'task.create' }">
          <button class="btn btn-success">ADD</button>
        </router-link>
      </h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Person In Charge</th>
            <th scope="col">img</th>
            <th scope="col">Show</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>

        <!--<tbody>-->

        <draggable
          v-model="tasksNew"
          :options="options"
          handle=".handle"
          @end="endSort"
          element="tbody"
        >
          <tr v-for="(task, index) in tasksNew" :key="index">
            <th scope="row">{{ task.id }}:ソート{{ task.task_sort }}</th>
            <td class="handle">{{ task.title }}</td>
            <!--handleドラッグで動く-->
            <td>{{ task.content }}</td>
            <td>{{ task.person_in_charge }}</td>
            <td>
              <img
                v-if="task.file_path"
                :src="'/storage/' + task.file_path"
                alt=""
              />
            </td>
            <td>
              <router-link
                v-bind:to="{ name: 'task.show', params: { taskId: task.id } }"
              >
                <button class="btn btn-primary">Show</button>
              </router-link>
            </td>
            <td>
              <router-link
                v-bind:to="{ name: 'task.edit', params: { taskId: task.id } }"
              >
                <button class="btn btn-success">Edit</button>
              </router-link>
            </td>
            <td>
              <button class="btn btn-danger" v-on:click="deleteTask(task.id)">
                Delete
              </button>
            </td>
          </tr>
        </draggable>

        <!--</tbody>-->
      </table>
    </section>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  // tasks配列は、最初は空
  components: { draggable },
  props: ["tasks"],

  data: function () {
    return {
      //tasks: [],
      tasksNew: this.tasks,
      options: {
        animation: 200,
      },
    };
  },
  props: ["propTasks"],

  methods: {
    // API経由で全タスクを取得
    getTasks() {
      axios
        .get("/api/task")
        .then((res) => {
          this.tasksNew = res.data;
          console.log("成功");
          console.log(res);
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },
    // API経由で指定IDのタスクを削除
    deleteTask(id) {
      axios
        .delete("/api/task/" + id)
        .then((res) => {
          console.log("成功");
          console.log(res);
          this.getTasks();
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },

    //  新しいthis.itemsの更新処理
    endSort(event) {
      //console.log(event);
      //console.log(event.newDraggableIndex);
      this.tasksNew.map((task, index) => {
        task.order = index + 1;
        //console.log(task.order);
      });
      console.log(this.tasksNew);
      axios
        .put("/api/task/", {
          tasks: this.tasksNew,
        })
        .then((res) => {
          console.log("成功");
          console.log(res);
        })
        .catch(function (error) {
          console.log("失敗");
          console.log(error);
        });
    },
  },

  //props: ['propItems'],
  //マウントし終わったらAPIでタスク取得する。
  mounted() {
    //this.tasks = this.propTasks;
    this.getTasks();
  },
};
</script>
<style>
tbody > div {
  width: max-content;
}
</style>