<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h5 class="card-header">Bình luận  - trang : {{this.current_page}}</h5>
      <nav v-if="ListComment.last_page > 1" aria-label="Page navigation example" class="ml-3 mt-4">
          <ul class="pagination">
              <li v-for="(data)  in ListComment.links" :key="data.value" class="page-item page-link" @click="getComment(data.label,data.url)">{{data.label}}</li>
          </ul>
      </nav>  

      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-striped table-bordered first">
                  <thead>
                      <tr>
                          <th class="col-2">Tên người viết</th>
                          <th class="col-2">Gmail</th>
                          <th class="col-3">Nội dung comment</th>
                          <th class="col-2">Đường dẫn tới bài viết</th>
                          <th class="col-2">Chức năng</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="data in ListComment.data" :key="data.value">
                          <td>{{data.name}}</td>
                          <td>{{data.gmail}}</td>
                          <td>{{data.content}}</td>
                          <td v-if="data.blog_id == null"><a :href="'/viewCommentPost?id='+data.post_id">Bài viết</a></td>
                          <td v-if="data.post_id == null"><a :href="'/viewCommentBlog?id='+data.blog_id">Bài Blog</a></td>
                          <td>
                              <button @click="btnUpdateComment(data.id)" class="btn btn-space btn-primary">Duyệt</button>
                              <button @click="btnShowDelete(data.id)" class="btn btn-space btn-secondary">Xóa</button>
                          </td>
                          
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- end horizontal form -->
  <!-- ============================================================== -->
  </div>
</template>

<script>
export default {

  data () {
    return {
      ListComment:"",
      current_page:1
    }
  },
  created () {
    this.getComment(1,'aa')
  },  
  methods: {
      async btnShowDelete(id)
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/DeleteComment?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
          this.getComment(this.current_page,'aa')
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
      async btnUpdateComment(id)
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/UpdateComment?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
          this.getComment(this.current_page,'aa')
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
      async getComment(page,url)
      {
        if(url != null)
        {
            if(page == "Trang trước")
            {
                page = this.current_page -1;
            }
            if(page == "Trang sau")
            {
                page = this.current_page +1;
            }
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.get('/api/ListALLComment?page='+page+'&id='+this.id,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.ListComment = data.data;
                this.current_page = data.data.current_page;
                console.log(data.data);
            })
            .catch(error=>{
                console.log(error.response.data);
            })
        }
      },
  },

}
</script>

