<template>
    <div class="card">
        <h5 class="card-header">Thêm bài viết mới</h5>
        <div class="card-body">
            <div>
                <div class="form-group col-5">
                    <label>Tên bài viết (Nhỏ hơn 60 ký tự)</label>
                    <input v-model="namePosts" class="form-control" type="text"  autocomplete="off" maxlength="60" >
                </div>
                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:red;font-size: 1em">{{errors.namePosts}}</span>
                </div>    
                <div class="form-group col-4">
                    <label class="col-form-label">Danh mục</label>
                    <div class="dropdown">
                        <input class="form-control" v-model="parentName" readonly  type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <div class="dropdown-menu w-100 dropdown-category"  aria-labelledby="dropdownMenuButton">
                            <a v-for="(data)  in Categories" :key="data.value" class="dropdown-item" @click="addCategoryId(data.id,data.name)">{{data.name}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:red;font-size: 1em">{{errors.id_category}}</span>
                </div>    
                <div class="form-group col-2">
                    <label>Ảnh</label>
                    <button class="d-block  btn btn-outline-primary " style="position: relative;min-width: 100%;padding-bottom: 32%; padding-top: 32%; ">            
                        <div class="h-100 w-100 d-flex" style="position: absolute; top: 0; right: 0;">
                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" id="img" class="m-auto w-100 h-100" style="object-fit: contain;">
                        </div>
                        <div class="h-100 w-100 d-flex" style="position: absolute; top: 0; right: 0;">
                            <i class="fa fa-2x fa-solid fa-plus m-auto" ></i>
                        </div>
                        <input @change="addImg()" type="file" ref="FileImg" class="h-100 w-100" style="position: absolute; top: 0; right: 0; opacity: 0;" accept="image/*">
                    </button>
                </div>
                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:red;font-size: 1em">{{errors.img}}</span>
                </div> 
                <div class="form-group col-12">
                    <label>Tóm tắt</label>
                    <textarea v-model="summary" class="form-control col-6" rows="4" cols="50" type="text" autocomplete="off"></textarea>
                </div>
                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:red;font-size: 1em">{{errors.summary}}</span>
                </div> 
                

                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:#4dc532;font-size: 1em">{{Success}}</span>
                </div>
                <div class="row">
                    <div class="col-sm-6 pl-0">
                        <p class="text-right">
                            <button @click="UpdatePost()" class="btn btn-space btn-primary">Lưu</button>
                            <button class="btn btn-space btn-secondary" @click="Calcel(1)">Hủy</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
  data () {
    return {
        namePosts: "",
        summary:"",
        Categories: "",
        parentName:"Chưa chọn",
        id_category:"",
        CategoryName:"", 
        errors:{
                namePosts:"",
                summary:"",
                id_category:"",
                img:"",
            },
        Success: "",
        id:"",

    }
  },
  created () {
      if(this.$route.params.id !="")
      {
        this.id = this.$route.params.id;
        this.getPost();
      }
      else
      {
          this.$router.push({name: 'home'});
      }
      this.CheckPermissin()
      this.getCategories()

      
  },
  methods: {

      async getPost()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/getPost?id='+this.id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.namePosts = data.data.name;
            this.summary = data.data.summany;
            this.id_category = data.data.category_id;
            document.getElementById('img').src = "/api/ShowImg/"+data.data.image
        })
        .catch(error=>{
            console.log(error);
        })
      },
      async UpdatePost(){
        if(this.showError())
        {
            let fromData = new FormData();
            fromData.append('name',this.namePosts);
            fromData.append('category_id',this.id_category);
            const [file] = this.$refs.FileImg.files
            if(file == null)
            {
                fromData.append('image','0');
            }
            else
            {
                fromData.append('image',file);
            }
            fromData.append('summary',this.summary);
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.post('/api/UpdatePost?id='+this.id,fromData,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.$router.back();
            })
            .catch(error=>{
                console.log(error.response.data);
            })
        }
      },
      addImg(){
          const [file] = this.$refs.FileImg.files
          document.getElementById('img').src = URL.createObjectURL(file);
      },
      async getCategories()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/listAllCategory',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.Categories = data.data;
            this.Categories.forEach(Category => {
                if(Category.id == this.id_category)
                {
                    this.parentName = Category.name;
                }
            });
        })
        .catch(error=>{
            console.log(error);
        })
      },

      addCategoryId($id,$name){
            this.parentName = $name
            this.id_category = $id
      },
      showError(){
        this.deleteError()
        if(this.namePosts == "")
        {
            this.errors.namePosts = "Tên bài viết không được bỏ trống"
            return false;
        }
        if(this.summary == "")
        {
            this.errors.summary = "Tóm tắt không được bỏ trống"
            return false;
        }
        if(this.id_category == "")
        {
            this.errors.id_category = "Bạn cần chọn danh mục"
            return false;
        }
        if(document.getElementById('img').src == "data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=")
        {
            this.errors.img = "Bạn cần chọn ảnh cho bài viết"
            return false;
        }
        return true;
      },

      deleteError(){
        this.errors.namePosts = ""
        this.errors.summary = ""
        this.errors.id_category = ""
        this.errors.img = ""
        this.Success = ""
      },
      Calcel($index){
        this.$router.back();
      },
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-Personal-post',{
            headers: {
            Accept: 'application/json'
            },
        })
        .then(data => {
            if(!data.data)
                this.$router.push({name: 'home'});
        })
        .catch(error=>{
            console.log(error);
        })
      }
  },
}
</script>