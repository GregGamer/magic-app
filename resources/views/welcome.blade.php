@extends('layouts.guest')

@section('title', 'welcome')

@section('content')

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

    @includeIf('guestComponents.team')

    <!-- START THE FEATURETTES -->

    @for($i=0; $i<3; $i++)

        @includeWhen($i==0, 'guestComponents.featuretteDivider')

        @includeIf('guestComponents.featurette')

        @includeIf('guestComponents.featuretteDivider')

    @endfor

    <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

@endsection
