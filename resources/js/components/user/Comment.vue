<template>
    <div class="social-share pt-0 mt-4">
        <div class="section-tittle">
            <h3 class="mr-20">Bình luận</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-10 pt-3 pb-3">
                <span v-if="!this.resut" style="color: #0088ff;">Bình luận của bạn đang chờ duyệt</span>
                <div v-if="this.resut" class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control error" v-model="name" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập tên của bạn'" placeholder="Nhập tên của bạn">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control error" v-model="gmail" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control" v-model="content" name="message" id="message" cols="10" rows="3" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập bình luận'" placeholder="Nhập bình luận"></textarea>
                        </div>
                    </div>
                    <span class="ml-3" style="color:red">{{error}}</span>
                    <div class="col-12">
                        <div class="form-group">
                            <button @click="addComment()" type="button" class="btn btn-primary">Gửi bình luận</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-12 border pb-3">
                <div v-for="data in listCommet" :key="data.value" class="d-flex col-12 p-0 mt-3 border bg-light pt-3 pl-3">
                    <div class="p-1">
                        <img class="rounded-circle" src="/api/ShowImg/defaultImage.jpg" style="height: 32px;width: 32px;" alt="">
                    </div>
                    <div class="flex-grow-1 ml-3">
                        <div class="d-flex">
                            <p>{{data.name}}</p>
                            &ensp; &ensp;
                            <p class=" mt-1" style="font-size: 12px;">Viết lúc : {{data.created_at.slice(0,10)}}</p>
                        </div>
                        
                        <p>{{data.content}}</p>
                    </div>
                </div>
                <div v-if="last_page!=current_page" class="d-flex col-12 pt-1  pl-3">
                    <a @click="addList()" class="pt-2" style="color: #0088ff;cursor: pointer;">xem thêm</a>

                </div>
            </div>

            
        </div>
    </div>
</template>

<script>

export default {
  props: ['blog_id','post_id'],
  data () {
    return {
        listCommet:[],
        resut:true,
        name:"",
        gmail:"",
        content:"",
        error:"",
        current_page:1,
        last_page:1,
    }
  },
  created () {
      this.getComment(1)
  },
  methods: {
      addList()
      {
        this.getComment(this.current_page+1)
      },
      async addComment(){
        if(this.showError())
        {
            let fromData = new FormData();
            fromData.append('name',this.name);
            fromData.append('gmail',this.gmail);
            if(this.post_id == "")
            {
                fromData.append('blog_id',this.blog_id);
            }
            else{
                fromData.append('post_id',this.post_id);
            }
            
            fromData.append('content',this.content);
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.post('/api/Comment',fromData,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                console.log(data.data)
                this.resut = false

            })
            .catch(error=>{
                console.log(error.response.data);
            })
        }
      },
      async getComment(page)
      {
        let stringGet;
        if(this.post_id == "")
        {
            stringGet = '?page='+page+'&blog_id='+this.blog_id;
        }
        else{
            stringGet = '?page='+page+'&post_id='+this.post_id;
        }       
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/ListComment'+stringGet,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.listCommet = this.listCommet.concat(data.data.data);
            this.current_page = data.data.current_page;
            this.last_page = data.data.last_page;
        })
        .catch(error=>{
            console.log(error.response.data);
        })
        
      },

      showError(){
          if(this.name == "" || this.gmail == "" || this.content == "")
          {
              this.error = "Bạn cần nhập đầy đủ thông tin"
              return false;
          }
          return true;
      }

  },
}
</script>