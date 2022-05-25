<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
      <h5 class="card-header">Đóng góp từ người dùng - trang : {{this.currentPage}}</h5>
        <nav v-if="Contact.last_page > 1" aria-label="Page navigation example" class="mt-3 ml-3">
            <ul class="pagination">
                <li v-for="(data)  in Contact.links" :key="data.value" class="page-item page-link" @click="getContact(data.label,data.url)">{{data.label}}</li>
            </ul>
        </nav> 
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Họ tên</th>
              <th scope="col">Gmail</th>
              <th scope="col">Nội dung</th>
              <th scope="col">Chức năng</th>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(data,index)  in Contact.data" :key="data.value">
              <th scope="row">{{ index +1}}</th>
              <td>{{data.name}}</td>
              <td>{{data.gmail}}</td>
              <td>{{data.content}}</td>
              <td>
                <button type="button" @click=" DeleteContact(data.id)" class="btn btn-danger">Xóa</button>
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
  data() {
    return {
        Contact:"",
        currentPage: 1,
    };
  },
  created() {
      this.getContact(1,'aa');
  },
  methods: {
      async DeleteContact(id){
        await axios.get('/api/DeleteContact?id='+id,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.getContact(this.currentPage,'aa');
        })
        .catch(error=>{
            console.log("lỗi");
        })
      },
      async getContact(page,url){
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
            await axios.get('/api/GetContact?page='+page,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.Contact = data.data;
                this.currentPage =  data.data.current_page;
            })
            .catch(error=>{
                console.log(error.response.data);
            })
        }
      }
  },
};
</script>
