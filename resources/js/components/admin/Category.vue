<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Quản lý danh mục</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label class="col-form-label">Tên danh mục</label>
                    <input type="text" v-model="CategoryName" maxlength="25" class="form-control">
                </div>
                <div class="form-group pl-0 pr-0">
                    <label class="col-form-label">Cấp độ</label>
                    <div class="dropdown">
                        <input class="form-control" v-model="parentName" readonly  type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <div class="dropdown-menu w-100 dropdown-category"  aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" @click="addParther()">Chọn làm danh mục cha</a>
                            <p class="pt-2 m-0 border-top text-center">Chọn làm danh mục con của</p>
                            <a v-for="(data)  in parentCategories" :key="data.value" class="dropdown-item" @click="addParentId(data.id,data.name)">{{data.name}}</a>

                        </div>
                    </div>
                </div>
                <span style="color: red;">{{error}}</span>
                <div class="form-group ml-3 mt-5">
                    <button type="button" @click="NewCategory()" class="btn btn-primary">Lưu</button>
                    <button type="button" @click="refresh()" class="btn btn-danger">Hủy</button>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Danh sách danh mục</h5>
                    <span class="ml-4" style="color:red">{{error2}}</span>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">STT</th>
                                    <th class="col-4">Tên danh mục</th>
                                    <th class="col-3">Loại</th>
                                    <th class="col-4" style="text-align: center;">chức năng</th>
                                </tr>
                            </thead>
                            <tbody v-for="(data,index)  in listCategory" :key="data.value">
                                <tr style="background: #fcffcf;">
                                    <th scope="row">{{ index +1}}</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" v-model="data.name" maxlength="25" class="form-control">
                                        </div>
                                    </td>
                                    <td>Danh mục cha</td>
                                    <td>
                                        <div class="form-group ml-3" style="text-align: center;">
                                            <button type="button" @click="Edit(data.id, data.name)" class="btn btn-primary">Lưu</button>
                                            <button type="button" @click="Delete(data.id, data.name)" class="btn btn-danger">Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="background-color: #faffe9;" v-for="(dataChill,i)  in data.Chill" :key="dataChill.value">
                                    <th scope="row" style="text-align: center;">{{ index+1 }}.{{ i +1}}</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" v-model="dataChill.name" maxlength="25" class="form-control">
                                        </div>
                                    </td>
                                    <td>Danh mục con</td>
                                    <td>
                                        <div class="form-group ml-3" style="text-align: center;">
                                            <button type="button" @click="Edit(dataChill.id, dataChill.name)" class="btn btn-primary">Lưu</button>
                                            <button type="button" @click="Delete(dataChill.id, dataChill.name)" class="btn btn-danger">Xóa</button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
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
        parentCategories:null,
        parentName:'danh mục cha',
        parentId:null,
        error:"",
        error2:"",
        CategoryName:"",
        listCategory:null,
    }
  },
  created () {
      this.getParentCategory()
      this.getCategories()
      this.CheckPermissin()
  },
  methods: {
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-Category',{
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
      async Edit($id,$name)
      {
        if($name == "")
        {
            this.error2 = "Có lỗi xảy ra có thể bạn đã bỏ trống thông tin"
        }
        
        let fromData = new FormData();
        fromData.append('id',$id);
        fromData.append('name',$name);
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.post('/api/UpdateCategory',fromData,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
                alert("Sửa thành công")
                this.refresh();
        })
        .catch(error=>{
            console.log(error.response.data);
        })   
        
      },
      async Delete($id,$name)
      {
        let text = "Bạn có chắc chắn muốn xóa danh mục "+$name+" và các bài viết liên quan chứ ?";
        if (confirm(text) == true) {
            let fromData = new FormData();
            fromData.append('id',$id);
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.post('/api/DeleteCategory',fromData,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.refresh();
            })
            .catch(error=>{
                console.log(error.response.data);
            })   
        }
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
      refresh(){
          this.error = "";
          this.error2  = "";
          this.CategoryName ="";
          this.parentName ='danh mục cha';
          this.getParentCategory();
          this.getCategories();
      },

      async NewCategory()
      {
        if(this.CategoryName == "")
        {
            this.error = "Bạn không đượng phép bỏ trống thông tin"
            return;
        }
        let fromData = new FormData();
        fromData.append('name',this.CategoryName);
        if(this.parentName != 'danh mục cha')
            fromData.append('father_id',this.parentId);

        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.post('/api/newCategory', fromData,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.refresh();
        })
        .catch(error=>{
            console.log("lỗi");
            this.showError(error);
        })
      },
      addParther(){
          this.parentName = "danh mục cha";
          this.parentId = null;
      },
      addParentId(id,name){
          this.parentName = name;
          this.parentId = id;
      },
      async getParentCategory()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/ShowPatherCategory',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.parentCategories = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
      },
  },

}
</script>