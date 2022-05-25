<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Danh sách bài học con - trang : {{this.currentPage}}</h5>
                <div class="card-body">
                <div style="display: flex;justify-content: space-between;">
                <div class="form-group ">
                    <button class="btn btn-primary" @click="$router.go(-1)">Quay lại</button>
                    <router-link :to="'/NewPostChild/'+id" class="btn btn-primary">Thêm mới</router-link >
                </div>
                <nav v-if="Post.last_page > 1" aria-label="Page navigation example" class="ml-3">
                    <ul class="pagination">
                        <li v-for="(data)  in Post.links" :key="data.value" class="page-item page-link" @click="getPostChill(data.label,data.url)">{{data.label}}</li>
                    </ul>
                </nav>            
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th class="col-3">Tên bài học</th>
                            <th class="col-4">Tóm tắt</th>
                            <th class="col-2">Ảnh</th>
                            <th class="col-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index)  in Post.data" :key="data.value">
                            <th>{{index+1}}</th>
                            <td>{{data.name}}</td>
                            <td>{{data.summany}}</td>
                            <td>
                                <img class="col" :src="'/api/ShowImg/'+data.image" alt="">
                            </td>
                            <td>
                                <div class="form-group ml-3" style="text-align: center;">
                                    <button type="button" @click="btnUpdatePostChill(data.id)" class="btn btn-primary">Sửa</button>
                                    <button type="button" @click="btnDeletePostChill(data.id)" class="btn btn-danger">Xóa</button>
                                </div>                                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data () {
    return {
        id: null,
        Post:"",
        Countpage:1,
        page: 1,
        currentPage:1,
    }
  },
  created () {
    if(this.$route.params.id == "")
        this.$router.push({path: '/'});
    else
        this.id = this.$route.params.id;
      this.CheckPermissin()
      this.getPostChill(1,'aa')
  },
  methods: {
    async btnDeletePostChill(id)
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/DeletePostChill?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.getPostChill(this.currentPage,'aa')    
        })
        .catch(error=>{
            console.log(error);
        })
      },
      btnUpdatePostChill(id){
        this.$router.push({path: '/UpdatePostChild/'+id});
      },
      async getPostChill(page,url)
      {
        if(url != null)
        {
            if(page == "Trang trước")
            {
                page = this.currentPage -1;
            }
            if(page == "Trang sau")
            {
                page = this.currentPage +1;
            }
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.get('/api/ListPostChill?page='+page+'&id='+this.id,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.Post = data.data;
                this.currentPage = data.data.current_page;
            })
            .catch(error=>{
                console.log(error.response.data);
            })
        }
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
      },
  },
}
</script>