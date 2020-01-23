<template>
  <div class="c-body">
    <main class="c-main">
      <div class="container-fluid">
        <div class="fade-in">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-align-justify"></i>
                  {{ nombre_vista }}
                  <button
                    type="button"
                    data-toggle="modal"
                    data-target="#ModalLong"
                    class="btn btn-secondary"
                    @click="abrirModal('registrar')"
                  >
                    <i class="cil-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <div class="col-md-12">
                          <!-- <select
                            class="form-control col-2"
                            v-model="pagina"
                            @click="listar(1,buscar)"
                          >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                          </select>-->
                          <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Fecha Inicio</label>
                            <div class="col-md-3">
                              <input
                                type="date"
                                v-model="fecha_inicio"
                                placeholder="fecha......"
                                class="form-control"
                              />
                            </div>

                            <label class="col-md-1 form-control-label" for="text-input">Fecha Fin</label>
                            <div class="col-md-3">
                              <input
                                type="date"
                                v-model="fecha_fin"
                                placeholder="fecha......"
                                class="form-control"
                              />
                            </div>
                            <div class="col-md-4">
                              <button
                                type="button"
                                class="btn btn-success"
                                @click="descargar_excel()"
                              >
                                Excel
                                <i class="cil-grid"></i>&nbsp;
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <select
                            class="form-control col-2"
                            v-model="pagina"
                            @click="listar(1,buscar)"
                          >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                          </select>

                          <div class="input-group">
                            <select class="form-control col-md-3" v-model="opcion">
                              <option value="usuarios.nombre">Usuario</option>
                              <option value="users.name">Admin</option>
                              <option value="servicios.fecha">Fecha</option>
                              <option value="departamentos.nombre">Departamentos</option>
                              <option value="sucursals.nombre">Sucursal</option>
                              <option value="empresas.nombre">Empresa</option>
                            </select>
                            <input
                              type="text"
                              class="form-control"
                              @keyup="listar(1,buscar)"
                              v-model="buscar"
                              placeholder="Buscar...."
                            />
                            <span class="input-group-append">
                              <button
                                type="submit"
                                class="btn btn-primary"
                                @click="listar(1,buscar)"
                              >
                                <i class="cil-search"></i>
                                Buscar
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Usuario</th>
                          <th>Admin</th>
                          <th>Empresa</th>
                          <th>Sucursal</th>
                          <th>Departamento</th>
                          <th>Fecha</th>
                          <th>Descripcion</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="data in array_data" :key="data.id">
                          <td>{{ data.id }}</td>
                          <td>{{ data.usuario.nombre }}</td>
                          <td>{{ data.user.name }}</td>
                          <td>{{ data.empresa }}</td>
                          <td>{{ data.sucursal }}</td>
                          <td>{{ data.departamento }}</td>
                          <td>{{ data.fecha }}</td>
                          <td>{{ data.descripcion }}</td>
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
                  </div>
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
            <h4 class="modal-title">{{ titulo_modal }}</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div :class="'modal-body '+activarValidate">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                <div class="col-md-9">
                  <v-select
                    @search="select_usuario"
                    label="nombre"
                    :options="array_usuario"
                    placeholder="Usuario..."
                    @input="get_usuario"
                    v-model="vue_usuario"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                <div class="col-md-9">
                  <input
                    type="date"
                    v-model="fecha"
                    placeholder="fecha......"
                    class="form-control"
                    @keyup.enter="insertar()"
                    required
                  />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                <div class="col-md-9">
                  <textarea
                    rows="4"
                    cols="50"
                    type="text"
                    v-model="descripcion"
                    placeholder="Descripcion......"
                    class="form-control"
                    @keyup.enter="insertar()"
                    required
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button
              class="btn btn-primary"
              type="button"
              v-if="tipoAccion==1"
              @click="registrar()"
            >Save changes</button>
            <button
              class="btn btn-primary"
              type="button"
              v-else
              @click="actualizar()"
            >Update changes</button>
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
import moment from "moment";
Vue.component("v-select", vSelect);

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  // props: {
  //   user: Object
  // },
  data() {
    return {
      id: 0,
      fecha: moment().format("YYYY-MM-DD"),
      fecha_inicio: moment().format("YYYY-MM-DD"),
      fecha_fin: moment().format("YYYY-MM-DD"),
      descripcion: "",
      usuario_id: 0,
      array_usuario: [],
      vue_usuario: {
        id: 0,
        nombre: ""
      },
      opcion: "usuarios.nombre",
      url_ctrl: "servicio_controller",
      array_data: [],
      titulo_modal: "",
      tipoAccion: 0,
      pagina: 5,
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
      mensaje: "",
      nombre_vista: "Servicio"
    };
  },
  mounted() {
    this.listar(1, this.buscar);
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
      this.listar(page, buscar);
    },
    listar(page, buscar) {
      var url =
        this.url_ctrl +
        "?page=" +
        page +
        "&opcion=" +
        this.opcion +
        "&pagina=" +
        this.pagina +
        "&buscar=" +
        buscar;
      axios
        .get(url)
        .then(resp => {
          // console.log(resp.data.data);
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
        })
        .catch(error => {
          console.log(error);
        });
    },
    descargar_excel() {
      window.open("reporte/servicio");
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
          usuario_id: this.usuario_id,
          fecha: this.fecha,
          descripcion: this.descripcion
        })
        .then(resp => {
          this.eventoAlerta("success", "Guardado Exitosamente");
          $("#ModalLong").modal("hide");
          // $('.modal-backdrop').remove();
          this.listar(1, this.buscar);
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
          usuario_id: this.usuario_id,
          fecha: this.fecha,
          descripcion: this.descripcion
        })
        .then(resp => {
          this.eventoAlerta("success", "Actualizado Exitosamente");
          $("#ModalLong").modal("hide");
          // $('.modal-backdrop').remove();
          // console.log($("#ModalLong").modal("hide"));
          this.listar(1, this.buscar);
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
                this.listar(1, this.buscar);
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
    insertar() {
      if (this.tipoAccion == 1) {
        this.registrar();
      } else {
        this.actualizar();
      }
    },
    select_usuario(search, loading) {
      loading(true);
      var url = "usuario_controller/select?buscar=" + search;
      axios
        .get(url)
        .then(resp => {
          let respuesta = resp.data;
          q: search;
          this.array_usuario = respuesta.table;
          loading(false);
        })
        .catch(error => {
          console.log(error);
        });
    },
    get_usuario(val1) {
      try {
        this.usuario_id = val1.id;
        this.vue_usuario = {
          id: val1.id,
          nombre: val1.nombre
        };
      } catch {
        this.usuario_id = 0;
        this.vue_usuario = {
          id: 0,
          nombre: ""
        };
      }
    },

    abrirModal(accion, data = []) {
      // $("#ModalLong").modal('show')

      switch (accion) {
        case "registrar": {
          this.titulo_modal = "Registrar " + this.nombre_vista;
          this.limpiar();
          this.tipoAccion = 1;
          break;
        }
        case "actualizar": {
          this.titulo_modal = "Actualizar " + this.nombre_vista;
          this.tipoAccion = 2;
          this.id = data.id;
          this.usuario_id = data.usuario_id;
          this.fecha = data.fecha;
          this.descripcion = data.descripcion;
          this.vue_usuario = {
            id: data.usuario_id,
            nombre: data.usuario.nombre
          };
          break;
        }
      }
    },
    limpiar() {
      this.id = 0;
      this.buscar = "";

      this.fecha = moment().format("YYYY-MM-DD");
      this.vue_usuario = {
        id: 0,
        nombre: ""
      };
      this.usuario_id = 0;
      this.descripcion = "";
      this.activarValidate = "";
    },
    validar() {
      if (!this.usuario_id) {
        this.mensaje = "Seleccione el Usuario";
        return true;
      }
      if (!this.descripcion) {
        this.mensaje = "Haga una Descripcion del Servicio que Realizo";
        return true;
      }
      return false;
    }
  }
};
</script>