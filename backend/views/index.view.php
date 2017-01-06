<style>
  body {
    font-family: Roboto;
    padding-top: 40px;
    padding-bottom: 40px;
  }
  .carousel-inner > .item > img, .carousel-inner > .item > a > img {
    display: block;
    height: auto;
    max-width: 100%;
    line-height: 1;
    width: 100%; // Add this
  }
  .vertical-center {
    min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh; /* These two lines are counted as one :-)       */

    display: flex;
    align-items: center;
  }
</style>

<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        Temp
      </a>

      <button type="button" class="navbar-toggle" data-toggle="collapse"
       data-target="#navbar-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
    </div> <!-- Navbar header. -->
    <div class="collapse navbar-collapse" id="navbar-collapse">

      <a href="" class="btn btn-info navbar-btn navbar-right">Top button</a>
      <ul class="nav navbar-nav">
        <li><a href="#link-1">Test-Link-1</a></li>
        <li><a href="#link-2">Test-Link-2</a></li>
        <li><a href="#link-3">Test-Link-3</a></li>
        <li><a href="#link-4">Test-Link-3</a></li>
        <li role="presentation" class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Dropdown <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div> <!-- Container. -->
</nav> <!-- Navbar. -->
<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <p class="navbar-text">This template was made by Jek</p>
</nav> <!-- Fixed - Bottom navbar. -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <!-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li> -->
    <!-- <li data-target="#myCarousel" data-slide-to="1" class=""></li>
    <li data-target="#myCarousel" data-slide-to="2" class=""></li> -->
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="http://www.washington.edu/informedchoice/files/2015/10/STAY-INFORMED_quad_sunset.jpg" alt="First slide">
      <div class="container">
        <div class="carousel-caption">
          <div class="">
            <h1 style="font-size: 60px;">Welcome to Jeks Template</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="item">
      <img class="second-slide" src="http://www.washington.edu/informedchoice/files/2015/10/SHAREDGOVERNANCE_RainyCampus_38.jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>Another example headline.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img class="third-slide" src="http://www.washington.edu/informedchoice/files/2015/10/NEWSUPDATES_MG_1758.jpg" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>One more for good measure.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div> -->
  </div>
  <!-- <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a> -->
</div> <!-- End of carousel. -->

<!-- Jumbotron. -->
<div class="jumbotron">
  <div class="container text-center">
    <h1>My Template</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
    <div class="btn-group">
      <a href="" class="btn btn-md btn-danger">Hey</a>
      <a href="" class="btn btn-md btn-danger">That's</a>
      <a href="" class="btn btn-md btn-danger">Pretty</a>
      <a href="" class="btn btn-md btn-danger">Good</a>
    </div>
  </div>
</div> <!-- Jumbotron. -->











<div class="container">
  <section>
    <div class="page-header" id="link-1">
      <h2>Link 1 for template <small>This is for link 1!</small></h2>
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Dropdown
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div> <!-- End dropdown. -->
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit dis cant uber cancer.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
    </div>
  </section>
  <section>
    <div class="page-header" id="link-1">
      <h2>Link 1 for template <small>This is for link 1!</small></h2>
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Dropdown
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div> <!-- End dropdown. -->
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit dis cant uber cancer.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
    </div>
  </section>
  <section>
    <div class="page-header" id="link-1">
      <h2>Link 1 for template <small>This is for link 1!</small></h2>
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Dropdown
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div> <!-- End dropdown. -->
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit dis cant uber cancer.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <footer>urnan</footer>
        </blockquote>
      </div>
    </div>
  </section>
</div>
