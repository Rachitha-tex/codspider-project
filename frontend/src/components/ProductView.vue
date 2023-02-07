<template>
    <div>
        <h3 class="p-4">Product View</h3>

        <div class="container">
            <div class="card w-50">
                <div class="card-body">
                    <form action="" @submit.prevent="save">
                   <div class="row">
                <div class="col-md-4">
                    <label for="Name" class="form-label fw-bold">Select Category</label>
                    <select v-model="product.category_id" class="form-select" aria-label="Default select example">
                        <option selected>Open This Select Catgeory</option>
                        <option  v-for="category in categories" :key="category.name"  :value="category.id">{{ category.category_name }}</option> 
                    </select>

                </div>
                <div class="col-md-4">
                    <label for="Name" class="form-label fw-bold">Product Name</label>
                    <input type="text" class="form-control w-100" name="cat_name" v-model="product.product_name">

                </div>
                <div class="col-md-4">
                    <label for="Name" class="form-label fw-bold">Price</label>
                    <input type="number" class="form-control w-100" name="price" v-model="product.price">

                </div>
            </div>
            <button  v-if="createMode" class="btn btn-primary mt-2 w-50" type="submit">Create</button>
            <button v-else class="btn btn-primary mt-2 w-50" type="submit">Update</button>
            
        </form>
                </div>
                <div class="card-footer">
            <div class="alert alert-success" v-show="successMsg">
               {{ successMsg }}
            </div>
        </div>
          
            </div>

            <h3 class="text-center text-danger mt-4">All Catgeories</h3>
        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.category.category_name }}</td>
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.price }}</td>

                        <td>
                         <button class="btn btn-warning" @click="edit(product)">Edit</button>
                        <button class="btn btn-danger ml-5"  @click="deleteData(product)">Delete</button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
 
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        name:'CategoryView',
        data(){
            return{
                product:{
                    id:'',
                    category_id:'',
                    product_name:'',
                    price:''
                },
                successMsg:'',
                categories:[],
                products:[],
                createMode:true
            }
        },

        //display all the categories and products when loading the page
        created(){
            this.loadCategeory()
            this.loadProducts()
        },
        methods:{
            //save new product
            save(){
                if(this.product.id===''){
                this.submitProduct();
                }
                this.updateProduct();

            },
            //submit the product to save
            async submitProduct(){
                  await axios.post('http://127.0.0.1:8000/api/products',this.product) 
                  .then(resp=>{
                    if(resp.status===200){
                        this.successMsg='Item added successfull!!'
                        this.product.category_id=''
                        this.product.product_name=''
                        this.product.price=''
                    }
                  })
            }, 
            //get all the categories saved in the db
            async loadCategeory(){
                await axios.get('http://127.0.0.1:8000/api/categories').
                then(resp=>this.categories=resp.data)
                .catch(error=>console.log(error))
            },

            //get all the product from db
            async loadProducts(){
                await axios.get('http://127.0.0.1:8000/api/products').then(resp=>this.products=resp.data)
                .catch(error=>console.log(error))
            },


            //edit the products
            edit(product){
                this.product=product
                this.createMode=false
            },
            //update products
            async updateProduct(){
                await axios.put('http://127.0.0.1:8000/api/products/'+this.product.id,this.product)
                .then(resp=>{
                    if(resp.status===200){
                        this.successMsg='Item Updated successfull!!'
                        this.products.category_name=''
                        this.createMode=true
                       this.loadProducts();
                    }
                 
                })
            },

            //delete products

            async deleteData(product){
            if(confirm('Are sure deleted ?')){
                await axios.delete(`http://127.0.0.1:8000/api/products/`+product.id)
                this.successMsg='Product Deleted successfull!!'
            this.loadProducts();

          
            }
           } 
        }
    }
</script>

<style scoped>

</style>