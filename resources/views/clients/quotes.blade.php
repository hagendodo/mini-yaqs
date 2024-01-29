<x-client-layout>
    <div class="container-fluid">
        <div class="row mx-3 mt-2 px-3"
             style="padding-top:50px;padding-bottom:50px;border-radius: 15px;background-color: #009d5b;">
            <div class="col-12 pt-2">
                <div class="row pb-4">
                    <div class="col-12">
                        <h3 class="text-white text-center">LATEST QUOTES</h3>
                    </div>
                </div>
                <style>
                    .carousel-indicators .active {
                        background-color: #fec200;
                        border: 1px #fec200 solid;
                    }
                </style>
                <div class="row pb-5">
                    <div class="col-12 px-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($latestQuotes as $key => $latestQuote)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }} border border-dark"
                                        style="padding: 5px 2px 5px 2px"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner text-center">
                                @foreach($latestQuotes as $key => $latestQuote)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="card d-block w-100 py-5" style="height: 300px; color: #6c6c72;">
                                            <div class="card-body px-5 py-3 rounded-0">
                                                <h3>{{ $latestQuote->content }}</h3>
                                                <p>{{ $latestQuote->author }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1 mt-5">
            <div class="col-12">
                <h3 class="text-center pb-4 mb-2" style="color: #185d4e;">ALL QUOTES</h3>
                <div class="row">
                    <div class="col-6 mb-5">
                        <form id="filterForm" method="GET" action="{{ route('client.quote') }}" class="row">
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
                <div class="row">
                    @foreach($quotes as $quote)
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow" style="border-radius: 10px;">
                                <div class="card-body">
                                    <h4>{{ $quote['content'] }}</h4>
                                    <p>{{ $quote['author'] }}</p>
                                </div>
                                <div class="card-footer py-0 text-right">
                                    <form id="likeForm" action="{{ route('quote-likes.store') }}" method="POST">
                                        @csrf
                                        <input type="number" value="{{ $quote->id }}" name="quote_id" hidden="hidden">
                                        <button type="submit" class="btn mr-0 p-2 likeButton"><i
                                                class="bi bi-heart"></i></button>
                                        <span class="ml-0 pl-0">{{ $quote['likes'] }}</span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="mt-2 d-flex justify-content-center">
                    {{ $quotes->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('/quote-likes/{{ request()->ip() }}', {
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
