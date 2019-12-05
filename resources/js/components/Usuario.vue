<template>
  <div class="c-body">
    <main class="c-main">
      <div class="container-fluid">
        <div class="fade-in">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-align-justify"></i> Usuario
                  <button
                    type="button"
                    data-toggle="modal"
                    data-target="#ModalLong"
                    class="btn btn-secondary"
                    @click="abrirModal('registrar')"
                  >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="col-md-10">
                          <div class="input-group">
                            <select class="form-control col-md-3">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input type="text" class="form-control" @input="listar(1,buscar)" v-model="buscar" placeholder="Buscar...." />
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-primary" @click="listar(1,buscar)">
                                <i class="fa fa-search"></i>
                                Buscar
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table table-responsive table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Sucursal</th>
                        <th>Departamento</th>
                        <th>Direccion IP</th>
                        <th>Usuario</th>
                        <th>Usuario SAP</th>
                        <th>Usuario AD</th>
                        <th>Password AD</th>
                        <th>Email Office</th>
                        <th>Password Office</th>
                        <th>Telefono IP</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="data in array_data" :key="data.id">
                        <td>
                          <span class="badge badge-success">
                            {{
                            data.id
                            }}
                          </span>
                        </td>
                        <td>{{ data.sucursal }}</td>
                        <td>{{ data.departamento }}</td>
                        <td>{{ data.direccion_ip }}</td>
                        <td>{{ data.usuario }}</td>
                        <td>{{ data.usuario_sap }}</td>
                        <td>{{ data.usuario_ad }}</td>
                        <td>{{ data.password_ad }}</td>
                        <td>{{ data.email_office }}</td>
                        <td>{{ data.password_office }}</td>
                        <td>{{ data.telefono_ip }}</td>
                        <td>
                          <button
                            type="button"
                            data-toggle="modal"
                            data-target="#ModalLong"
                            class="btn btn-warning btn-sm"
                            @click="abrirModal('actualizar',data)"
                          >
                            <i class="cil-pencil"></i>
                          </button>
                          &nbsp;
                          <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            @click="eliminar(data.id)"
                          >
                            <i class="cil-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <nav>
                    <ul class="pagination">
                      <li class="page-item" v-if="pagination.current_page > 1">
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="cambiarPagina(pagination.current_page - 1,buscar)"
                        >Ant</a>
                      </li>
                      <li
                        class="page-item"
                        v-for="page in pagesNumber"
                        :key="page"
                        :class="[page == isActived ? 'active' : '']"
                      >
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="cambiarPagina(page, buscar)"
                          v-text="page"
                        ></a>
                      </li>
                      <li
                        class="page-item"
                        v-if="
                                    pagination.current_page <
                                        pagination.last_page
                                "
                      >
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page + 1,
                                            buscar
                                        )
                                    "
                        >Sig</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
        </div>
      </div>
    </main>
    <!-- modal empieza -->
    <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      id="ModalLong"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Modal title</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div :class="'modal-body '+activarValidate">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
             
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Direccion IP</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="direccion_ip"
                    placeholder="Direccion IP......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="usuario"
                    placeholder="Usuario......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Usuario_Sap</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="usuario_sap"
                    placeholder="Usuario_Sap......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Usuario_AD</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="usuario_ad"
                    placeholder="Usuario_AD......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Password_AD</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="password_ad"
                    placeholder="Password_AD......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Email_Office</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="email_office"
                    placeholder="Email_Office......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Password_Office</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="password_office"
                    placeholder="Password_Office......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Telefono_IP</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="telefono_ip"
                    placeholder="Telefono_IP......"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Departamento</label>
                <div class="col-md-9">
                  <v-select
                    @search="select_departamento"
                    label="nombre"
                    :options="array_departamento"
                    placeholder="Departamento..."
                    @input="get_departamento"
                    v-model="vue_departamento"
                  />
                </div>
              </div>
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Sucursal</label>
                <div class="col-md-9">
                  <v-select
                    @search="select_sucursal"
                    label="nombre"
                    :options="array_sucursal"
                    placeholder="Sucursal..."
                    @input="get_sucursal"
                    v-model="vue_sucursal"
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="button" v-if="tipoAccion==1" @click="registrar()">Save changes</button>
            <button class="btn btn-primary" type="button" v-else @click="actualizar()">Update changes</button>
          </div>
        </div>
        <!-- /.modal-content-->
      </div>
      <!-- /.modal-dialog-->
    </div>
    <!-- modal termina -->
  </div>
