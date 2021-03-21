<template>
    <div class="modal fade" id="updateProduct">
        <form method="POST" v-on:submit.prevent="updateProduct(fields.id)">
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
                                <input type="file" name="photo" class="form-control">
                                <span v-if="errors && errors.photo" class="text-danger"> @{{ errors.photo[0] }}</span>
                            </div>
                            <div class="ml-2">
                                <img :src="getImage(fields)" width="100px">
                            </div>
                        </div>
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
</template>

<script>
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
            editProduct: function (product) {
                this.fields = {
                    'id'    : product.id,
                    'code'  : product.code,
                    'name'  : product.name,
                    'photo' : product.photo,
                    'description' : product.description
                };
                $('#updateProduct').modal('show');
            },
            updateProduct: function (id) {
                var urlProduct = 'products/' + id;
                axios.put(urlProduct, this.fields).then(response => {
                    this.getProducts();
                    this.fields = {};
                    this.errors = {};
                    $('#updateProduct').modal('hide');
                    this.$toastr.success('Producto Actualizado Correctamente');
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
