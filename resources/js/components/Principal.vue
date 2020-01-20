<template>
  <div class="c-body">
    <main class="c-main">
      <div class="container-fluid">
        <div class="fade-in">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
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
                              <option value="usuarios.nombre">Usuario</option>
                              <option value="departamentos.nombre">Departamento</option>
                              <option value="sucursals.nombre">Sucursal</option>
                              <option value="empresas.nombre">Empresa</option>
                              <option value="usuarios.email">Correo</option>
                              <option value="usuarios.celular">Celular</option>
                              <option value="usuarios.interno">Interno</option>
                              <option value="usuarios.corto">Corto</option>
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
                          <th>Nº</th>
                          <th>Nombre</th>
                          <th>Empresa</th>
                          <th>Sucursal</th>
                          <th>Departamento</th>
                          <th>Email</th>
                          <th>Interno</th>
                          <th>Celular</th>
                          <th>Corto</th>

                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(data,index) in array_data" :key="data.id">
                          <td>{{ index+1 }}</td>
                          <td>{{ data.nombre }}</td>
                          <td>{{ data.empresa.nombre }}</td>
                          <td>{{ data.sucursal.nombre }}</td>
                          <td>{{ data.departamento.nombre }}</td>
                          <td>{{ data.email }}</td>
                          <td>{{ data.interno }}</td>
                          <td>{{ data.celular }}</td>
                          <td>{{ data.corto }}</td>
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
      direccion_ip: "",
      nombre: "",
      email: "",
      celular: "",
      corto: "",
      interno: "",
      empresa_id: 0,
      array_empresa:[],
      departamento_id: 0,
      opcion: "usuarios.nombre",
      url_ctrl: "principal_controller",
      array_data: [],
      titulo_modal: "",
      array_departamento: [],
      vue_departamento: {
        id: 0,
        nombre: ""
      },
      sucursal_id: 0,
      array_sucursal: [],
      vue_sucursal: {
        id: 0,
        nombre: ""
      },
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
      nombre_vista: "Usuario"
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
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },   
  }
};
</script>