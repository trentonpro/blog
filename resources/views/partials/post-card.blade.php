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
         <span class="text-base-content/70">{{ $post->user?->name ?? __('Unknown author') }}</span>
         <time class="text-base-content/70" datetime="{{ $post->created_at->toAtomString() }}">
             {{ $post->created_at->format('F j, Y') }}
         </time>
         <div class="card-actions justify-end">
             @isset($posts)
                 <a href="{{ route('post', $post) }}" class="btn btn-primary">@lang('Read more')</a>
             @endisset
         </div>
     </div>
 </div>