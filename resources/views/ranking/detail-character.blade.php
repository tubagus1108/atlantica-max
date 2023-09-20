@extends('layouts.app')
@section('content')
<div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
	<div class="bg-image op-5">
		<img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
	</div>
	<div class="nk-header-table">
		<div class="nk-header-table-cell">
			<div class="container">
			</div>
		</div>
	</div>
</div>

<!-- Section Content -->
<div class="container">
	<div class="nk-social-profile nk-social-profile-container-offset">
		<div class="row">
			<div class="col-md-5 col-lg-3">
				<div class="nk-social-profile-avatar">
					<img src="{{ asset('assets/images/gender.png') }}" alt="ChimsDChamp" title="Mage">
				</div>
			</div>
			<div class="col-md-7 col-lg-9">
				<div class="nk-social-profile-info">
					<div class="nk-gap-2"></div>
					<div class="nk-social-profile-info-last-seen">
												<button class="bg-main-2 text-white">ONLINE</button>
											</div>
					<h1 class="nk-social-profile-info-name">{{$data[0]->name}} - Mage</h1>
				</div>
			</div>
		</div>
	</div>
	
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
                                <div class="nk-social-friends-name">Guild <a class="text-warning link-effect-1" href="/ranking/guild/10">{{$data[0]->guild_name}}</a></div>
                                <div class="nk-social-friends-name">Class&nbsp;<span class="nk-social-friends-meta">Mage</span></div>
								<div class="nk-social-friends-name">Level&nbsp;<span class="nk-social-friends-meta">{{$data[0]->level}}</span></div>
								<div class="nk-social-friends-name">EXP&nbsp;<span class="nk-social-friends-meta">{{$data[0]->experience}}</span></div>
								{{-- <div class="nk-social-friends-name">Life&nbsp;<span class="nk-social-friends-meta">2,676,312</span></div>
								<div class="nk-social-friends-name">Mana&nbsp;<span class="nk-social-friends-meta">2,567,343</span></div> --}}
								<div class="nk-social-friends-name">Total Play Time&nbsp;<span class="nk-social-friends-meta">{{$data[0]->play_second}} Hour(s)</span></div>
								<div class="nk-social-friends-name">Last Connect&nbsp;<span class="nk-social-friends-meta">{{ \Carbon\Carbon::parse($data[0]->last_connect)->format('F j, Y, g:i a') }}</span></div>
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