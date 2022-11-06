<template>

<!--<p class="message" v-bind:class="{view:view}">UPDATE！</p>-->

  <header class="l-header">
    <div class="l-header__head">
      <div class="c-widset">
        <h1 class="c-item title">LARAVEL_ADMIN </h1>
        <p class="c-item btns">
          <a class="c-btn" href="/">SITE</a>
          <router-link class="c-btn" v-bind:to="{ name: 'task.list' }">LIST</router-link>
        </p>
      </div>
    </div>
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
          <li class="topWorKs"><a href="#adminWorks">WORKS</a></li>
          <li class="topSkill"><a href="#adminworksfree">WORKS_FREETEXT</a></li>
          <li class="topProduct"><a href="#adminskills">SKILLS</a></li>
          <li class="topProfile"><a href="#adminProduct">PRODUCT</a></li>
          <li class="topProfile"><a href="#adminProfile">PROFILE</a></li>
          <li class="topProfile"><a href="#adminProfileFlow">PROFILE_FLOW</a></li>
        </ul>
      </div>
    </div>
  </header>
  
</template>
 
<script>
export default {};
</script>