</template>
<script>
import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
Vue.component("v-select", vSelect);

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      id: 0,
      direccion_ip: "",
      usuario:'',
      usuario_sap:'',
      usuario_ad:'',
      password_ad:'',
      email_office:'',
      password_office:'',
      telefono_ip:'',
      departamento_id:0,
      array_departamento:[],
      vue_departamento:{
        id:0,
        nombre:''
      },
      sucursal_id:0,
      array_sucursal:[],
      vue_sucursal:{
        id:0,
        nombre:''
      },
      url_ctrl: "usuario",
      array_data: [],
      tituloModal: "",
      tipoAccion: 0,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      buscar: "",
      activarValidate: "",
      mensaje: ""
    };
  },
  mounted() {
    this.listar(1, "");
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    cambiarPagina(page, buscar) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      listar(page, buscar);
    },
    listar(page, buscar) {
      var url = this.url_ctrl + "?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(resp => {
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eventoAlerta(icono, mensaje) {
      Swal.fire({
        position: "center",
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
      });
    },
    registrar() {
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      axios
        .post(this.url_ctrl + "/registrar", {
          sucursal_id: this.sucursal_id,
          departamento_id:this.departamento_id,
          direccion_ip:this.direccion_ip,
          usuario:this.usuario,
          usuario_sap:this.usuario_sap,
          usuario_ad:this.usuario_ad,
          password_ad:this.password_ad,
          email_office:this.email_office,
          password_office:this.password_office,
          telefono_ip:this.telefono_ip
        })
        .then(resp => {
          this.eventoAlerta("success", "Guardado Exitosamente");
           $('#ModalLong').modal('hide');
          // $('.modal-backdrop').remove();
          this.listar(1, "");
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizar() {
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      axios
        .put(this.url_ctrl + "/actualizar", {
          id: this.id,
          sucursal_id: this.sucursal_id,
          departamento_id:this.departamento_id,
          direccion_ip:this.direccion_ip,
          usuario:this.usuario,
          usuario_sap:this.usuario_sap,
          usuario_ad:this.usuario_ad,
          password_ad:this.password_ad,
          email_office:this.email_office,
          password_office:this.password_office,
          telefono_ip:this.telefono_ip
        })
        .then(resp => {
          this.eventoAlerta("success", "Actualizado Exitosamente");
          $('#ModalLong').modal('hide');
          // $('.modal-backdrop').remove();
          // console.log($("#ModalLong").modal("hide"));
          this.listar(1, "");
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminar(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Eliminar?",
          text: "Si Elimina no estara en la Lista!",
          icon: "error",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            axios
              .delete(this.url_ctrl + "/eliminar_" + id)
              .then(resp => {
                this.eventoAlerta("success", "Eliminado Exitosamente");
                this.listar(1, "");
              })
              .catch(error => {
                console.log(error);
              });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            this.eventoAlerta("error", "Cancelado");
          }
        });
    },
    select_departamento(search, loading) {
      loading(true);
      var url = "departamento/select?buscar=" + search;
      axios
        .get(url)
        .then(resp => {
          let respuesta = resp.data;
          q: search;
          this.array_departamento = respuesta.table;
          loading(false);
        })
        .catch(error => {
          console.log(error);
        });
    },
    get_departamento(val1) {
      try {
        this.departamento_id = val1.id;
      this.vue_departamento={
        id:val1.id,
        nombre:val1.nombre
      };
      } catch{
        this.departamento_id = 0;
      this.vue_departamento={
        id:0,
        nombre:''
      };
      }
    },
      select_sucursal(search, loading) {
      loading(true);
      var url = "sucursal/select?buscar=" + search;
      axios
        .get(url)
        .then(resp => {
          let respuesta = resp.data;
          q: search;
          this.array_sucursal = respuesta.table;
          loading(false);
        })
        .catch(error => {
          console.log(error);
        });
    },
    get_sucursal(val1) {
      try {
        this.sucursal_id = val1.id;
      this.vue_sucursal={
        id:val1.id,
        nombre:val1.nombre
      };
      } catch{
        this.sucursal_id = 0;
      this.vue_sucursal={
        id:0,
        nombre:''
      };
      }
    },
    abrirModal(accion, data = []) {
      // $("#ModalLong").modal('show')
      switch (accion) {
        case "registrar": {
          this.tituloModal = "Registrar Usuario";
          this.limpiar();
          this.tipoAccion = 1;
          break;
        }
        case "actualizar": {
          this.tituloModal = "Actualizar Usuario";
          this.tipoAccion = 2;
          this.id = data.id;
          this.sucursal_id= data.sucursal_id;
          this.departamento_id=data.departamento_id;
          this.direccion_ip=data.direccion_ip;
          this.usuario=data.usuario;
          this.usuario_sap=data.usuario_sap;
          this.usuario_ad=data.usuario_ad,
          this.password_ad=data.password_ad;
          this.email_office=data.email_office;
          this.password_office=data.password_office;
          this.telefono_ip=data.telefono_ip;
          this.vue_departamento={
            id:data.departamento_id,
            nombre:data.departamento
          }
          this.vue_sucursal={
            id:data.sucursal_id,
            nombre:data.sucursal
          }
          break;
        }
      }
    },
    limpiar() {
      this.id = 0;
      this.buscar = "";
      this.sucursal_id= '';
      this.departamento_id='';
      this.direccion_ip='';
      this.usuario='';
      this.usuario_ad='';
      this.usuario_sap='';
      this.password_ad='';
      this.email_office='';
      this.password_office='';
      this.telefono_ip='';
      this.vue_departamento={
        id:0,
        nombre:''
      };
      this.vue_sucursal={
        id:0,
        nombre:''
      };
      this.array_departamento=[];
      this.array_sucursal=[];
      this.activarValidate = "";
    },
    validar() {
      if (!this.usuario) {
        this.mensaje = "Ingrese el Nombre";
        return true;
      }

      return false;
    }
  }
};
</script>