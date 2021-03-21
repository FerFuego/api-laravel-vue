<template>
    <div class="modal fade" id="createProduct">
        <form method="POST" v-on:submit.prevent="createProduct">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Crear Producto</h3>
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
                        <div class="form-group">
                            <label for="code">Imagen</label>
                            <input type="text" name="photo" class="form-control" v-model="fields.photo">
                            <span v-if="errors && errors.photo" class="text-danger"> @{{ errors.photo[0] }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>
            </div>
        </form>
    </div>   
</template>

<script>
    /* import axios from 'axios'
    import toastr from 'toastr'
 */
    export default {
        /* created: function () {
        },
        data() {
            return {
                products: [],
                fields: [],
                errors: []
            }
        },
        methods: {
            getProducts: function () {
                var urlProducts = 'products';
                axios.get(urlProducts).then(response => {
                    this.products = response.data;
                });
            },
            getImage: function (product) {
                return '/storage/images/' + product.photo;
            },
            createProduct: function () {
                var urlProduct = 'products';
                axios.post(urlProduct, this.fields).then(response => {
                    this.getProducts();
                    this.fields = {};
                    this.errors = {};
                    $('#createProduct').modal('hide');
                    toastr.success('Producto Creado Correctamente');
                    this.$toastr.success('Producto Creado Correctamente');
                }).catch(error => {
                    this.errors = error.response.data.errors || {}
                })
            },
        }, */
        mounted() {
            console.log('Products mounted.')
        }
    }
</script>