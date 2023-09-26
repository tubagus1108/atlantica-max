@extends('layouts.app')
@section('content')
<div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
	<div class="bg-image">
		<img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
	</div>
	<div class="nk-header-table">
		<div class="nk-header-table-cell">
			<div class="container">
				<h1 class="nk-title">Guild - {{$data[0]->name}}</h1>
			</div>
		</div>
	</div>
</div>

<!-- Section Content -->
<div class="container">
	<div class="row vertical-gap">
		<div class="col-lg-3"></div>
		<div class="col-lg-9">
			<div class="nk-gap-2 d-none d-lg-block"></div>
			<div class="nk-social-container">
				<ul class="nk-social-friends">
					<li>
						<div class="nk-social-friends-avatar">
							<img src="{{ asset('assets/images/gender.png') }}" alt="ChimsDChamp">
						</div>
						<div class="nk-social-friends-content">
							<div class="nk-social-friends-info">
                                <div class="nk-social-friends-name">Leader <a class="text-warning link-effect-1" href="/ranking/guild/10"></a></div>
								<div class="nk-social-friends-name">Level&nbsp;<span class="nk-social-friends-meta">{{$data[0]->level}}</span></div>
								<div class="nk-social-friends-name">EXP&nbsp;<span class="nk-social-friends-meta">{{ number_format($data[0]->experience) }}</span></div>
								<div class="nk-social-friends-name">Create Date&nbsp;<span class="nk-social-friends-meta">{{ \Carbon\Carbon::parse($data[0]->created_at)->format('F j, Y, g:i a') }}</span></div>
							</div>
						</div>
					</li>
                </ul>
			</div>
		</div>
	</div>
	
	<div class="nk-gap-6"></div>
	<div class="nk-gap-2"></div>
</div>
@endsection