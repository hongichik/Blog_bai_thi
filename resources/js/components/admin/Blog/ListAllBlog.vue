<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Danh sách tất cả bài blog- trang : {{this.currentPage}}</h5>
                <div class="card-body">
                <div style="display: flex;justify-content: space-between;">
                <div class="form-group ">
                </div>
                <nav v-if="Post.last_page > 1" aria-label="Page navigation example" class="ml-3">
                    <ul class="pagination">
                        <li v-for="(data)  in Post.links" :key="data.value" class="page-item page-link" @click="getBlog(data.label,data.url)">{{data.label}}</li>
                    </ul>
                </nav>              
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th class="col-3">Tên bài blog</th>
                            <th class="col-4">Tóm tắt</th>
                            <th class="col-2">Ảnh</th>
                            <th class="col-2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index)  in Post.data" :key="data.value">
                            <th>{{index+1}}</th>
                            <td>{{data.name}} (tác giả:{{ data.UserName }}) </td>
                            <td>{{data.summany}}</td>
                            <td>
                                <img class="col" :src="'/api/ShowImg/'+data.image" alt="">
                            </td>
                            <td>
                                <div class="form-group ml-3" style="text-align: center;">
                                    <button type="button" @click="btnUpdateBlog(data.id)" class="btn btn-primary">Sửa</button>
                                    <button type="button" @click="btnDeleteBlog(data.id)" class="btn btn-danger">Xóa</button>
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
        page: 1,
        currentPage:1,
    }
  },
  created () {
      this.CheckPermissin()
      this.getBlog(1,"aa")
  },
  methods: {
    async btnDeleteBlog(id)
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/DeleteBlog?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.getBlog(this.currentPage,'aaa')    
        })
        .catch(error=>{
            console.log(error);
        })
      },
      btnUpdateBlog(id){
        this.$router.push({path: '/UpdateBlog/'+id});
      },
      async getBlog(page,url)
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
            await axios.get('/api/ListAllBlog?page='+page,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                console.log(data.data)
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
        await axios.get('/api/CheckPermission?Permission='+'Manage-blog-All',{
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