<template>
  <div class="container-fluid">
      <p>{{t.name}} <button @click="showDetails()" v-if="!show"><small>show details</small></button><button @click="hideDetails()" v-if="show"><small>hide details</small></button></p>
      <div id="details" v-if="show">
        <p>Description: {{t.description}}</p>
        <p v-if="t.completed">Completed</p>
        <p v-else>Pending</p>
        <button @click="requestComplete()" class="btn btn-warning">Complete</button> 
      </div>
      <hr>
  </div>
</template>

<script>
export default{
  // DATA //
  props: ['t'],

  data(){
    return{
      show: false,
    }
  
  },

  // METHODS //
  methods:{
    
    showDetails(){
      this.show = true;
    },
    hideDetails(){
      this.show = false;
    },
    requestComplete(){
    //emit event for parent component task-list
      this.$emit('request-complete', this.t.id);
      console.log('Event request-complete emitted from task-item component.')

    },
  },

  // EVENTS //
  mounted() {
    console.log('Component task-item mounted.')
  },

}

</script>