@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron text-center">
                    <h1>Welcome to FilterDash</h1>
                    <p class="lead">Your Ultimate Destination for Branded Filters</p>
                    <hr class="my-4">
                    <p>FilterDash is your go-to platform for high-quality filters designed specifically for brands. We simplify the process of enhancing your brand's presence with our customized filters.</p>
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login to Your Dashboard</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-4">
                <h2>Custom Filters for Brands</h2>
                <p>FilterDash provides tailor-made filters for each brand, ensuring a unique and consistent visual identity across all platforms. Our expert designers craft filters that resonate with your brand's essence.</p>
            </div>
            <div class="col-md-4">
                <h2>Secure Brand Login</h2>
                <p>Brands can securely log in to FilterDash's portal to access their personalized filters. Our user-friendly interface makes it easy to manage and download the filters created exclusively for their brand.</p>
            </div>
            <div class="col-md-4">
                <h2>Effortless Brand Enhancement</h2>
                <p>With FilterDash, elevating your brand's image has never been easier. Simply log in, browse your customized filters, and download them instantly. Enhance your brand's social media presence effortlessly.</p>
            </div>
        </div>
    </div>
@endsection
