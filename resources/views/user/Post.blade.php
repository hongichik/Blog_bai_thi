@extends('user.temp.Main')

@section('Content')
<main>
    <!-- About US Start -->
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
                <div class="row">
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">
                        <!-- Heading & Nav Button -->
                            <div class="row justify-content-between align-items-end mb-15">
                                <div class="col-xl-12">
                                    <div class="section-tittle mb-30">
                                        <h4>
                                            <a href="/">Home</a>
                                            @isset($category)
                                            /<a href="/Category/{{ $category }}">{{ $category }}</a>   
                                            @endisset
                                            @isset($PostName)
                                            /<a href="/Post/{{ $PostName }}">{{ $PostName }}</a>   
                                            @endisset
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab content -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">       
                                        <div class="row">
                                            @if (!isset($Posts))
                                                <h3>Tạm thời vẫn chưa có bài nào bạn hãy truy cập sau nha</h3>
                                            @endif
                                            @isset($Posts)
                                                @foreach ($Posts as $Post)
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <div class="whats-news-single mb-40 mb-40">
                                                            <div class="whates-img">
                                                                <img style="aspect-ratio:2 / 1; object-fit: cover;" src="/api/ShowImg/{{ $Post->image }}" alt="">
                                                            </div>
                                                            <div class="whates-caption whates-caption2">
                                                                <h4><a href="/PostChill/{{ $PostName }}/{{ $Post->name }}"> {{ $Post->name }}</a></h4>
                                                                <p style=" overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical"> {{ $Post->summany }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach    
                                            @endisset
                                        </div>
                                    </div> 
                                </div>
                            </div>
                    </div>
                    </div>
                    <div class="col-lg-4 p-3 mb-5 bg-body rounded">
                        <div class="blog_right_sidebar">
                            @include('user.temp.Search')

                            @isset($category)
                                @include('user.temp.sidebarRight',['Category'=>$category])
                            @endisset
                           
                           
                          
                        </div>
                     </div>
                </div>
        </div>
    </div>
    <!-- About US End -->
    <!--Start pagination -->
    @isset($Posts)
        @if ($Posts->hasPages())
            <div class="pagination-area  gray-bg pb-45">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                    <li class="page-item"><a class="page-link" href="{{ $Posts->previousPageUrl() }}">
                                        <!-- SVG icon -->
                                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="15px">
                                            <path fill-rule="evenodd"  fill="rgb(255, 11, 11)" d="M8.142,13.118 L6.973,14.135 L0.127,7.646 L0.127,6.623 L6.973,0.132 L8.087,1.153 L2.683,6.413 L23.309,6.413 L23.309,7.856 L2.683,7.856 L8.142,13.118 Z"/>
                                            </svg>
                                    </span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">Trang hiện tại : {{ $Posts->currentPage() }}</a></li>
                                        <li class="page-item active"><a class="page-link" >trang cuối : {{ $Posts->lastPage() }}</a></li>
                                    <li class="page-item"><a class="page-link" href="{{ $Posts->nextPageUrl() }}">
                                        <!-- SVG iocn -->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="15px">
                                        <path fill-rule="evenodd"  fill="rgb(255, 11, 11)" d="M31.112,13.118 L32.281,14.136 L39.127,7.646 L39.127,6.624 L32.281,0.132 L31.167,1.154 L36.571,6.413 L0.491,6.413 L0.491,7.857 L36.571,7.857 L31.112,13.118 Z"/>
                                        </svg>
                                    </span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endisset


    <!-- End pagination  -->
</main>
@endsection