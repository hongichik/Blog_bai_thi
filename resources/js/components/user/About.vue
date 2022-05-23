<template>
    <div id="quill-container" style="font-size: 18px;" class="ql-container ql-snow">
        <div v-html="data" class="ql-editor" >

        </div>
    </div>
    
</template>

<script>
export default {
  data () {
    return {
        data:"",
    }
  },
  created (){
      this.showContact()
  },
  methods:{
    async showContact()
    {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/getAbout',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            this.data = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
    },
  }
    
}
</script>