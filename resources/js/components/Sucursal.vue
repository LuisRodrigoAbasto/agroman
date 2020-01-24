<template>
  <div class="c-body">
    <main class="c-main">
      <div class="container-fluid">
        <div class="fade-in">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-align-justify"></i> {{ nombre_vista }}
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
                        <div class="col-md-10">
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
                            <select class="form-control col-md-3">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input type="text" class="form-control" @keyup="listar(1,buscar)" v-model="buscar" placeholder="Buscar...." />
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-primary" @click="listar(1,buscar)">
                                <i class="cil-search"></i>
                                Buscar
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table class="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="data in array_data" :key="data.id">
                        <td>
                          <!-- <span class="badge badge-success"> -->
                            {{
                            data.id
                            }}
                          <!-- </span> -->
                        </td>
                        <td>{{ data.nombre }}</td>
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
            <h4 class="modal-title">{{ titulo_modal }}</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div :class="'modal-body '+activarValidate">
            <!-- <form action method="post" enctype="multipart/form-data" class="form-horizontal"> -->
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="nombre"
                    placeholder="Nombre......"
                    class="form-control"
                    @keyup.enter="insertar()"
                    required
                  />
                </div>
              </div>
            <!-- </form> -->
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
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      id: 0,
      nombre: "",
      url_ctrl: "sucursal_controller",
      array_data: [],
      titulo_modal: "",
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
      pagina:5,
      buscar: "",
      activarValidate: "",
      mensaje: "",
      nombre_vista:"Sucursal"
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
      this.listar(page, buscar);
    },
    listar(page, buscar) {
      var url = this.url_ctrl + "?page=" + page+"&pagina=" +
        this.pagina + "&buscar=" + buscar;
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
          nombre: this.nombre
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
          nombre: this.nombre
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
    insertar(){
      if(this.tipoAccion==1)
      {
        this.registrar();
      }
      else{
        this.actualizar();
      }
    },
    // selectCategoria(search, loading) {
    //   loading(true);
    //   var url = "categoria/select?buscar=" + search;
    //   axios
    //     .get(url)
    //     .then(resp => {
    //       let respuesta = resp.data;
    //       q: search;
    //       this.array_categoria = respuesta.table;
    //       loading(false);
    //     })
    //     .catch(error => {
    //       console.log(error);
    //     });
    // },
    // getDatoCategoria(val1) {
    //   this.id_categoria = val1.id;
    //   this.categoria = val1.nombre;
    //   this.vue_categoria={
    //     id:val1.id,
    //     nombre:val1.nombre
    //   };
    // },
    abrirModal(accion, data = []) {
      // $("#ModalLong").modal('show')
      switch (accion) {
        case "registrar": {
          this.titulo_modal = "Registrar "+ this.nombre_vista;
          this.limpiar();
          this.tipoAccion = 1;
          break;
        }
        case "actualizar": {
          this.titulo_modal = "Actualizar "+ this.nombre_vista;
          this.tipoAccion = 2;
          this.id = data.id;
          this.nombre = data.nombre;
          break;
        }
      }
    },
    limpiar() {
      this.id = 0;
      this.nombre = "";
      this.buscar = "";
      this.activarValidate = "";
    },
    validar() {
      if (!this.nombre) {
        this.mensaje = "Ingrese el Nombre";
        return true;
      }
      return false;
    }
  }
};
</script>