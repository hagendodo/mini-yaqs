<x-client-layout>
    <div class="container-fluid">
        <div class="row mx-3 mt-2 px-3"
             style="padding-top:50px;padding-bottom:50px;border-radius: 15px;background-color: #009d5b;">
            <div class="col-12 pt-2">
                <div class="row pb-4">
                    <div class="col-12">
                        <h3 class="text-white text-center">LATEST VIDEO</h3>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-12 px-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-center">
                                <iframe width="498" height="280"
                                        src="{{ $latestVideo->url }}">
                                </iframe>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-12">
                                <div class="row">
                                    <div class="col-12 text-center d-flex justify-content-start">
                                        <h3 class="text-white" style="font-size: 32pt">{{ $latestVideo->title }}</h3>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-12">
                                        <a href="{{ $latestVideo->url }}" target="_blank"
                                           class="btn btn-warning w-50 mt-4">WATCH VIDEOS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1 mt-5">
            <div class="col-12">
                <h3 class="text-center pb-4 mb-2" style="color: #185d4e;">ALL VIDEOS</h3>
                <div class="row">
                    <div class="col-6 mb-5">
                        <form id="filterForm" method="GET" action="{{ route('client.video') }}" class="row">
                            <div class="col-9 col-md-7 col-sm-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search Quotes"
                                           value="{{ $_GET['search']??"" }}">
                                    <div class="input-group-append">
                                        <button class="btn text-white" style="background-color: #009d5b;" type="submit">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-md-5 col-sm-6">
                                <select id="inputState" name="category" class="form-control"
                                        onchange="document.getElementById('filterForm').submit()">
                                    <option disabled selected>Choose Category</option>
                                    <option
                                        value="" {{ isset($_GET['category']) && $_GET['category'] == ""?"selected":"" }}>
                                        ALL
                                    </option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ ($category->id == isset($_GET['category'])?$_GET['category']:null)?"selected":"" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    @foreach($videos as $video)
                        <div class="col-lg-4 col-md-8 col-sm-12 mb-3">
                            <div class="card rounded-0">
                                <div class="card-header text-white py-2 px-3 rounded-0"
                                     style="background-color: #009d5b;">
                                    {{ $video->title }}
                                </div>
                                <div class="card-body p-0 rounded-0 text-center">
                                    <iframe width="405" height="280"
                                            src="{{ $video->url }}">
                                    </iframe>
                                </div>
                                <div class="card-footer py-0 text-right">
                                    <form id="likeForm" action="{{ route('video-likes.store') }}" method="POST">
                                        @csrf
                                        <input type="number" value="{{ $video->id }}" name="video_id" hidden="hidden">
                                        <button type="submit" class="btn mr-0 p-2 likeButton"><i
                                                class="bi bi-heart"></i></button>
                                        <span class="ml-0 pl-0">{{ $video['likes'] }}</span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2 d-flex justify-content-center">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('/video-likes/{{ request()->ip() }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => response.json())
                .then(data => {
                    const isLiked = data === 1;
                    const likeButtons = document.getElementsByClassName('likeButton');

                    if (isLiked) {
                        Array.from(likeButtons).forEach(button => {
                            button.disabled = true;
                            const heartIcon = button.querySelector('i.bi.bi-heart');
                            if (heartIcon) {
                                heartIcon.classList.remove('bi-heart');
                                heartIcon.classList.add('bi-heart-fill');
                                heartIcon.style.color = "red";
                            }
                        });
                    }
                })
                .catch(error => console.error('Error fetching like status:', error));
        });
    </script>
    <script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script>
</x-client-layout>
