@extends('tablar::page') {{-- Asegúrate de que este layout existe y es el correcto --}}

@section('title')
Nosotros
@endsection

@section('content')
<div class="container">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Acerca de nosotros
                    </div>
                    <h2 class="page-title">
                        {{ __('Acerca de nosotros') }}
                    </h2>
                    <div id="carousel-sample" class="carousel slide" data-bs-ride="carousel" style="max-width: 50%; margin: 0 auto; height: 400px; overflow: hidden;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0"
                                class="active"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="5"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="6"></button>
                            <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="7"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" alt="" src="assets/Img_1.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_1.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_3.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_4.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_5.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_7.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_8.jpg" />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt=""
                                    src="assets/Img_9.jpg" />
                            </div>
                        </div>
                        <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>

                    <h1 class="text-center my-5">Ferro Center</h1>
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered text-center mx-auto" style="width: 80%;">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Información de la Ferretería</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ubicación</td>
                                    <td>Cayambe, Provincia de Pichincha</td>
                                </tr>
                                <tr>
                                    <td>Misión</td>
                                    <td>Proporcionar productos de alta calidad a precios competitivos, asegurando
                                        siempre la satisfacción del cliente.</td>
                                </tr>
                                <tr>
                                    <td>Visión</td>
                                    <td>Ser líderes en el mercado de ferreterías, expandiendo nuestras sucursales a
                                        nivel nacional y mejorando constantemente nuestra oferta de productos.</td>
                                </tr>
                                <tr>
                                    <td>Mensaje Motivacional</td>
                                    <td>Comprometidos con el crecimiento y la innovación continua para brindar lo mejor
                                        a nuestros clientes.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height: 50px;"></div>
<footer>
  <div class="footer-upper" style="background-color: #313c52; padding: 20px 0;">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h5 class="text-white">Ferrocenter</h5>
          <ul class="list-unstyled text-small">
            <!-- Usar 'route' para generar el enlace correcto -->
            <li><a class="text-white" href="{{ route('acercanosotros.nosotros') }}">Acerca de nosotros</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="text-white">Servicio al cliente</h5>
          <ul class="list-unstyled text-small">
            <li><span class="text-white">Garantía</span></li>
            <li><span class="text-white">Devoluciones</span></li>
            <li><span class="text-white">Contacto</span></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="text-white">Recursos</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-white" href="https://wa.me/+593969767395">Contáctanos</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-lower" style="background-color: #2a3547; color: white; padding: 10px 0; text-align: center;">
    <div class="container">
      <span>©2024 FerroCenter S.A. Todos los derechos reservados.</span>
    </div>
  </div>
</footer>
@endsection