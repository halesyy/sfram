<body id="body">

  <!-- preloader -->
  <div id="preloader">
    <div class="loder-box">
      <div class="battery"></div>
    </div>
  </div>
  <!-- end preloader -->

      <!--
      Fixed Navigation
      ==================================== -->
      <header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">
          <div class="container">
              <div class="navbar-header">
                  <!-- responsive nav button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- /responsive nav button -->

        <!-- logo -->
        <h1 class="navbar-brand">
          <a href="#jekoder">Jekoder</a>
        </h1>
        <!-- /logo -->
              </div>

      <!-- main nav -->
              <nav class="collapse navbar-collapse navbar-right" role="navigation">
                  <ul id="nav" class="nav navbar-nav">
                      <li><a href="#body">Home</a></li>
                      <li><a href="#service">Service</a></li>
                  </ul>
              </nav>
      <!-- /main nav -->

          </div>
      </header>
      <!--
      End Fixed Navigation
      ==================================== -->

  <main class="site-content" role="main">

      <!--
      Home Slider
      ==================================== -->

  <section id="home-slider">
          <div id="slider" class="sl-slider-wrapper">

      <div class="sl-slider">

        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
          <div class="bg-img bg-img-1"></div>

          <div class="slide-caption">
              <div class="caption-content">
                  <h2 class="animated fadeInDown">Jekoder</h2>
                  <span class="animated fadeInDown">Remeber shit</span>
                  <!-- Action buttons. -->
                  <?php if ($is_signedin) { ?>
                    <a href="/dashboard" class="btn btn-blue btn-effect">To App</a>
                  <?php } else { ?>
                    <a href="#" id="open-app" class="btn btn-blue btn-effect">Open</a>
                  <?php } ?>
              </div>
          </div>
        </div>
      </div>

      <!-- Dialog for login and register. -->
      <dialog class="mdl-dialog" id="open-modal" style="width: 500px;">
        <div class="cust-dialog__heading">
          <div class="cust-dialog__heading-part" id="l-head-d">
            <a href="#" id="l-head">LOGIN</a>
          </div>
          <div class="cust-dialog__heading-part" id="r-head-d">
            <a href="#" id="r-head">CREATE ACCOUNT</a>
          </div>
          <div style="float: right">
            <a href="#" id="close-open-app" style="color: #c21f1f; font-weight: bold;">x</a>
          </div>
        </div>
        <div class="mdl-dialog__content">
          <p>
            <div id="login-content">
              <form method="post">
                <input type="text" id="user" name="user" placeholder="Username" class="my-inp" required="required" />
                <input type="password" id="pass" name="pass" placeholder="Password" class="my-inp" required="required" /> <br/>

                <input type="submit" id="submit_login" name="submit" value="Login" class="my-sub" />

                <input type="hidden" name="sub" value="login" />
              </form>
            </div>
            <div id="register-content" style="display: none;">
              <!-- Register content. -->
              <div style="float: right; width: calc(50% - 20px);">
                <div id="inner-r-error-box">
                  Errors
                </div>
              </div>
              <form method="post">
                <input type="email" name="email" placeholder="Email" class="my-inp" required="required" />
                <input type="text" id="user" name="user" placeholder="Username" class="my-inp" required="required" />
                <input type="password" id="pass1" name="pass" placeholder="Password" class="my-inp" required="required" />
                <input type="password" id="pass2" name="pass-second" placeholder="Password... again" class="my-inp" required="required" /> <br/>

                <input type="submit" id="submit_regis" name="submit" value="Create Account" class="my-sub" />

                <input type="hidden" name="sub" value="register" />
              </form>
            </div>
          </p>
        </div>
      </dialog>

    </div><!-- /slider-wrapper -->
  </section>


  <script>
  $(document).ready(function(){
    openAppModal = $('#open-modal')[0];
    // PolyFilling the Dialog if not supported - manual management.
    if (!openAppModal.showModal) {
      dialogPolyFill.registerDialog(openAppModal);
    }
    // Management.
    $('#open-app').click(function(){
      openAppModal.showModal();
    });
    $('#close-open-app').click(function(){
      openAppModal.close();
    });

  });
  </script>
