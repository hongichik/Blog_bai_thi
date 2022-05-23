<template>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Tạo tài khoản</h5>
            <div class="card-body">
                <div>
                    <div>
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Họ tên cộng tác viên</label>
                            <input id="inputText3" v-model="Fullname" placeholder="vd: Phạm Văn B" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" required v-model="Gmail"  placeholder="vd :vidu@gmail.com" class="form-control">
                            <label>{{this.error.Gmail}}</label>
                        </div>
                        <div class="form-group">
                            <label >Mật khẩu</label>
                            <input type="text" v-model="Pass" placeholder="Mật khẩu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Địa chỉ</label>
                            <input  v-model="Address" autocomplete="off" placeholder="vd: Hạ long, Quảng ninh" type="text" class="form-control">
                        </div>               
                        <div class="form-group">
                            <label class="col-form-label">Ngày sinh</label>
                            <input style="width: 10em;" v-model="birthday" type="date" value="2000-09-09" min="2000-01-01" max="2018-12-31" class="form-control">
                        </div> 

                    </div>
                    <label for="" style="color: red;">{{error.All}}</label>
                    <h4>Quyền</h4>
                    <label v-for="(data) in Permission" :key="data.id" class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" :id="data.id" :value="data.id" v-model="selected" class="custom-control-input"><span class="custom-control-label">{{data.name}}</span>
                    </label>
                </div>
            </div>
            <div class="form-group ml-3">
                <button @click="NewAcount()" type="button" class="btn btn-primary">Tạo tài khoản</button>
                <button type="button" @click="Calcel()" class="btn btn-danger">Hủy</button>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
  data () {
    return {
        Fullname: "",
        Gmail: "",
        Pass: "",
        Address: "",
        birthday: "",
        Permission: "",
        selected: [],
        error:{
            Gmail: "",
            All:"",
        },
    }
  },
  created () {
      this.CheckPermissin();
      this.getPermission();
  },
  methods: {
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-Account',{
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
       async getPermission(){
        await axios.get('/api/GetPermisson',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.Permission = data.data;
        })
        .catch(error=>{
            console.log("lỗi");
        })
      },
      async NewAcount(){
          if(this.validateAll())
          {
            let fromData = new FormData();
            fromData.append('Fullname',this.Fullname);
            fromData.append('Gmail',this.Gmail);
            fromData.append('Pass',this.Pass);
            fromData.append('Permission',this.selected);
            fromData.append('address',this.Address);
            fromData.append('birthday',this.birthday);
            axios.defaults.headers.post['Accept'] = 'application/json'
            await axios.post('/api/NewAccount', fromData,{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.$router.push({path: '/ListPermission'});
                this.Calcel();
            })
            .catch(error=>{
                this.error.All = "Gamil bị trùng"
            })
          }
      },
      validateAll() {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.Gmail)) {
                
            } else {
                this.error.Gmail = "Gmail không đúng định giạng"
                return false;
            }
            if(this.Fullname == "" || this.Pass == ""  ||this.Address == "" || this.birthday == "")
            {
                this.error.All = "Không được phép bỏ trống thông tin"
                return false;
            }

            this.error.Gmail = ""
            this.error.All = ""
            return true;
      },
      Calcel(){
        this.Fullname= ""
        this.Gmail= ""
        this.Pass= ""
        this.error.Gmail = ""
        this.error.All = ""

      }
  },

})
</script>
