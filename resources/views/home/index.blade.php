
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  {!!Html::style('build/assets/font/iconsmind/style.css')!!}
  {!!Html::style('build/assets/font/simple-line-icons/css/simple-line-icons.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap-stars.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap.min.css')!!}
  {!!Html::style('build/assets/css_new/vendor/owl.carousel.min.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap-stars.css')!!}
  {!!Html::style('build/assets/css_new/vendor/video-js.css')!!}
  {!!Html::style('build/assets/css_new/main.css')!!}

</head>


<body>
  <div class="landing-page">
    <div class="mobile-menu">
      <a href="#home" class="logo-mobile scrollTo">
        <span></span>
      </a>
      <ul class="navbar-nav">
        <li class="nav-item"><a href="#features" class="scrollTo">FEATURES</a></li>
        <li class="nav-item"><a href="#reviews" class="scrollTo">REVIEWS</a></li>
        <li class="nav-item"><a href="#pricing" class="scrollTo">PRICING</a></li>
        <li class="nav-item mb-2"><a href="#blog" class="scrollTo">BLOG</a></li>
        <li class="nav-item">
          <div class="separator"></div>
        </li>
        <li class="nav-item mt-2"><a href="#apps">SIGN IN</a></li>
        <li class="nav-item"><a href="#apps">SIGN UP</a></li>
      </ul>
    </div>

    <div class="main-container">
      <nav class="landing-page-nav">
        <div class="container d-flex align-items-center justify-content-between">
          <a class="navbar-logo pull-left scrollTo" href="#home">
            <span class="white"></span>
            <span class="dark"></span>
          </a>
          <ul class="navbar-nav d-none d-lg-flex flex-row">
            <li class="nav-item"><a href="#features" class="scrollTo">FEATURES</a></li>
            <li class="nav-item"><a href="#reviews" class="scrollTo">REVIEWS</a></li>
            <li class="nav-item"><a href="#pricing" class="scrollTo">PRICING</a></li>
            <li class="nav-item"><a href="#blog" class="scrollTo">BLOG</a></li>
            <li class="nav-item mr-3"><a href="#apps">SIGN IN</a></li>
            <li class="nav-item pl-2">
              <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="#">SIGN UP</a>
            </li>
          </ul>
          <a href="#" class="mobile-menu-button">
            <i class="simple-icon-menu"></i>
          </a>
        </div>
      </nav>

      <div class="content-container" id="home">
        <div class="section home">
          <div class="container">
            <div class="row home-row">
              <div class="col-12 d-block d-md-none">
                <a href="#">
                  <img alt="mobile hero" class="mobile-hero" src="{{asset('build/assets/imagenes/landing-page/home-hero-mobile.png')}}" />
                </a>
              </div>

              <div class="col-12 col-xl-4 col-lg-5 col-md-6">
                <div class="home-text">
                  <div class="display-1">TRIA<br>GROUP</div>
                  <p class="white mb-5">Es una aplicaci&oacute;n m&oacute;vil Multi-plataforma, app y web a nivel mundial dirigida a la Propiedad Horizontal <br />
                    <br />
                    Conjuntos Residenciales , Condominios , Edificios Corporativos y centros comerciales.<br />
                    <br />
                  </p>
                  <a class="btn btn-outline-semi-light btn-xl" href="LandingPage.Auth.Register.html">REGISTER
                  NOW</a>
                </div>
              </div>
              <div class="col-12 col-xl-7 offset-xl-1 col-lg-7 col-md-6  d-none d-md-block">
                <a href="#">
                  <img alt="hero" src="{{asset('build/assets/imagenes/landing-page/home-hero.png')}}" />
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                <h1 style="color: #fff">FUNCIONALIDADES</h1>
                <p style="color: #fff">¿ Que propiedades pueden hacer parte de TRIA APP ? <br>
                  Conjuntos residenciales o condominios, edificios corporativos , centros comerciales , centros industriales e inmobiliarias.<br>
                  con TRIA APP el administrador de la propiedad puede tener comunicación en tiempo real y en simultaneo con el propietario y arrendatario de la propiedad o inmobiliaria. <br>
                  TRIA APP es multi -plataforma el usuario puede operar desde la web, tablet o móvil. la distribución de la información va hacer mas efectiva y rapída, evitando el uso del papel.<br><br><br>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 p-0">
                <div class="owl-container">
                  <div class="owl-carousel home-carousel">
                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Cupcake large-icon"></i>
                          
                        </div>
                        <div>
                          <p class="detail-text">
                            Actualización de la base de datos de la propiedad en tiempo real
                          </p>
                        </div>
                        <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Line-Chart2 large-icon"></i>
                          <h5 class="mb-0 font-weight-semibold">
                            Superfine Charts
                          </h5>
                        </div>
                        <div>
                          <p class="detail-text">
                            Charts that looks good with color, opacity, border
                            and shadow.
                          </p>
                        </div>
                        <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Three-ArrowFork large-icon"></i>
                          <h5 class="mb-0 font-weight-semibold">
                            Two Panels Menu
                          </h5>
                        </div>
                        <div>
                          <p class="detail-text">
                            A menu that looks good and does the job well.
                          </p>
                        </div>
                        <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Funny-Bicycle large-icon"></i>
                          <h5 class="mb-0 font-weight-semibold">
                            Layouts for the Job
                          </h5>
                        </div>
                        <div>
                          <p class="detail-text">
                            Lots of different layouts for different jobs.
                          </p>
                        </div>
                        <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Full-View large-icon"></i>
                          <h5 class="mb-0 font-weight-semibold">
                            Extra Responsive
                          </h5>
                        </div>
                        <div>
                          <p class="detail-text">
                            Better experiences for smaller and larger screens
                            by adding Xxl and Xxs.
                          </p>
                        </div>
                        <a class="btn btn-link font-weight-semibold" href="#">VIEW</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#features" id="homeCircleButton">
            <i class="simple-icon-arrow-down"></i>
          </a>
        </div>

        <div class="section">
          <div class="container" id="features">

            <div class="row feature-row">
              <div class="col-12 col-md-6 col-lg-5 d-flex align-items-center">
                <div class="d-flex">
                  <div class="feature-icon-container">
                    <div class="icon-background">
                      <i class="fas fa-fw fa-ban"></i>
                    </div>
                  </div>
                  <div class="feature-text-container">
                    <h2>Pleasant Design</h2>
                    <p>
                      As a web developer we enjoy to work on something looks
                      nice. It is not an absolute necessity but it really
                      motivates us that final product will look good for user
                      point of view. <br />
                      <br />
                      So we put a lot of work into colors, icons, composition
                      and design harmony. Themed components and layouts with
                      same design language. <br />
                      <br />
                      We kept user experience principles always at the heart
                      of the design process.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6 offset-lg-1 offset-md-0 position-relative">
                <div class="background-item-1"></div>
                <img alt="feature" class="feature-image-right feature-image-charts position-relative" src="{{asset('build/assets/imagenes/landing-page/feature.png')}}" />
              </div>
            </div>

            <div class="row feature-row">
              <div class="col-12 col-md-6 col-lg-6 order-2 order-md-1">
                <img alt="feature" class="feature-image-left feature-image-charts" src="{{asset('build/assets/imagenes/landing-page/feature-2.png')}}" />
              </div>

              <div class="col-12 col-md-6 offset-md-0 col-lg-5 offset-lg-1 d-flex align-items-center order-1 order-md-2">
                <div class="d-flex">
                  <div class="feature-icon-container">
                    <div class="icon-background">
                      <i class="fas fa-fw fa-ban"></i>
                    </div>
                  </div>
                  <div class="feature-text-container">
                    <h2>Layouts for the Job</h2>
                    <p>
                      Layouts are the real thing, they need to be accurate and
                      right for the job. They should be functional for both
                      user and developer. <br />
                      <br />
                      We created lots of different layouts for different jobs.
                      <br />
                      <br />
                      Listing pages with view mode changing capabilities,
                      shift select and select all functionality, application
                      layouts with an additional menu, authentication and
                      error layouts which has a different design than the
                      other pages were our main focus. We also created details
                      page with tabs that can hold many components.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row feature-row">
              <div class="col-12 col-md-6 col-lg-5 d-flex align-items-center">
                <div class="d-flex">
                  <div class="feature-icon-container">
                    <div class="icon-background">
                      <i class="fas fa-fw fa-ban"></i>
                    </div>
                  </div>
                  <div class="feature-text-container">
                    <h2>Superfine Charts</h2>
                    <p>
                      Using charts is a good way to visualize data but they
                      often look ugly and breaks the rhythm of design. <br />
                      <br />
                      We concentrated on a single chart library and tried to
                      create charts that looks good with color, opacity,
                      border and shadow. <br />
                      <br />
                      Used certain plugins and created some to make charts
                      even more useful and beautiful.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6 offset-lg-1 offset-md-0 ">
                <img alt="feature" class="feature-image-right feature-image-charts" src="{{asset('build/assets/imagenes/landing-page/feature-3.png')}}" />
              </div>
            </div>
          </div>
        </div>

        <div class="section background">
          <div class="container" id="reviews">
            <div class="row">
              <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                <h1>Client Reviews</h1>
                <p>
                  People love Dore. We have received lots of awesome reviews
                  for desing quality, documentation, code quality,
                  flexibility, features, support and other categories. Here
                  are some of them.
                </p>
              </div>
              <div class="col-12 p-0">
                <div class="owl-container">
                  <div class="owl-carousel review-carousel">
                    <div class="card">
                      <div class="card-body text-center pt-5 pb-5">
                        <div>
                          <img alt="profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto" src="{{asset('build/assets/imagenes/profile-pic-l-7.jpg')}}" />
                          <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                            codebars
                          </h5>
                          <select class="rating" data-current-rating="5" data-readonly="true">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <p class="text-muted text-small">Code Quality</p>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 ">
                            Many that live deserve death. And some that die
                            deserve life. Can you give it to them? Then do not
                            be eager to deal out death in judgement. For even
                            the very wise cannot see all ends.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center pt-5 pb-5">
                        <div>
                          <img alt="profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto" src="{{asset('build/assets/imagenes/profile-pic-l-11.jpg')}}" />
                          <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                            helvetica
                          </h5>
                          <select class="rating" data-current-rating="5" data-readonly="true">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <p class="text-muted text-small">Code Quality</p>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 ">
                            That's the only place in all the lands we've ever
                            heard of that we don't want to see any closer; and
                            that's the one place we're trying to get to! And
                            that's just where we can't get, nohow.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center pt-5 pb-5">
                        <div>
                          <img alt="profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto" src="{{asset('build/assets/imagenes/profile-pic-l-2.jpg')}}" />
                          <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                            logorrhea
                          </h5>
                          <select class="rating" data-current-rating="5" data-readonly="true">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <p class="text-muted text-small">Code Quality</p>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 ">
                            Yet such is oft the course of deeds that move the
                            wheels of the world: small hands do them because
                            they must, while the eyes of the great are
                            elsewhere.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center pt-5 pb-5">
                        <div>
                          <img alt="profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto" src="{{asset('build/assets/imagenes/profile-pic-l-8.jpg')}}" />

                          <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                            nanaimo
                          </h5>
                          <select class="rating" data-current-rating="5" data-readonly="true">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <p class="text-muted text-small">Code Quality</p>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 ">
                            I have passed through fire and deep water, since
                            we parted. I have forgotten much that I thought I
                            knew, and learned again much that I had forgotten
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center pt-5 pb-5">
                        <div>
                          <img alt="profile" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail mx-auto" src="{{asset('build/assets/imagenes/profile-pic-l-11.jpg')}}" />
                          <h5 class="mb-0 font-weight-semibold color-theme-1 mb-3">
                            helvetica
                          </h5>
                          <select class="rating" data-current-rating="5" data-readonly="true">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <p class="text-muted text-small">Code Quality</p>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 ">
                            That's the only place in all the lands we've ever
                            heard of that we don't want to see any closer; and
                            that's the one place we're trying to get to! And
                            that's just where we can't get, nohow.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="slider-nav text-center">
                    <a href="#" class="left-arrow owl-prev">
                      <i class="simple-icon-arrow-left"></i>
                    </a>
                    <div class="slider-dot-container"></div>
                    <a href="#" class="right-arrow owl-next">
                      <i class="simple-icon-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section mb-0">
          <div class="container" id="pricing">

            <div class="row">
              <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                <h1>Pricing</h1>
                <p>
                  We tried to create an admin theme that we would like to use
                  ourselves so we listed our priorities. We would like to have
                  a theme that is not over complicated to use, does the job
                  well, contains must have components and looks really nice.
                </p>
              </div>
            </div>


            <div class="row row-eq-height price-container mt-5">

              <div class="col-md-12 col-lg-4 mb-4 price-item">
                <div class="card">
                  <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                    <div class="price-top-part">
                      <i class="iconsmind-Male large-icon"></i>
                      <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">DEVELOPER</h5>
                      <p class="text-large mb-2 text-default">$11</p>
                      <p class="text-muted text-small">User/Month</p>
                    </div>
                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column">
                      <ul class="list-unstyled">
                        <li>
                          <p class="mb-0 ">
                            Number of end products 1
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Two factor authentication
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Free updates
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Forum support
                          </p>
                        </li>
                      </ul>
                      <div>
                        <a href="#" class="btn btn-link btn-empty btn-lg">PURCHASE <i class="simple-icon-arrow-right"></i></a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4 mb-4 price-item">
                <div class="card">
                  <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                    <div class="price-top-part">
                      <i class="iconsmind-MaleFemale large-icon"></i>
                      <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">TEAM</h5>
                      <p class="text-large mb-2 text-default">$17</p>
                      <p class="text-muted text-small">User/Month Up to 10 Users</p>
                    </div>
                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column">
                      <ul class="list-unstyled">
                        <li>
                          <p class="mb-0 ">
                            24/5 support
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Number of end products 1
                          </p>
                        </li>

                        <li>
                          <p class="mb-0 ">
                            Two factor authentication
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Free updates
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Forum support
                          </p>
                        </li>
                      </ul>
                      <div>
                        <a href="#" class="btn btn-link btn-empty btn-lg">PURCHASE <i class="simple-icon-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4 mb-4 price-item">
                <div class="card">
                  <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                    <div class="price-top-part">
                      <i class="iconsmind-Mens large-icon"></i>
                      <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">ENTERPRISE</h5>
                      <p class="text-large mb-2 text-default">$19</p>
                      <p class="text-muted text-small">User/Month 10+ Users</p>
                    </div>
                    <div class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex price-feature-list flex-column">
                      <ul class="list-unstyled">
                        <li>
                          <p class="mb-0 ">
                            24/7 support
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Number of end products 1
                          </p>
                        </li>

                        <li>
                          <p class="mb-0 ">
                            Two factor authentication
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Free updates
                          </p>
                        </li>
                        <li>
                          <p class="mb-0 ">
                            Forum support
                          </p>
                        </li>
                      </ul>

                      <div>
                        <a href="#" class="btn btn-link btn-empty btn-lg">PURCHASE <i class="simple-icon-arrow-right"></i></a>
                      </div>
                    </div>



                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>



        <div class="section background background-no-bottom mb-0">
          <div class="container" id="blog">
            <div class="row">
              <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                <h1>Latest from Blog</h1>
                <p>
                  Humanitarian resist incubator movements outcomes.
                  Low-hanging fruit synergy correlation accessibility; save
                  the world unprecedented challenge scalable. Leverage
                  strategy, and, game-changer, agile, social return on
                  investment.
                </p>
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-12 col-lg-6 mb-4">
                <div class="card flex-row mb-5 listing-card-container">
                  <div class="w-40 position-relative">
                    <a href="LandingPage.Blog.Image.html">
                      <img class="card-img-left" src="{{asset('build/assets/imagenes/landing-page/blog-thumb-1.jpg')}}" alt="Card image cap">
                      <span class="badge badge-pill badge-theme-1 position-absolute badge-top-left">NEW</span>
                    </a>
                  </div>
                  <div class="w-60 d-flex align-items-center">
                    <div class="card-body">
                      <a href="LandingPage.Blog.Image.html">
                        <h3 class="mb-4 listing-heading ellipsis">Progressively Maintain
                        Extensive Infomediaries</h3>
                      </a>
                      <p class="listing-desc ellipsis">
                        Credibly reintermediate backend ideas for cross-platform models.
                        Continually reintermediate integrated processes through technically
                        sound intellectual capital.
                      </p>
                      <footer>
                        <p class="text-muted text-small mb-0 font-weight-light">27.12.2018</p>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg-6 mb-4">
                <div class="card flex-row mb-5 listing-card-container">
                  <div class="w-40 position-relative">
                    <a href="LandingPage.Blog.Video.html" class="video-play-icon">
                      <span></span>
                    </a>
                    <img class="card-img-left" src="{{asset('build/assets/imagenes/landing-page/blog-thumb-2.jpg')}}" alt="Card image cap">
                  </div>
                  <div class="w-60 d-flex align-items-center">
                    <div class="card-body">
                      <a href="LandingPage.Blog.Video.html">
                        <h3 class="mb-4 listing-heading ellipsis">Assertively Iterate Resource
                        Maximizing</h3>
                      </a>
                      <p class="listing-desc ellipsis">
                        Keeping your eye on the ball while performing a deep dive on the
                        start-up mentality to derive convergence on cross-platform integration.
                      </p>
                      <footer>
                        <p class="text-muted text-small mb-0 font-weight-light">04.12.2018</p>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-12 col-lg-6 mb-4">
                <div class="card flex-row mb-5 listing-card-container">
                  <div class="w-40 position-relative">
                    <a href="LandingPage.Blog.Image.html">
                      <img class="card-img-left" src="{{asset('build/assets/imagenes/landing-page/blog-thumb-3.jpg')}}" alt="Card image cap">
                    </a>
                  </div>
                  <div class="w-60 d-flex align-items-center">
                    <div class="card-body">
                      <a href="LandingPage.Blog.Image.html">
                        <h3 class="mb-4 listing-heading ellipsis">Podcasting Operational Change
                        Management Inside of Workflows</h3>
                      </a>
                      <p class="listing-desc ellipsis">
                        uickly deploy strategic networks with compelling e-business. Credibly
                        pontificate highly efficient manufactured products and enabled data.
                      </p>
                      <footer>
                        <p class="text-muted text-small mb-0 font-weight-light">27.12.2018</p>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg-6 mb-4">
                <div class="card flex-row mb-5 listing-card-container">
                  <div class="w-40 position-relative">
                    <a href="LandingPage.Blog.Image.html">
                      <img class="card-img-left" src="{{asset('build/assets/imagenes/landing-page/blog-thumb-4.jpg')}}" alt="Card image cap">
                    </a>
                  </div>
                  <div class="w-60 d-flex align-items-center">
                    <div class="card-body">
                      <a href="LandingPage.Blog.Image.html">
                        <h3 class="mb-4 listing-heading ellipsis">Objectively Innovate
                        Empowered Manufactured Products</h3>
                      </a>
                      <p class="listing-desc ellipsis">
                        Completely synergize resource taxing relationships via premier niche
                      markets. </p>
                      <footer>
                        <p class="text-muted text-small mb-0 font-weight-light">04.12.2018</p>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="section footer mb-0">
          <div class="container">
            <div class="row footer-row">
              <div class="col-12 text-right">
                <a class="btn btn-circle btn-outline-semi-light footer-circle-button scrollTo" href="#home" id="footerCircleButton">
                  <i class="simple-icon-arrow-up"></i>
                </a>
              </div>
              <div class="col-12 text-center footer-content">
                <a href="#home" class="scrollTo">
                  <img class="footer-logo" alt="footer logo" src="{{asset('build/assets/imagenes/landing-page/logo-footer.svg')}}" />
                </a>
              </div>
            </div>
            <div class="row" id="footerMenuAccordion">
              <div class="col-12 col-xs-6 col-sm-3 offset-0 col-lg-2 offset-lg-2 footer-menu mb-5">
                <div class="d-flex flex-column align-items-center">
                  <a href="#" class="d-inline-block d-xs-none collapse-button mb-1" data-toggle="collapse" data-target="#menuGroup1"
                  aria-expanded="true">COMPANY <i class="simple-icon-arrow-down"></i></a>
                  <ul class="list-unstyled footer-menu collapse d-xs-block mb-0" id="menuGroup1" data-parent="#footerMenuAccordion">
                    <li class="d-none d-xs-inline-block">
                      <p>COMPANY</p>
                    </li>
                    <li><a href="LandingPage.About.html">About</a></li>
                    <li><a href="LandingPage.Blog.html">Blog</a></li>
                    <li><a href="LandingPage.Careers.html">Careers</a></li>
                    <li><a href="LandingPage.Contact.html">Contact</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-12 col-xs-6 col-sm-3 col-lg-2 footer-menu mb-5">
                <div class="d-flex flex-column align-items-center">
                  <a href="#" class="d-inline-block d-xs-none collapse-button mb-1" data-toggle="collapse" data-target="#menuGroup2"
                  aria-expanded="true">PRODUCT <i class="simple-icon-arrow-down"></i></a>
                  <ul class="list-unstyled footer-menu collapse d-xs-block  mb-0" id="menuGroup2" data-parent="#footerMenuAccordion">
                    <li class="d-none d-xs-inline-block">
                      <p>PRODUCT</p>
                    </li>
                    <li><a href="LandingPage.Features.html">Features</a></li>
                    <li><a href="LandingPage.Prices.html">Pricing</a></li>
                    <li><a href="LandingPage.Docs.html">Api</a></li>
                    <li><a href="LandingPage.Docs.html">Enterprise</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-12 col-xs-6 col-sm-3 col-lg-2 footer-menu mb-5">
                <div class="d-flex flex-column align-items-center">
                  <a href="#" class="d-inline-block d-xs-none collapse-button mb-1" data-toggle="collapse" data-target="#menuGroup3"
                  aria-expanded="true">LEARNING <i class="simple-icon-arrow-down"></i></a>
                  <ul class="list-unstyled footer-menu collapse d-xs-block mb-0" id="menuGroup3" data-parent="#footerMenuAccordion">
                    <li class="d-none d-xs-inline-block">
                      <p>LEARNING</p>
                    </li>
                    <li><a href="LandingPage.Contact.html">Help</a></li>
                    <li><a href="LandingPage.Docs.Detail.html">Quick Start</a></li>
                    <li><a href="LandingPage.Docs.html">Docs</a></li>
                    <li><a href="LandingPage.Videos.html">Videos</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-12 col-xs-6 col-sm-3 col-lg-2 footer-menu mb-5">
                <div class="d-flex flex-column align-items-center">
                  <a href="#" class="d-inline-block d-xs-none collapse-button mb-1" data-toggle="collapse" data-target="#menuGroup4"
                  aria-expanded="true">LEGAL <i class="simple-icon-arrow-down"></i></a>
                  <ul class="list-unstyled footer-menu collapse d-xs-block mb-0" id="menuGroup4" data-parent="#footerMenuAccordion">
                    <li class="d-none d-xs-inline-block">
                      <p>LEGAL</p>
                    </li>
                    <li><a href="LandingPage.Content.html">Security</a></li>
                    <li><a href="LandingPage.Content.html">Privacy</a></li>
                    <li><a href="LandingPage.Content.html">Cookies</a></li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
          <div class="separator mt-5"></div>

          <div class="container copyright pt-5 pb-5">
            <div class="row">
              <div class="col-12"></div>
              <div class="col-6">
                <p class="mb-0">2018 © ColoredStrategies</p>
              </div>
              <div class="col-6 text-right social-icons">
                <ul class="list-unstyled list-inline">
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-facebook"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-twitter"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-instagram"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</body>
</html>


{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/owl.carousel.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery.barrating.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery.barrating.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/headroom.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jQuery.headroom.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jquery.scrollTo.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jquery.autoellipsis.js')!!}
{!!Html::script('build/assets/js_new/dore.scripts.landingpage.js')!!}
{!!Html::script('build/assets/js_new/scripts.js')!!}


