<template>
    <div class="col-sm-12">
        <a href="#" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal" data-target="#createCategory">Nueva Categoria</a>
        <table class="table table-hover table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <td>ID</td>
                    <td>Codigo</td>
                    <td>Nombre</td>
                    <td>Descripcion</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.code }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.description }}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-info text-white btn-sm mr-1" v-on:click.prevent="editCategory(category)" title="Editar">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteCategory(category)" title="Eliminar">Borrar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="updateCategory">
            <form v-on:submit.prevent="updateCategory(fields.id)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Editar Categoria</h3>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="code">Codigo</label>
                                <input type="text" name="code" class="form-control" v-model="fields.code">
                                <span v-if="errors && errors.code" class="text-danger"> @{{ errors.code[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> @{{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Descripcion</label>
                                <input type="text" name="description" class="form-control" v-model="fields.description">
                                <span v-if="errors && errors.description" class="text-danger"> @{{ errors.description[0] }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="createCategory">
            <form v-on:submit.prevent="createCategory">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Crear Categoria</h3>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="code">Codigo</label>
                                <input type="text" name="code" class="form-control" v-model="fields.code">
                                <span v-if="errors && errors.code" class="text-danger"> @{{ errors.code[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> @{{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Descripcion</label>
                                <input type="text" name="description" class="form-control" v-model="fields.description">
                                <span v-if="errors && errors.description" class="text-danger"> @{{ errors.description[0] }}</span>
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
            this.getCategories();
        },
        data() {
            return {
                categories: {},
                fields: {},
                errors: {}
            }
        },
        methods: {
            getCategories: function () {
                var urlCategories = 'categories';
                axios.get(urlCategories).then(response => {
                    this.categories = response.data;
                });
            },
            getImage: function (category) {
                return '/storage/' + category.photo;
            },
            createCategory: function () {
                var urlCategory = 'categories';
                axios.post(urlCategory, this.fields).then(response => {
                    this.getCategories();
                    this.fields = {};
                    this.errors = {};
                    $('#createCategory').modal('hide');
                    this.$toastr.success('Categoria Creada Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            editCategory: function (category) {
                this.fields = {
                    'id'    : category.id,
                    'code'  : category.code,
                    'name'  : category.name,
                    'photo' : category.photo,
                    'description' : category.description
                };
                $('#updateCategory').modal('show');
            },
            updateCategory: function (id) {
                var urlCategory = 'categories/' + id;
                axios.put(urlCategory, this.fields).then(response => {
                    this.getCategories();
                    this.fields = {};
                    this.errors = {};
                    $('#updateCategory').modal('hide');
                    this.$toastr.success('Categoria Actualizada Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            deleteCategory: function (category) {
                var urlCategory = 'categories/' + category.id;
                axios.delete(urlCategory).then(response => {
                    this.getCategories();
                    this.$toastr.success('Categoria Eliminada');
                });
            }
        },
        mounted() {
            console.log('Categories mounted.')
        }
    }
</script>
