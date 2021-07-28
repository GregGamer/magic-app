
<!-- Three columns of text below the carousel -->
<div class="row">

    @for($i=0; $i<3; $i++)

        @includeIf('guestComponents.teamItem')

    @endfor

</div><!-- /.row -->
