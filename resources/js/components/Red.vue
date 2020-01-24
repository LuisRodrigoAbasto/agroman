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
                            <select class="form-control col-md-3" v-model="opcion">
                              <option value="red.ip">IP</option>
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
                  <table class="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>IP</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="data in array_data" :key="data.id">
                        <td>{{data.id}}</td>
                        <td>{{ data.ip }}</td>
                        <td>
                          <span v-if="data.estado" class="badge badge-success">LIBRE</span>
                          <span v-else class="badge badge-danger">OCUPADO</span>
                          </td>
                        <td>{{ data.descripcion }}</td>
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
  </div>
</template>
<script>
import Vue from "vue";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      
      url_ctrl: "red_controller",
      array_data: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      pagina: 5,
      buscar: "",
      activarValidate: "",
      mensaje: "",
      opcion: "red.ip",
      nombre_vista: "Red"
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
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },
    // eventoAlerta(icono, mensaje) {
    //   Swal.fire({
    //     position: "center",
    //     icon: icono,
    //     title: mensaje,
    //     showConfirmButton: false,
    //     timer: 1500
    //   });
    // },
    // generar() {
    //   axios
    //     .get(this.url_ctrl + "/generar")
    //     .then(resp => {
    //       this.eventoAlerta("success", "Guardado Exitosamente");
    //       $("#ModalLong").modal("hide");
    //       // $('.modal-backdrop').remove();
    //       this.listar(1, this.buscar);
    //     })
    //     .catch(error => {
    //       console.log(error);
    //     });
    // }
  }
};
</script>