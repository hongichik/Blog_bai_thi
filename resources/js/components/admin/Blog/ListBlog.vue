<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Danh sách bài blog của bạn</h5>
                <div class="card-body">
                <div style="display: flex;justify-content: space-between;">
                <div class="form-group ">
                </div>
                 <nav v-if="Countpage > 1" aria-label="Page navigation example" class="ml-3">
                    <ul class="pagination">
                        <li class="page-item page-link" @click="getBlog(page -1)"> Quay lại</li>
                        <li class="page-item page-link">1</li>
                        <li class="page-item page-link">-></li>
                        <li class="page-item page-link">{{Countpage}}</li>
                        <li class="page-item page-link">Trang hiện tại {{page}}</li>
                        <li class="page-item page-link" @click="getBlog(page +1)">Trang tiếp theo</li>
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
                        <tr v-for="(data,index)  in Post" :key="data.value">
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
        Post:null,
        Countpage:1,
        page: 1,
    }
  },
  created () {
      this.CheckPermissin()
      this.getPage()
      this.getBlog(1)
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
            this.getPage()
            this.getBlog(this.page)    
        })
        .catch(error=>{
            console.log(error);
        })
      },
      btnUpdateBlog(id){
        this.$router.push({path: '/UpdateBlog/'+id});
      },
      async getPage()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CountBlog',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.Countpage = data.data;
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
      async getBlog(page)
      {
        if(page == 0)
        {
            page = 1;
        }
        if(page >this.Countpage)
        {
            page = this.Countpage
        }
        this.page = page;
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/ListBlog?page='+page,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.Post = data.data;
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
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
  },
}
</script>