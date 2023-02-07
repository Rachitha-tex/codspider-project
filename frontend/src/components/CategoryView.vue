<template>
    <div>
        <h3 class="p-4">Category View</h3>

        <div class="container">
            <div class="card w-50">
                <div class="card-body">
                    <form action="" @submit.prevent="save">
                   <div class="row">
                <div class="col-md-6">
                    <label for="Name" class="form-label fw-bold">Category Name</label>
                    <input type="text" class="form-control w-100" name="cat_name" v-model="category.category_name">

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
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories" :key="category.id">
                        <td>{{ category.category_name }}</td>
                        <td>{{ category.slug }}</td>
                        <td>
                         <button class="btn btn-warning" @click="edit(category)">Edit</button>
                        <button class="btn btn-danger ml-5"  @click="deleteData(category)">Delete</button> 
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
                category:{
                    id:'',
                    category_name:''
                },
                successMsg:'',
                categories:[],
                createMode:true
            }
        },
        //create category
        created(){
            this.loadCategeory()
        },
        methods:{
        //submit or post category data
            async submitCategory(){
                  await axios.post('http://127.0.0.1:8000/api/categories',this.category) 
                  .then(resp=>{
                    if(resp.status===200){
                        this.successMsg='Item added successfull!!'
                    }
                  })
            },
            //get all the catgeories saved
            async loadCategeory(){
                await axios.get('http://127.0.0.1:8000/api/categories').
                then(resp=>this.categories=resp.data)
                .catch(error=>console.log(error))
            },
            //saving category
            save(){
                if(this.category.id == ''){
                    this.submitCategory()
                    this.loadCategeory()
                    this.category.category_name=''
                    } else{
                        this.updateCategory()
                    }  
            },
            //edit the category
            edit(category){
                this.category=category
                this.createMode=false
            },

            //update category
            async updateCategory(){
                await axios.put('http://127.0.0.1:8000/api/categories/'+this.category.id,this.category)
                .then(resp=>{
                    if(resp.status===200){
                        this.successMsg='Item Updated successfull!!'
                        this.category.category_name=''
                        this.createMode=true
                    this.loadCategeory();
                    }
                 
                })
            },
            //delete category
            async deleteData(category){
            if(confirm('Are sure deleted ?')){
                await axios.delete(`http://127.0.0.1:8000/api/categories/`+category.id)
                this.successMsg='Item Deleted successfull!!'
          
            }
            this.loadCategeory();
           }
        }
    }
</script>

<style scoped>

</style>