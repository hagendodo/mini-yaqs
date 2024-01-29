<x-client-layout>
    <div class="container-fluid">
        <div class="row mx-3 mt-2 px-3" style="padding-top:50px;padding-bottom:50px;border-radius: 15px;background-color: #009d5b;background-image: url( '{{ asset('mosque.svg') }}' );background-size: cover;background-repeat: no-repeat;background-position: center top;">
            <div class="col-12 pt-5">
                <div class="row">
                    <div class="col-4">
                        <h2 class="text-warning">Welcome to the heart of inspiration and faith, where Islamic Quotes and Motivational Videos converge to empower your journey.</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="text-white" style="font-size: 20pt">-- Mini Yaqs</p>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-4">
                        <a href="{{ route('client.quote') }}" class="btn btn-warning">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1 mt-5">
            <div class="col-12">
                <h4>Videos</h4>
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
