@extends('layouts.app')

@section('title', $content->meta_title)
@section('description', $content->meta_description)
@section('keywords', $content->meta_keywords)

@section('content')
<!-- ======================= breadcrumb Start  ============================ -->
<div class="breadcrumb_sec py-3">
    <div class="container">
        <nav>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Terms & Conditions</li>
            </ol>
        </nav>
    </div>
</div>
<!-- ======================= breadcrumb End  ============================ -->

<div class="container py-5">
    <h1 class="mb-4">{{$content->name ?? ""}}</h1>
    <p class="mb-4">By using our website, you agree to the following terms and conditions:</p>
    <ul>
        <li>{{$content->description ?? "N/A"}}</li>
    </ul>
</div>
@endsection
