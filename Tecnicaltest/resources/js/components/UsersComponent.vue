<template>
    <div class="col-sm-12">
        <a href="/excel/users" class="btn btn-success btn-sm mb-3">Exportar Usuarios</a>
        <a href="#" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal" data-target="#createUser">Nuevo Usuario</a>
        <table class="table table-hover table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <td>ID</td>
                    <td>Avatar</td>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>Nacimiento</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>
                        <img :src="getImage(user)" width="50px">
                    </td>
                    <td>{{ user.name + ' ' + user.lastname }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.birthday }}</td>
                    <td class="d-flex">
                        <a href="#" class="btn btn-info text-white btn-sm mr-1" v-on:click.prevent="editUser(user)" title="Editar">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteUser(user)" title="Eliminar">Borrar</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Edit Form Modal -->
        <div class="modal fade" id="updateUser">
            <form v-on:submit.prevent="updateUser(fields.id)" enctype="multipart/form-data">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Editar Usuario</h3>
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
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellido</label>
                                <input type="text" name="lastname" class="form-control" v-model="fields.lastname">
                                <span v-if="errors && errors.lastname" class="text-danger"> {{ errors.lastname[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" v-model="fields.email">
                                <span v-if="errors && errors.email" class="text-danger"> {{ errors.email[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Nacimiento</label>
                                <input type="date" name="birthday" class="form-control" v-model="fields.birthday">
                                <span v-if="errors && errors.birthday" class="text-danger"> {{ errors.birthday[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" v-model="fields.password">
                                <span v-if="errors && errors.password" class="text-danger"> {{ errors.password[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" v-model="fields.password_confirmation">
                                <span v-if="errors && errors.password_confirmation" class="text-danger"> {{ errors.password_confirmation[0] }}</span>
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
        <div class="modal fade" id="createUser">
            <form v-on:submit.prevent="createUser" enctype="multipart/form-data">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Crear Usuario</h3>
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
                                <label for="code">Nombre</label>
                                <input type="text" name="name" class="form-control" v-model="fields.name">
                                <span v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellido</label>
                                <input type="text" name="lastname" class="form-control" v-model="fields.lastname">
                                <span v-if="errors && errors.lastname" class="text-danger"> {{ errors.lastname[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" v-model="fields.email">
                                <span v-if="errors && errors.email" class="text-danger"> {{ errors.email[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Nacimiento</label>
                                <input type="date" name="birthday" class="form-control" v-model="fields.birthday">
                                <span v-if="errors && errors.birthday" class="text-danger"> {{ errors.birthday[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" v-model="fields.password">
                                <span v-if="errors && errors.password" class="text-danger"> {{ errors.password[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" v-model="fields.password_confirmation">
                                <span v-if="errors && errors.password_confirmation" class="text-danger"> {{ errors.password_confirmation[0] }}</span>
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
            this.getUsers();
        },
        data() {
            return {
                users: {},
                items: {},
                fields: {
                    'id'    : null,
                    'name'  : null,
                    'email'  : null,
                    'password' : null,
                    'lastname' : null,
                    'birthday'  : null,
                    'avatar'    : null,
                    'password_confirmation' : null
                },
                errors: {}
            }
        },
        methods: {
            getUsers: function () {
                var urlUsers = '/users';
                axios.get(urlUsers).then(response => {
                    this.users = response.data;
                });
            },
            getImage: function (user) {
                return '/storage/' + user.avatar;
            },
            onFileChange(e){
                this.fields.avatar = e.target.files[0];
            },
            createUser: function () {
               
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                var formData = new FormData();
                    formData.append('id', this.fields.id)
                    formData.append('name', this.fields.name)
                    formData.append('email', this.fields.email)
                    formData.append('password', this.fields.password)
                    formData.append('lastname', this.fields.lastname)
                    formData.append('birthday', this.fields.birthday)
                    formData.append('avatar', this.fields.avatar)
                    formData.append('password_confirmation', this.fields.password_confirmation)

                var urlUser = 'users';
                axios.post(urlUser, formData, config).then(response => {
                    this.getUsers();
                    this.fields = {};
                    this.errors = {};
                    $('#createUser').modal('hide');
                    this.$toastr.success('Usuario Creado Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            editUser: function (user) {
                this.fields = {
                    'id'    : user.id,
                    'name'  : user.name,
                    'email'  : user.email,
                    'password' : null,
                    'lastname'  : user.lastname,
                    'birthday' : user.birthday,
                    'avatar'    : user.avatar,
                    'password_confirmation' : null
                };
                $('#updateUser').modal('show');
            },
            updateUser: function (id) {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                var urlUser = 'users/' + id;
                axios.put(urlUser, this.fields, config).then(response => {
                    this.getUsers();
                    this.fields = {};
                    this.errors = {};
                    $('#updateUser').modal('hide');
                    this.$toastr.success('Usuario Actualizado Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
            deleteUser: function (user) {
                var urlUser = 'users/' + user.id;
                axios.delete(urlUser).then(response => {
                    this.getUsers();
                    this.$toastr.success('Usuario Eliminado');
                });
            }
        },
        mounted() {
            console.log('Users mounted.')
        }
    }
</script>
