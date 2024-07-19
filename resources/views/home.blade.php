@extends('tablar::page')

@section('title')
    FerroCenter
@endsection

@section('styles')
    <style>
        .carousel-item img {
            width: calc(20% - 4px);
            /* 20% para cada imagen, con un pequeño ajuste para el espaciado */
            height: 100px;
            /* Altura fija para todas las imágenes para mantener la uniformidad */
            object-fit: cover;
            /* Asegura que la imagen cubra completamente su espacio sin distorsionar su aspecto */
        }

        .carousel-item .d-flex {
            height: 100px;
            /* Altura del contenedor de imágenes */
        }
    </style>
@endsection


@section('content')
    <div class="container mt-3">
        <div id="carousel-sample" class="carousel slide" data-bs-ride="carousel"
            style="width: 100%; margin: 0 auto; height: 600px; overflow: hidden;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="5"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="6"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_1.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Bienvenido a Ferro Center
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_3.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Hacemos más rentable tu negocio
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_4.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Ferro Center más cerca del cliente
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_5.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Calidad que construye confianza
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_7.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Soluciones para cada necesidad
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_8.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Expertos en ferretería
                    </div>
                </div>

                <div class="carousel-item" style="position: relative; height: 600px; overflow: hidden;">
                    <img class="d-block" src="assets/Img_9.jpg" alt=""
                        style="width: 100%; height: auto; min-height: 100%;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.60);">
                    </div>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; font-size: 24px; font-weight: bold; width: 100%;">
                        Transformamos espacios, mejoramos vidas
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        <div style="height: 50px;"></div>
        <div>
            <h1>Nuestras categorías</h1>
        </div>
        <div style="height: 50px;"></div>

        <div class="row g-4">
            <!-- Herramientas y Equipos de Construcción -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="/assets/Herramientas.jpg"
                            alt="Herramientas y Equipos de Construcción" style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title"><a href="#">Herramientas y Equipos de Construcción</a></h3>
                        <p class="text-secondary">Encuentra las mejores herramientas para tu proyecto de construcción.</p>
                    </div>
                </div>
            </div>
            <!-- Accesorios para Baño -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top " src="/assets/AccesoriosBaño.jpeg" alt="Accesorios para Baño"
                            style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title "><a href="#">Accesorios para Baño</a></h3>
                        <p class="text-secondary">Transforma tu baño con nuestros accesorios de diseño moderno que combinan
                            estilo y
                            practicidad.</p>
                    </div>
                </div>
            </div>
            <!-- Pinturas y Solventes -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="/assets/Pinturas.png" alt="Pinturas y Solventes"
                            style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title"><a href="#">Pinturas y Solventes</a></h3>
                        <p class="text-secondary">Asegura el acabado perfecto con nuestras pinturas y solventes de alta
                            calidad,
                            resistentes y duraderos.</p>
                    </div>
                </div>
            </div>
            <!-- Electricidad y Electrónica -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="/assets/Electricidad.jpg" alt="Electricidad y Electrónica"
                            style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title"><a href="#">Electricidad y Electrónica</a></h3>
                        <p class="text-secondary">Descubre soluciones innovadoras para tus necesidades eléctricas y
                            electrónicas con
                            nuestra amplia gama de productos.</p>
                    </div>
                </div>
            </div>
            <!-- Plomería y Tuberías -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="/assets/Plomerias.jpg" alt="Plomería y Tuberías"
                            style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title"><a href="#">Plomería y Tuberías</a></h3>
                        <p class="text-secondary">Obtén la máxima eficiencia y durabilidad con nuestra selección de
                            productos para
                            plomería y tuberías.</p>
                    </div>
                </div>
            </div>
            <!-- Artículos de Seguridad -->
            <div class="col-md-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="/assets/articulos.jpg" alt="Artículos de Seguridad"
                            style="height: 300px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h3 class="card-title"><a href="#">Artículos de Seguridad</a></h3>
                        <p class="text-secondary">Protege a tu equipo de trabajo con nuestros productos de seguridad
                            industrial de
                            primera calidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-upper" style="background-color: #313c52; padding: 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-white">Ferrocenter</h5>
                        <ul class="list-unstyled text-small">
                            <!-- Usar 'route' para generar el enlace correcto -->
                            <li><a class="text-white" href="{{ route('acercanosotros.nosotros') }}">Acerca de nosotros</a>
                            </li>
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
