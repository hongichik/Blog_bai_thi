<template>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Thông tin cá nhân</h5>
            <div class="card-body">
                <div>
                    <div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <div style="max-width: 11em;width: 100%;">
                                <button class="d-block  btn btn-outline-primary " style="position: relative;min-width: 100%;padding-bottom: 32%; padding-top: 32%; ">            
                                    <div class="h-100 w-100 d-flex" style="position: absolute; top: 0; right: 0;">
                                        <img :src="image" id="img" class="m-auto w-100 h-100" style="object-fit: contain;">
                                    </div>
                                    <div class="h-100 w-100 d-flex" style="position: absolute; top: 0; right: 0;">
                                        <i class="fa fa-2x fa-solid fa-plus m-auto" ></i>
                                    </div>
                                    <input @change="addImg()" type="file" ref="FileImg" class="h-100 w-100" style="position: absolute; top: 0; right: 0; opacity: 0;" accept="image/*">
                                </button>
                            </div>

                        </div>                        
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Họ tên</label>
                            <input id="inputText3" v-model="Fullname" placeholder="vd: Phạm Văn B" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" required v-model="Gmail"  placeholder="vd :vidu@gmail.com" class="form-control">
                            <label>{{this.error.Gmail}}</label>
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
                </div>
            </div>
            <div class="form-group ml-3">
                <button @click="UpdateInfo()" type="button" class="btn btn-primary">Lưu chỉnh sửa</button>
                <button type="button" @click="Calcel()" class="btn btn-danger">Hủy</button>
            </div>
        </div>
    </div>
</template>
<script>

export default ({
    data () {
        return {
            image:"/api/ShowImg/defaultImage.jpg",
            Fullname:"",
            Gmail:"",
            Address:"",
            birthday:"",
            error:{
                Gmail: "",
                All:"",
            },
        }
    },
    created () {
        this.getInfo();
    },
    methods: {
        Calcel(){
            location.reload();
        },
        async UpdateInfo(){
            if(this.validateAll())
            {
                let fromData = new FormData();
                fromData.append('Fullname',this.Fullname);
                fromData.append('Gmail',this.Gmail);
                fromData.append('address',this.Address);
                fromData.append('birthday',this.birthday);
                const [file] = this.$refs.FileImg.files
                if(file == null)
                {
                    fromData.append('image','0');
                }
                else
                {
                    fromData.append('image',file);
                }

                axios.defaults.headers.post['Accept'] = 'application/json'
                await axios.post('/api/UpdateInfo', fromData,{
                        headers: {
                        Accept: 'application/json'
                    }
                })
                .then(data => {
                    location.reload();
                })
                .catch(error=>{
                    console.log(error.response.data);
                    this.error.All = "Gamil bị trùng"
                })
            }
            else
            {
                location.reload();
            }
        },
        async getInfo(){
            await axios.get('/api/GetInfo',{
                    headers: {
                    Accept: 'application/json'
                }
            })
            .then(data => {
                this.Fullname = data.data.name;
                this.Gmail =  data.data.email;
                this.Address = data.data.address;
                this.birthday = data.data.birthday;
                this.image = '/api/ShowImg/'+data.data.image;
            })
            .catch(error=>{
                console.log("lỗi");
            })
        },
        addImg(){
            const [file] = this.$refs.FileImg.files
            this.image = URL.createObjectURL(file);
        },
        validateAll() {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.Gmail)) {
            } else {
                this.error.Gmail = "Gmail không đúng định giạng"
                return false;
            }
            if(this.Fullname == "" || this.Address == "" || this.birthday == "")
            {
                this.error.All = "Không được phép bỏ trống thông tin"
                return false;
            }
            this.error.Gmail = ""
            this.error.All = ""
            return true;
        },
    },

})
</script>