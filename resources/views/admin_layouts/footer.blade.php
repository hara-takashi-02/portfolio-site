<!-------------------
home footer
------------------->
@section('footer_admin')

<!--<textarea name="editor" class="ckeditor"></textarea>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--<script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>-->
<script src="{{ mix('/js/app.js') }}" defer></script>
<script src="{{ asset('/js/wow.min.js') }}"></script>
<script src="{{ asset('/js/common.js') }}"></script>
<!--<script src="{{ asset('/js/ckeditor.js') }}"></script>-->
<!--<script src="https://unpkg.com/sanitize-html@2.7.0/index.js"></script>-->

<footer class="l-footer">
    <p class="copyright">Copyright&copy; <a href="./">Takashi Hara</a>. All Rights Reserved.</p>
  </footer>
@endsection