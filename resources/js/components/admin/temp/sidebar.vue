<template>
    <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>  
                            <li class="nav-item">
                                <router-link to=/ class=nav-link>Trang chủ</router-link>
                            </li>         
                            <li class="nav-item" v-if="Permission.includes('Manage-Category')">
                                <router-link to=/Category class=nav-link>Quản lý danh mục</router-link>
                            </li>                                                                           
                            <li class="nav-item" v-if="Permission.includes('Manage-Personal-blog')">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                                    Quản lý bài Blog
                                </a>
                                <div id="submenu-1" class="collapse submenu" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <router-link to=/ListBlog class=nav-link>Danh sách bài Blog cá nhân</router-link>                                            
                                        </li>
                                        <li class="nav-item" v-if="Permission.includes('Manage-blog-All')">
                                            <router-link to=/ListAllBlog class=nav-link>Danh sách tất cả bài Blog</router-link>                                            
                                        </li>                                        
                                        <li class="nav-item">
                                            <router-link to=/NewBlog class=nav-link>Thêm bài Blog</router-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>  
                            <li class="nav-item" v-if="Permission.includes('Manage-Personal-post')">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                                    Quản lý bài viết
                                </a>
                                <div id="submenu-2" class="collapse submenu" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item" >
                                            <router-link to=/ListPost class=nav-link>Danh sách bài viết cá nhân</router-link>                                            
                                        </li>
                                        <li class="nav-item" v-if="Permission.includes('Manage-post-All')">
                                            <router-link to=/ListPostAll class=nav-link>Danh sách tất cả bài viết</router-link>
                                        </li>
                                        <li class="nav-item" >
                                            <router-link to=/NewPost class=nav-link>Thêm bài viết mới</router-link>                                            
                                        </li>
                                    </ul>
                                </div>
                            </li>  
                            <li class="nav-item" v-if="Permission.includes('Manage-Account')">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                                    Quản lý tài khoản
                                </a>
                                <div id="submenu-3" class="collapse submenu" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <router-link to=/ListPermission class=nav-link>Danh sách tài khoản</router-link>                                            
                                        </li>
                                        <li class="nav-item">
                                            <router-link to=/newPermission class=nav-link>Tạo tài khoản</router-link>
                                        </li>

                                    </ul>
                                </div>
                            </li>     
                            <li class="nav-item" v-if="Permission.includes('Manage-Account')">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                                    Quản lý thông tin web
                                </a>
                                <div id="submenu-4" class="collapse submenu" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <router-link to=/About class=nav-link>Trang giới thiệu</router-link>                                            
                                        </li>
                                        <li class="nav-item">
                                            <router-link to=/newPermission class=nav-link>Thông tin chung</router-link>
                                        </li>

                                    </ul>
                                </div>
                            </li>                              <li class="nav-item" v-if="Permission.includes('Manage-report')">
                                <router-link to=/Home class=nav-link>Thống kê truy cập</router-link>
                            </li>                                    
                            <li class="nav-item" v-if="Permission.includes('Manage-contact')">
                                <router-link to=/Home class=nav-link>Quản lý liên hệ</router-link>
                            </li>  
                            <li class="nav-item pb-5">
                                <a class="nav-link" href="/" target="_blank">Đến trang người dùng</a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
</template>
<script>
export default {
  data () {
    return {
        Permission:[],

        
    }
  },
  created () {
      this.getPermission();
  },
  methods: {
      async getPermission()
      {
        axios.defaults.headers.post['Accept'] = 'application/json'
        await axios.get('/api/ShowPermissionAll',{
                headers: {
                Accept: 'application/json'
            }
        })
        .then(data => {
            for (let index = 0; index < data.data.length; index++) {
                this.Permission.push(data.data[index].slug);
            }
        })
        .catch(error=>{
            console.log(error.response.data);
        })
      }
  },

}
</script>