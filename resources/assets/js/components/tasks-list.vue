<template>
  <div class="container mt-3">
    <label for="name">Name: </label>
    <input class="form-control" type="text" id="name" v-model="newtask.name" placeholder="Task name">
    <label for="description">Description: </label>
    <textarea class="form-control" type="text" id="description" placeholder="Task description" v-model="newtask.description" ></textarea>

    <button class="btn btn-primary mt-2 mb-2" @click="postTask()">Save Task</button>
    
    <h2>Your Tasks</h2>
    <task-item v-for="t in tasks" v-bind:t="t" v-bind:key="t.id" v-on:request-complete="completeTask"></task-item>
   
    <button class="btn btn-secondary mt-2" @click="getTasks()">Refresh</button>

  </div>
</template>

<script>
  export default {


    mounted() {
        console.log('Component tasks-list mounted.')
    },

    data(){
      return{
        tasks: [],

        newtask:{
          name: null,
          description: null,
        },
        show: false,
        tid: ''
      };
    },

    created(){
      this.getTasks();
    },

    methods: {
      getTasks() {
          axios.get('/api/tasks')
              .then(response => this.tasks = response.data)
              .catch(error => {});
      },

      postTask() {
        axios.post('/api/tasks', this.newtask )
            .then(response => this.tasks.push(this.newtask))
            .then(console.log('Task sucessfully saved!'))
            .catch(error => {});
      },
      completeTask(tid) {
        axios.post('/api/tasks/' + tid + '/complete' )
            .then(console.log('Task completed!'))
            .then( this.getTasks())
            .catch(error => {});
      },

    }
  }
</script>
