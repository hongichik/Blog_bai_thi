<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Danh sách tất cả bài học - trang : {{this.currentPage}}</h5>
            <div class="card-body">
                <nav v-if="Post.last_page > 1" aria-label="Page navigation example" class="ml-3">
                    <ul class="pagination">
                        <li v-for="(data)  in Post.links" :key="data.value" class="page-item page-link" @click="getPost(data.label,data.url)">{{data.label}}</li>
                    </ul>
                </nav>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th class="col-2">Tên bài học</th>
                            <th class="col-2">Tóm tắt</th>
                            <th class="col-2">Ảnh</th>
                            <th class="col-2">Danh mục</th>
                            <th class="col-2">Bài học con</th>
                            <th class="col-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index)  in Post.data" :key="data.value">
                            <th>{{index+1}}</th>
                            <td>{{data.name}} (viết bởi: {{data.UserName}})</td>
                            <td>{{data.summany}}</td>
                            <td>
                                <img class="col" :src="'/api/ShowImg/'+data.image" alt="">
                            </td>
                            <td>
                                {{data.CategoryName}}
                            </td>
                            <td>
                                <router-link style="height: 100%;width: 100%;cursor: pointer;" :to="'/ListPostChilld/'+data.id" >Số lượng : {{data.count}}</router-link>                                                                            
                            </td>
                            <td>
                                <div class="form-group ml-3" style="text-align: center;">
                                    <button type="button" @click="btnUpdatePost(data.id)" class="btn btn-primary">Sửa</button>
                                    <button type="button" @click="btnDeletePost(data.id)" class="btn btn-danger">Xóa</button>
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
        Post:"",
        Countpage:1,
        currentPage: 1,
    }
  },
  created () {
      this.CheckPermissin()
      this.getPost(1,'aa')
  },
  methods: {
    async btnDeletePost(id)
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/DeletePost?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.getPost(this.currentPage,'a')            
        })
        .catch(error=>{
            console.log(error);
        })
      },
      btnUpdatePost(id){
        this.$router.push({path: '/UpdatePost/'+id});
      },
      async getPage()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CountAllPost',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.Countpage = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
      },
      async getPost(page,url)
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
            await axios.get('/api/ListAllPost?page='+page,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.Post = data.data;
                this.currentPage = data.data.current_page;
            })
            .catch(error=>{
                console.log(error);
            })
        }
      },
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-post-All',{
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