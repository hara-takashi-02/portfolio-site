<!-------------------
site本体
------------------->

@extends('site_layouts.app')
@include('site_layouts.head', [])
@include('site_layouts.header', [])
@section('content_site')

<main class="l-main">

    <div class="fillter"></div>

    <section class="topHero">
        <h1 class="topHero__title">
            <span class="fst">Web_engineer</span>
            <span class="sec"><span class="c-blue">T</span>akashi_<span class="c-pink">H</span>ara</span>
        </h1>
    </section>

    <section class="topWorKs c-section js-navSection" id="topWorKs">
        <h2 class="c-title js-anime"><span class="">works</span><span class="">できること</span></h2>
        <div class="topWorKs__list c-widset">

            @foreach($works as $work)
            @if($work->type == 0)
            <div class="topWorKs__item topWorKs__item--wp js-anime">
                <div class="img">
                    @if($work->file_name)
                    <img src="/storage/img/{{$work->file_name}}" alt="">
                    @else
                    <span class="noimg">no image</span>
                    @endif
                </div>
                <p class="title">{{$work->title}}</p>
                <p class="txt">{{$work->content}}</p>
            </div>
            @endif
            @endforeach

        </div>

        <div class="topWorKs__info c-widset">
            @foreach($works as $work)
            @if($work->type == 1)
            <h3 class="title">{{$work->title}}</h3>
            <div class="c-p_wrap c-line18">{!! $work->free_txt !!}</div>
            @endif
            @endforeach
        </div>
    </section>

    <section class="topSkill c-section js-navSection" id="topSkill">
        <h2 class="c-title c-title--r js-anime"><span>skill</span><span>言語・ツール</span></h2>

        <div class="c-widset">
            <div class="topSkill_list topSkill_list--back">
                <h3 class="title">Back end</h3>
                <ul class="js-anime">
                    <li class="meter">
                        <div>rookie</div>
                        <div>regular</div>
                        <div>pro</div>
                    </li>
                    @foreach($skills as $skill)
                    @if($skill->type == 0)
                    <li><span style="width: {{$skill->meter}}%;">{{$skill->title}}</span></li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="topSkill_list topSkill_list--front">
                <h3 class="title">Front end</h3>
                <ul class="js-anime">
                    <li class="meter">
                        <div>rookie</div>
                        <div>regular</div>
                        <div>pro</div>
                    </li>
                    @foreach($skills as $skill)
                    @if($skill->type == 1)
                    <li><span style="width: {{$skill->meter}}%;">{{$skill->title}}</span></li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="topSkill_list topSkill_list--other">
                <h3 class="title">Other</h3>
                <ul class="js-anime">
                    <li class="meter">
                        <div>rookie</div>
                        <div>regular</div>
                        <div>pro</div>
                    </li>
                    @foreach($skills as $skill)
                    @if($skill->type == 2)
                    <li><span style="width: {{$skill->meter}}%;">{{$skill->title}}</span></li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <p class="topSkill__info c-widset">
            <span>rookie - 触ったことがある</span>
            <span>regular - 実務実績がある</span>
            <span>pro - プロとして自信がある</span>
        </p>

    </section>

    <section class="topProduct c-section js-navSection" id="topProduct">
        <h2 class="c-title js-anime"><span>product</span><span>システム施工実績</span></h2>

        <div class="topProduct__list c-widset">
            @foreach($products as $product)
            <div class="topProduct__item js-anime">
                <a href="{{$product->url}}" target="_blank" rel="nofollow">
                    @if($product->file_name)
                    <img src="/storage/img/{{$product->file_name}}" alt="">
                    @else
                    <span class="noimg">no image</span>
                    @endif
                </a>
                <p>{{$product->title}}</p>
            </div>
            @endforeach
        </div>

    </section>

    <section class="topProfile c-section js-navSection" id="topProfile">
        <h2 class="c-title c-title--r js-anime"><span>profile</span><span>自己紹介</span></h2>

        <div class="topProfile__intro c-widset">
            @foreach($profiles as $profile)
            <div class="c-p_wrap c-line18">名前：{{$profile->myname}}<br>年齢：{{$profile->age}}歳<br>出身：{{$profile->place}}<br>{{$profile->school}}<br><br>{{$profile->content}}
            </div>
            @endforeach
        </div>

        <div class="topProfile__flow c-widset">
            @foreach($historys as $history)
            @if($history->file_name)
            <dl>
                @else
                <dl class="noIcon">
                    @endif
                    <dt>
                        @if($history->file_name)
                        <img src="/storage/img/{{$history->file_name}}" alt="">
                        @endif
                    </dt>
                    <dd>
                        age.{{$history->age_st}}~{{$history->age_ed}}<br>
                        {{$history->content}}
                    </dd>
                </dl>
                @endforeach
        </div>

    </section>

</main>

@endsection
@include('site_layouts.footer', [])