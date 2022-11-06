<!-------------------
home head
------------------->
@section('header_site')
<header class="l-header">
    <div class="c-burgerBtn" id="js-hamburger-btn">
      <div>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="c-burgerMenu" id="js-hamburger-gnav">
      <div class="c-burgerMenu-inner">
        <ul>
          <li class="topWorKs"><a href="#topWorKs">Works</a></li>
          <li class="topSkill"><a href="#topSkill">Skill</a></li>
          <!--<li><a href="#">Reason</a></li>-->
          <li class="topProduct"><a href="#topProduct">Product</a></li>
          <li class="topProfile"><a href="#topProfile">Profile</a></li>
        </ul>
      </div>
    </div>
  </header>
@endsection