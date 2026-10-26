 <div class="card bg-base-300 shadow-sm">
     @if ($post->images->count() === 1)
         <figure>
             <img src="{{ $post->images->first()->url }}" alt="{{ $post->title }}" />
         </figure>
     @elseif($post->images->count() > 1)
         <div class="carousel rounded-box">
            @foreach($post->images as $image)
                <div class="carousel-item w-full">
                    <img src="{{ $image->url }}" alt="{{ $post->title }}" class="w-full" />
                </div>
            @endforeach
         </div>
     @endif
     <div class="card-body">
         <h2 class="card-title">{{ $post->title }}</h2>
         @isset($posts)
             <p>{{ $post->snippet }}</p>
         @else
             <p>{!! $post->displayBody !!}</p>
         @endisset
         <span class="text-base-content/70">
             <a href="{{ route('user', $post->user) }}" class="btn btn-link">
                 {{ $post->user->name }}
             </a>
         </span>
         <time class="text-base-content/70" datetime="{{ $post->created_at->toAtomString() }}">
             {{ $post->created_at->format('F j, Y') }}
         </time>
         <span class="text-base-content/70"><b>Comments:</b> {{ $post->comments_count }}</span>
         <div>
             @foreach ($post->tags as $tag)
                 <div class="badge badge-outline badge-primary">{{ $tag->name }}</div>
             @endforeach
         </div>
         <div class="card-actions justify-end">
             @isset($posts)
                 <a href="{{ route('post', $post) }}" class="btn btn-primary">@lang('Read more')</a>
             @endisset
         </div>
     </div>
 </div>