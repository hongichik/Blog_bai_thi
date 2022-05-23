<template>
    <div class="card">
        <h5 class="card-header">Trang giới thiệu</h5>
        <div class="card-body">
            <div>
                <div class="form-group col-12" style="padding-bottom: 60px;">
                    <vue-editor style="height: 60vh;" v-model="ContentData"/>
                </div>
                <!-- <style>

                </style> -->
                <div class="row">
                    <div class="col-sm-6 pl-0">
                        <p class="text-right">
                            <button @click="saveAbout()" class="btn btn-space btn-primary">Lưu</button>
                            <button class="btn btn-space btn-secondary" @click="Calcel(1)">Làm lại</button>
                        </p>
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
        ContentData: null
    }
  },
  created () {
      this.CheckPermissin()
      this.getAbout();
  },
  methods: {
      async saveAbout(){
        // console.log(this.ContentData);
        let fromData = new FormData();
        fromData.append('content',this.ContentData);
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.post('/api/UpdateAbout',fromData,{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.getAbout();
            alert('Sửa thành công');
            // this.$router.back();
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
      async getAbout()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/getAbout',{
            headers: {
            Accept: 'application/json'
            },
        })
        .then(data => {
            this.ContentData = data.data
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
      async CheckPermissin()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/CheckPermission?Permission='+'Manage-Info-Web',{
            headers: {
            Accept: 'application/json'
            },
        })
        .then(data => {
            if(!data.data)
                this.$router.push({name: 'home'});
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      },
  },

}
</script>