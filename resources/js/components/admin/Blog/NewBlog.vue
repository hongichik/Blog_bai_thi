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
                <div  class="form-group col-12" style="padding-bottom: 60px;">
                    <label>Nội dung</label>
                    <vue-editor style="height: 60vh;" v-model="ContentData"/>
                    <span  style="color:red;font-size: 1em">{{errors.ContentData}}</span>
                </div>


                <div class="col-lg-12 mt-1 mb-1 ">
                    <span  style="color:#4dc532;font-size: 1em">{{Success}}</span>
                </div>
                <div class="row">
                    <div class="col-sm-6 pl-0">
                        <p class="text-right">
                            <button @click="addBlog()" class="btn btn-space btn-primary">Lưu</button>
                            <button class="btn btn-space btn-secondary" @click="Calcel(1)">Làm lại</button>
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
        parentName:"Chưa chọn",
        ContentData: "",
        errors:{
                namePosts:"",
                summary:"",
                img:"",
                ContentData: ""
            },
        Success: "",

    }
  },
  created () {
      this.CheckPermissin()
  },
  methods: {
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-Personal-blog',{
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
      },
      async addBlog(){
        if(this.showError())
        {
            const [file] = this.$refs.FileImg.files
            let fromData = new FormData();
            fromData.append('name',this.namePosts);
            fromData.append('image',file);
            fromData.append('summary',this.summary);
            fromData.append('content',this.ContentData);
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.post('/api/NewBlog',fromData,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                // return;
                this.$router.push({path: '/ListBlog'});
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
        if(document.getElementById('img').src == "data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=")
        {
            this.errors.img = "Bạn cần chọn ảnh cho bài viết"
            return false;
        }
        if(this.ContentData == "")
        {
            this.errors.ContentData = "Nội dung không được phép bỏ trống"
            return false;
        }
        return true;
      },

      deleteError(){
        this.errors.namePosts = ""
        this.errors.summary = ""
        this.errors.img = ""
        this.errors.ContentData = ""
        this.Success = ""
      },
      Calcel($index){
        this.namePosts= "";
        this.summary="";
        this.parentName="Chưa chọn";
        document.getElementById('img').src = "data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
        if($index == 1)
        {
            this.deleteError();
        }
      }
  },


    
}
</script>