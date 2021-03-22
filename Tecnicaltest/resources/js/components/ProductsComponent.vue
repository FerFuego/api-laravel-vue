<template>
    <div class="col-sm-12">
        <a href="/excel/products" class="btn btn-success btn-sm mb-3">Exportar Productos</a>
        <a href="#" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal" data-target="#createProduct">Nuevo Producto</a>
        <table class="table table-hover table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <td>ID</td>
                    <td>Imagen</td>
                    <td>Codigo</td>
                    <td>Nombre</td>
                    <td>description</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>
                        <img :src="getImage(product)" width="50px">
                    </td>
                    <td>{{ product.code }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-info text-white btn-sm mr-1" v-on:click.prevent="editProduct(product)" title="Editar">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteProduct(product)" title="Eliminar">Borrar</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Edit Form Modal -->
        <div class="modal fade" id="updateProduct">
            <form v-on:submit.prevent="updateProduct(fields.id)" enctype="multipart/form-data">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Editar Producto</h3>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group d-flex">
                                <div>
                                    <label for="code">Imagen</label>
                                    <input type="file" name="photo" class="form-control" id="editPhoto" @change="onFileChange">
                                    <span v-if="errors && errors.photo" class="text-danger"> {{ errors.photo[0] }}</span>
                                </div>
                                <div class="ml-2">
                                    <img :src="getImage(fields)" width="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">Codigo</label>
                                <input type="text" name="code" class="form-control" v-model="fields.code">
                                <span v-if="errors && errors.code" class="text-danger"> {{ errors.code[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Descripcion</label>
                                <input type="text" name="description" class="form-control" v-model="fields.description">
                                <span v-if="errors && errors.description" class="text-danger"> {{ errors.description[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="categ">Categorias</label>
                                <select name="categories" class="form-control" id="updateCateg" v-model="fields.categories" multiple>
                                    <option v-for="item in items" :value="item.id" :key="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Insert Form Modal -->
        <div class="modal fade" id="createProduct">
            <form v-on:submit.prevent="createProduct" enctype="multipart/form-data">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Crear Producto</h3>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group d-flex">
                                <div>
                                    <label for="code">Imagen</label>
                                    <input type="file" name="photo" class="form-control" id="insertPhoto" @change="onFileChange">
                                    <span v-if="errors && errors.photo" class="text-danger"> {{ errors.photo[0] }}</span>
                                </div>
                                <div class="ml-2">
                                    <img :src="getImage(fields)" width="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">Codigo</label>
                                <input type="text" name="code" class="form-control" v-model="fields.code">
                                <span v-if="errors && errors.code" class="text-danger"> {{ errors.code[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Descripcion</label>
                                <input type="text" name="description" class="form-control" v-model="fields.description">
                                <span v-if="errors && errors.description" class="text-danger"> {{ errors.description[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="categ">Categorias</label>
                                <select name="categories" class="form-control" id="insertCateg" v-model="fields.categories" multiple>
                                    <option v-for="item in items" :value="item.id" :key="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    import $ from 'jquery'

    export default {
        created: function () {
            this.getProducts();
            this.getCategories();
        },
        data() {
            return {
                products: {},
                items: {},
                fields: {
                    'id'    : null,
                    'code'  : null,
                    'name'  : null,
                    'photo' : null,
                    'description' : null,
                    'categories'  : [],
                    'selected'    : null
                },
                errors: {}
            }
        },
        methods: {
            getProducts: function () {
                var urlProducts = '/products';
                axios.get(urlProducts).then(response => {
                    this.products = response.data;
                });
            },
            getCategories: function () {
                var urlCategories = '/categories';
                axios.get(urlCategories).then(response => {
                    this.items = response.data;
                });
            },
            getImage: function (product) {
                return '/storage/' + product.photo;
            },
            onFileChange(e){
                this.fields.photo = e.target.files[0];
                var url = e.target;
            },
            createProduct: function () {
               
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                var formData = new FormData();
                    formData.append('id', this.fields.id)
                    formData.append('code', this.fields.code)
                    formData.append('name', this.fields.name)
                    formData.append('photo', this.fields.photo)
                    formData.append('categories', this.fields.categories)
                    formData.append('description', this.fields.description);

                var urlProduct = 'products';
                axios.post(urlProduct, formData, config).then(response => {
                    this.getProducts();
                    this.fields = {};
                    this.errors = {};
                    $('#createProduct').modal('hide');
                    this.$toastr.success('Producto Creado Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            editProduct: function (product) {
                this.fields = {
                    'id'    : product.id,
                    'code'  : product.code,
                    'name'  : product.name,
                    'photo' : product.photo,
                    'categories'  : product.categories,
                    'description' : product.description,
                    'selected'    : product.categories,
                };
                $('#updateProduct').modal('show');
            },
            updateProduct: function (id) {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                var formData = new FormData();
                    formData.append('id', this.fields.id)
                    formData.append('code', this.fields.code)
                    formData.append('name', this.fields.name)
                    formData.append('photo', this.fields.photo)
                    formData.append('categories', this.fields.categories)
                    formData.append('description', this.fields.description);

                var urlProduct = 'products/' + id;
                axios.put(urlProduct, this.fields, config).then(response => {
                    console.log(response);
                    this.getProducts();
                    this.fields = {};
                    this.errors = {};
                    $('#updateProduct').modal('hide');
                    this.$toastr.success('Producto Actualizado Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            deleteProduct: function (product) {
                var urlProduct = 'products/' + product.id;
                axios.delete(urlProduct).then(response => {
                    this.getProducts();
                    this.$toastr.success('Producto Eliminado');
                });
            }
        },
        mounted() {
            console.log('Products mounted.')
        }
    }
</script>
