<template>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card" id="switchcontent">
        <h5 class="card-header">Thống kê</h5>
        <div class="card-body pb-0 d-flex">
            <div style="border-radius: 0px;">
                <div class="form-group p-0 d-flex" style="width: 20em;">
                    <label class="col-form-label text-sm-right">Thống kê nâng cao</label>
                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                        <div class="switch-button switch-button-xs">
                            <input type="checkbox" v-model="ReportAll" checked="" name="switch12" id="switch12"><span>
                        <label for="switch12"></label></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group pl-0 pr-0 ml-3">
                <label class="col-form-label mr-3">Loại</label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="radio-inline" value="blog" v-model="Report" class="custom-control-input"><span class="custom-control-label">Bài Blog</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="radio-inline" value="post"  v-model="Report" class="custom-control-input"><span class="custom-control-label">Bài viết</span>
                </label>
            </div>
            <div class="form-group ml-3" style="text-align: center;">
                <button type="button" @click="Update()" class="btn btn-primary">Thống kê</button>
            </div>
        </div>
        <div v-if="ReportAll" class="card-body d-flex flex-wrap">
            <div class="form-group pl-0 pr-0 d-flex">
                <label class="col-form-label mr-3">Người viết bài</label>
                <div class="dropdown">
                    <input class="form-control" style="cursor: pointer;" readonly v-model="NameUser" type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <div class="dropdown-menu w-100 dropdown-category"  aria-labelledby="dropdownMenuButton">
                        <a style="cursor: pointer;" @click="addUser(data.name)" v-for="data  in ListUser" :key="data.value" class="dropdown-item">{{data.name}}</a>
                        <a @click="addUser('')" style="cursor: pointer;" class="dropdown-item">Hủy</a>
                    </div>
                </div>
            </div>
            <div class="form-group pl-0 pr-0 d-flex ml-3">
                <label class="col-form-label mr-3">Danh mục</label>
                <div class="dropdown">
                    <input class="form-control" style="cursor: pointer;" readonly v-model="Category" type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <div class="dropdown-menu w-100 dropdown-category"  aria-labelledby="dropdownMenuButton">
                        <div v-for="data  in listCategory" :key="data.value">
                            <a style="cursor: pointer;" @click="addCategory(data.name)" class="dropdown-item">{{data.name}}</a>
                            <a style="cursor: pointer;" v-for="(dataChill)  in data.Chill" :key="dataChill.value" @click="addCategory(dataChill.name)" class="dropdown-item">-{{dataChill.name}}</a> 
                        </div>
                        <a @click="addCategory('')" class="dropdown-item">Hủy</a>
                    </div>
                </div>
            </div>
            <div class="form-group pl-0 pr-0 d-flex ml-3">
                <label class="col-form-label mr-3">Thời gian từ</label>
                <div class="form-group">
                    <input style="width: 10em;" v-model="dateStart" type="date" value="2000-09-09" min="2000-01-01" max="2018-12-31" class="form-control">
                </div> 
                <label class="col-form-label mr-3 ml-3">Đến</label>
                <div class="form-group">
                    <input style="width: 10em;" v-model="dateEnd" type="date" value="2000-09-09" min="2000-01-01" max="2018-12-31" class="form-control">
                </div> 
            </div>

        </div>
        <div class="card-body">
            <h4>Trang - {{this.current_page}}</h4>
            <nav v-if="dataReport.last_page > 1" aria-label="Page navigation example" class="ml-3 mt-4">
                <ul class="pagination">
                    <li v-for="(data)  in dataReport.links" :key="data.value" class="page-item page-link" @click="getReport(data.label,data.url)">{{data.label}}</li>
                </ul>
            </nav>  
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th>Tác giả</th>
                        <th scope="col">Tên bài</th>
                        <th scope="col">Số lượng truy cập</th>
                        <th scope="col">Truy cập lần cuối lúc</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data,index)  in dataReport.data" :key="data.value">
                        <th scope="row">{{index+1}}</th>
                        <th>{{data.UserName}}</th>
                        <td>{{data.name}}</td>
                        <td>{{data.count}}</td>
                        <td>{{data.updated_at}}</td>
                        <td>
                            <a v-if="!data.nameCaegory" :href="'/viewCommentBlog?id='+data.id">Đi tới bài Blog</a>
                            <a v-if="data.nameCaegory" :href="'/viewCommentPost?id='+data.id">Đi tới bài viết</a>
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
        ReportAll:false,
        Report:"blog",
        dateStart:"",
        dateEnd:"",
        listCategory:"",
        Category:"",
        ListUser:"",
        NameUser:"",
        current_page:"",
        dataReport:""
    }
  },
  created () {
      this.getCategories()
      this.getUser()
      this.getReport(1,'aa')
  },
  methods: {
      async getReport(page,url)
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

            var StringGet="";
            if(this.ReportAll)
            {
                StringGet = '&report='+this.Report
                if(this.NameUser!="")
                {
                    StringGet = StringGet+'&UserName='+this.NameUser
                }
                if(this.Category!="")
                {
                    StringGet = StringGet+'&CategoryName='+this.Category
                }

                if(this.dateStart!="")
                {
                    StringGet = StringGet+'&dateStart='+this.dateStart
                }
                if(this.dateStart!="")
                {
                    StringGet = StringGet+'&dateEnd='+this.dateEnd
                }
            }
            else{
                StringGet = StringGet+'&report='+this.Report
            }
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.get('/api/ListVisitor?page='+page+StringGet,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                console.log(this.Report+'aaa');
                console.log(data.data);
                this.dataReport = data.data;
                this.current_page = data.data.current_page;
            })
            .catch(error=>{
                console.log(error);
            })
        }
      },
      async getUser()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/ListUser',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.ListUser = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
      },
      async getCategories()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/listCategory',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.listCategory = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
      },
      addUser(NameUser)
      {
          this.NameUser = NameUser;
      },
      addCategory(Category)
      {
          this.Category = Category;
      },
      Update(){
          this.getReport(1,'aa')
      }
  },
}
</script>