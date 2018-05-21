<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        <ul>
                            <li v-for="task in tasks" v-text="task"></li>
                        </ul>

                        <input type="text" v-model="newTask" @blur="addTask">
                        <button @onclick="addTask()">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      newTask: "",
      project:[
                {'id':1}
      ]
    };
  },
  mounted() {
    
  },
  created() {

    
    axios
      .get("/api/projects/1")
      .then(result => {        
        this.tasks = result.data;
      })
      .catch(err => {

      });

    //could be called as e => (and read all properties of e)
    window.Echo.private("tasks." + this.project.id).
    listen("TaskCreated",({ task }) => {
        this.tasks.push(task.body);
      }
    );
  },
  methods: {
    addTask() {
      axios.post("/api/projects/1/tasks", { body: this.newTask });
      this.tasks.push(this.newTask);
      this.newTask = "";
    }
  }
}; 
</script>
