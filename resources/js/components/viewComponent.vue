<template>
  <div class="container">
    <table class="table table-hover">

      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Content</th>
          <th scope="col">Person In Charge</th>
          <th scope="col">Show</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>

      <tbody>

        <tr v-for="(task, index) in tasks" :key="index">
            <th scope="row">{{ task.id }}</th>
            <td>{{ task.title }}</td>
            <td>{{ task.content }}</td>
            <td>{{ task.person_in_charge }}</td>
        </tr>

      </tbody>
    </table>
  </div>
</template>

<script>
    export default {   
        // tasks配列は、最初は空
        data: function () {
            return {
                tasks: []
            }
        },
        methods: {
            // API経由で全タスクを取得
            getTasks() {
                axios.get('/api/task')
                    .then((res) => {
                        this.tasks = res.data;
                    });
            }
        },
        //マウントし終わったらAPIでタスク取得する。
        mounted() {
            this.getTasks();
        }
    }
</script>