<aside class="single_sidebar_widget popular_post_widget shadow-sm p-3 mb-5 bg-body rounded">
    <h3 class="widget_title">Bài học đề xuất</h3>
        <?php 
            use App\Models\Post;
            use App\Models\Category;
            if(isset($Category))
            {
                $Category = Category::where('name',$Category)->first();
                $Posts = Post::where('category_id',$Category->id)->offset(0)->limit(5)->get();

                if($Posts->count() == 0)
                {
                    $Posts = Post::offset(0)->limit(5)->get();
                }
            }
            else {
                $Posts = Post::offset(0)->limit(5)->get();
            }
        ?>
    @foreach ($Posts as $Post)
        <div class="media post_item">
            <img style="width: 25%;aspect-ratio: 3 / 2;object-fit: cover;" src="/api/ShowImg/{{ $Post->image }}" alt="post">
            <div class="media-body">
            <a href="/Post/{{ $Post['name'] }}">
                <h3>{{ $Post['name'] }}</h3>
                <p class="about-pera1" style="overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;">{{ $Post->summany }}</p>
            </a>
            
            </div>
        </div>
    @endforeach
 </aside>

 <aside class="single_sidebar_widget popular_post_widget shadow-sm p-3 mb-5 bg-body rounded">
    <h3 class="widget_title">Bài viết đề xuất</h3>
        <?php 
            use App\Models\blog;
            $blogs = blog::offset(0)->limit(5)->get();
        ?>
    @foreach ($blogs as $blog)
        <div class="media post_item">
            <img style="width: 25%;aspect-ratio: 3 / 2;object-fit: cover;" src="/api/ShowImg/{{ $blog->image }}" alt="post">
            <div class="media-body">
            <a href="/Blog/{{ $blog['name'] }}">
                <h3>{{ $blog['name'] }}</h3>
                <p class="about-pera1" style="overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;">{{ $blog->summany }}</p>
            </a>
            
            </div>
        </div>
    @endforeach
 </aside>