<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
  @include('partials.nav')

  <main>
    {{ $slot }}
  </main>

  @include('partials.bottom')

  @include('partials.script')
</body>

</html>