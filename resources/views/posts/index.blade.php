@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ $post->url }}">{{-- Aqui vemos como usar el attribute dinamico del modelo post --}}
                {{ $post->title }}
            </a>
        </li>
    @endforeach 
    </ul>
{{$posts->render()}}


@endsection