<li><a class="nav-link" href="#">{{ __("Mi perfil") }}</a></li>
<li><a class="nav-link" href="#">{{ __("Mis suscripciones") }}</a></li>
<li><a class="nav-link" href="{{ route('invoices.admin') }}">{{ __("Mis facturas") }}</a></li>
<li><a class="nav-link" href="{{ route('courses.subscribed') }}">{{ __("Mis cursos") }}</a></li>
<li><a class="nav-link" href="#">{{ __("Cursos desarrollados por mi") }}</a></li>
<li><a class="nav-link" href="#">{{ __("Crear curso") }}</a></li>
@include('partials.navigations.logged')