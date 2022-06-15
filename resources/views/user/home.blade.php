@extends('user.temp.Main')
@section('Content')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="slider-active">
                            <!-- Single -->
                            <div class="single-slider">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img style=" aspect-ratio:  3 / 2; object-fit: cover;" src="/api/ShowImg/{{ $NewPost['image'] }}" alt="">
                                        <div class="trend-top-cap">
                                            <h2><a href="/Post/{{ $NewPost['name'] }}" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms">{{ $NewPost['name'] }}</a></h2>
                                            <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">Viết lúc : {{ $NewPost['created_at'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right content -->
                    <div class="col-lg-4">
                        @foreach($PostNewChill as $Child)
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="trending-top mb-15">
                                        <div class="trend-top-img">
                                            <img style=" aspect-ratio:  6 / 4; object-fit: cover;" src="/api/ShowImg/{{ $Child['image'] }}" alt="">
                                            <div class="trend-top-cap trend-top-cap2">
                                                @if ($Yeschill == 0)
                                                    <h2><a href="/PostChill/{{ $Child['name'] }}">{{ $Child['name'] }}</a></h2>
                                                @else
                                                    <h2><a href="/Post/{{ $Child['name'] }}">{{ $Child['name'] }}</a></h2>
                                                @endif
                                                <p>Viết lúc: {{ $Child['created_at'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <div class="whats-news-wrapper">
                    <!-- Heading & Nav Button -->
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-6">
                            <div class="section-tittle mb-30">
                                <h3>Bài viết mới nhất</h3>
                            </div>
                        </div>
                    </div>
                    <?php 
                        use App\Models\Post;
                        use App\Models\postChilld;
                        $Post = Post::all()->random(1);
                        $postChillds = postChilld::where('post_id',$Post[0]->id)->offset(0)->limit(5)->get();
                        if($postChillds->count() <5)
                        {
                            $postChillds = Post::all()->random(5);
                            $notChill = true;
                        }

                    ?>
                    <!-- Tab content -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">       
                                    <div class="row">
                                        <!-- Left Details Caption -->
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="whats-news-single mb-40 mb-40">
                                                <div class="whates-img">
                                                    <img style="aspect-ratio: 3 / 2;width: 100%;;object-fit: cover;" src="/api/ShowImg/{{ $Post[0]['image'] }}" alt="">
                                                </div>
                                                <div class="whates-caption">
                                                    <h4><a href="/Post/{{ $Post[0]['name'] }}">{{ $Post[0]['name'] }}</a></h4>
                                                    <span>Viết lúc : {{ $Post[0]['created_at'] }}</span>
                                                    <p style="overflow: hidden;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                    -webkit-box-orient: vertical;">{{ $Post[0]['summany'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Right single caption -->
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="row">
                                                <!-- single -->
                                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                    @foreach ($postChillds as $postChilld)
                                                        <div class="whats-right-single mb-20">
                                                            <div class="whats-right-img col-4">
                                                                <img style="aspect-ratio: 3 / 2;width: 100%;;object-fit: cover;" src="/api/ShowImg/{{ $postChilld['image'] }}" alt="">
                                                            </div>
                                                            <div class="whats-right-cap">
                                                                @if (isset($notChill))
                                                                    <h4><a href="/Post/{{ $postChilld['name'] }}">{{ $postChilld['name'] }}</a></h4>
                                                                @else
                                                                    <h4><a href="/PostChill/{{ $Post[0]['name'] }}/{{ $postChilld['name'] }}">{{ $postChilld['name'] }}</a></h4>
                                                                @endif
                                                                <p>Viết lúc : {{ $postChilld['created_at'] }}</p> 
                                                            </div>
                                                        </div>                                                       
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                <!-- Banner -->

                </div>
                <div class="col-lg-4">
                    <!-- Flow Socail -->

                    <!-- Most Recent Area -->
                    <div class="most-recent-area">
                        <!-- Section Tittle -->
                        <div class="small-tittle mb-20">
                            <h4>Mẹo vặt</h4>
                        </div>
                        <?php 
                            use App\Models\blog;
                            $blogDetails = blog::all()->random(1);
                            $blogs = blog::all()->random(3);
                        ?>
                        <!-- Details -->
                        <div class="most-recent mb-40">
                            <div class="most-recent-img">
                                <img style="aspect-ratio: 2 / 1;width: 100%;object-fit: cover;" src="/api/ShowImg/{{ $blogDetails[0]['image'] }}" alt="">
                                <div class="most-recent-cap">
                                    <h4><a href="/Blog/{{ $blogDetails[0]['name'] }}">{{ $blogDetails[0]['name'] }}</a></h4>
                                    <p>Viết lúc : {{ $blogDetails[0]['created_at'] }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single -->
                        @foreach ($blogs as $blog)
                            <div class="most-recent-single">
                                <div class="most-recent-images col-4">
                                    <img style="aspect-ratio: 2 / 1;width: 100%;;object-fit: cover;" src="/api/ShowImg/{{ $blog['image'] }}" alt="">
                                </div>
                                <div class="most-recent-capt">
                                    <h4><a href="/Blog/{{ $blog['name'] }}">{{ $blog['name'] }}</a></h4>
                                    <p>Viết lúc : {{ $blog['created_at'] }}</p>
                                </div>
                            </div>                              
                        @endforeach
                    
                        <!-- Single -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
    <div class="weekly2-news-area gray-bg">
        <div class="container border-bottom "></div>
    </div>
    <!--   Weekly2-News start -->
    <div class="weekly2-news-area pt-50 pb-30 gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="slider-wrapper">
                            <!-- section Tittle -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="small-tittle mb-30">
                                        <h4>Bài học nổi bật</h4>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $HotPosts = Post::all()->random(10);
                                $HotPostTwos = Post::all()->random(10);
        
                            ?>                  
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly2-news-active d-flex">
                                        @foreach ($HotPosts as $HotPost)
                                        <div class="weekly2-single">
                                            <div class="weekly2-img">
                                                <img style="aspect-ratio: 2 / 1;width: 100%;;object-fit: cover;" src="/api/ShowImg/{{ $HotPost['image'] }}" alt="">
                                            </div>
                                            <div class="weekly2-caption">
                                                <h4><a href="/Post/{{ $HotPost['name'] }}">{{ $HotPost['name'] }}</a></h4>
                                                <p>Viết lúc : {{ $HotPost['created_at'] }}</p>
                                            </div>
                                        </div>  
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    <!-- End Weekly-News -->


    <!--   Weekly3-News start -->
    <div class="weekly3-news-area pt-80 pb-130">
        <div class="container">
            <div class="weekly3-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrapper">
                            <!-- Slider -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly3-news-active dot-style d-flex">
                                        @foreach ($HotPostTwos as $HotPostTwo)
                                        <div class="weekly3-single">
                                            <div class="weekly3-img">
                                                <img style="aspect-ratio: 2 / 1;width: 100%;;object-fit: cover;" src="/api/ShowImg/{{ $HotPostTwo['image'] }}" alt="">
                                            </div>
                                            <div class="weekly3-caption">
                                                <h4><a href="/Post/{{ $HotPostTwo['name'] }}">{{ $HotPostTwo['name'] }}</a></h4>
                                                <p>Viết lúc : {{ $HotPostTwo['created_at'] }}</p>
                                            </div>
                                        </div>  
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    <!-- End Weekly-News -->

</main>
@endsection