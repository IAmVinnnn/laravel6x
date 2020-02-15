<template>
  <div id="app">
    <div class="heading">
      <h1>Cruds</h1>
    </div>
    <crud-component
      v-for="crud in cruds"
      v-bind="crud"
      :key="crud.id"
      @update="update"
      @delete="del"
    ></crud-component>
    <div>
      <button class="btn btn-sm btn-primary" @click="create">Add</button>
    </div>

    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-box" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Create New Box
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Create Client Form -->
                    <form role="form">
                        <!-- Name -->   
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input id="create-client-name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Color</label>
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option>Red</option>
                                    <option>Green</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="store">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
  function Crud({ id, color, name}) {
    this.id = id;
    this.color = color;
    this.name = name;
  }

  import CrudComponent from './CrudComponent.vue';

  export default {
    data() {
      return {
        cruds: [],
        mute: false
      }
    },
    methods: {
      async create() {
        // $('#modal-create-box').modal('show');
        this.mute = true;
        const { data } = await window.axios.get('/api/cruds/create');
        this.cruds.push(new Crud(data));
        this.mute = false;
      },
      async read() {
        // To do
        this.mute = true;
        const { data } = await window.axios.get('/api/cruds');
        data.forEach(crud => this.cruds.push(new Crud(crud)));
        this.mute = false;
      },
      async update(id, color) {
        // To do
        this.mute = true;
        await window.axios.put(`/api/cruds/${id}`, {color});
        this.cruds.find(crud => crud.id === id).color = color;
        this.mute = false;
      },
      async del(id) {
        // To do
        this.mute = true;
        await window.axios.delete(`/api/cruds/${id}`);
        let index = this.cruds.findIndex(crud => crud.id === id);
        this.cruds.splice(index,1);
        this.mute = false;
      },
      async store(){
        // To do
        // this.mute = true;
        // const { data } = await window.axios.get('/api/cruds/create');
        // this.cruds.push(new Crud(data));
        // this.mute = false;
      }
    },
    created() {
        this.read();
    },
    components: {
      CrudComponent
    },
    watch: {
        mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
        }
    }
  }
</script>
<style>
    .heading h1 {
        margin-bottom: 0;
    }
</style>