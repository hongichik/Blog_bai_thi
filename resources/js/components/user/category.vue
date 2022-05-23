<template>
    <ul id="navigation">
        <li> <a href="/about">Giới thiệu</a></li>
        <li v-for="Categoriy in Categories" :key="Categoriy.value">
            <a :href="'/Category?name='+Categoriy.name">{{Categoriy.name}}</a>
            
            <ul v-if="Categoriy.Chill[0] != null" class="submenu">
                <li v-for="CategoriyChild in Categoriy.Chill" :key="CategoriyChild.value">
                    <a :href="'/Category?name='+CategoriyChild.name">{{CategoriyChild.name}}</a>
                </li>
            </ul>
        </li>
        
        <li><a href="/contact">Liên hệ</a></li>
    </ul> 
</template>
<script>
export default {
  data () {
    return {
        Categories: "",
    }
  },
  created () {
      this.getCategories();
  },
  methods: {
    async getCategories()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/listCategory',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            console.log(data.data);
            this.Categories = data.data;
        })
        .catch(error=>{
            console.log(error);
        })
      },
  },

}
</script>