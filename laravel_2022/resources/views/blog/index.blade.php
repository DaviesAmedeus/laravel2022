<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>


{{-- @if (count($posts)< 100)

<h1>
    {{dd($posts)}}
</h1>
@elseif (count($posts) == 202)
    <h1>You have exactly 202 posts</h1>
@else
    <h1>
        No posts
    </h1>
@endif --}}

{{-- NB: @unless is the opposite of @if
    i.e
    @unless($posts) === @unless(!$posts)
    --}}
{{-- @unless (count($posts)<100)
    <h1>"There are posts greater than 100"</h1>
@endunless --}}
{{-- 
    @forelse ($posts as $post )
        {{$post->title}}
    @empty
        <p>No posts set</p>
    @endforelse --}}
    {{-- 
        NB: @forelse is the same as @foreach but with the fallback part @empty
    --}}

        {{-- @forelse ($posts as $post )
            {{-- {{$loop->index}} --}}
            {{-- {{$loop->iteration}} --}}
            {{-- {{$loop->remaining}} --}}
            {{-- {{$loop->count}} --}}
            {{-- {{$loop->first}} --}}
            {{-- {{$loop->last}} --}}
            {{-- {{$loop->depth}} --}}
            {{-- {{$loop->parent}} <!-- Checks the depth of the loop --> 
            
        @endforelse --}}


</body>
</html>