<header class="header_area white-header">
  <div class="main_menu">
    <div class="search_input" id="search_input_box">
      <div class="container">
        <form class="d-flex justify-content-between" method="" action="">
          <input
            type="text"
            class="form-control"
            id="search_input"
            placeholder="Search Here"
          />
          <button type="submit" class="btn"></button>
          <span
            class="ti-close"
            id="close_search"
            title="Close Search"
          ></span>
        </form>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand" href="/">
          <img class="logo-2" src="{{ asset("assets-user/img/logo01.png") }}" width="163" height="38" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div
          class="collapse navbar-collapse offset"
          id="navbarSupportedContent"
        >
        <ul class="nav navbar-nav menu_nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/tentang-kami">Tentang Kami</a>
          </li>
          <li class="nav-item submenu dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              data-toggle="dropdown"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >Data</a
            >
            <ul class="dropdown-menu">
              <li class="nav-item">
                <a class="nav-link" href="/data/curah-hujan">Data Curah Hujan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/data/irigasi"
                  >Data Irigasi</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/data/jenis-tanah">Data Jenis Tanah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/data/kemiringan">Data Kemiringan</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/data/panen">Data Panen</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/data/kab-kota">Data Kab/Kota</a>
                </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kontak-kami">Kontak Kami</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/login"><i class="ti-user"></i>&nbsp;&nbsp;Login</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link search" id="search">
              <i class="ti-search"></i>
            </a>
          </li>
        </ul>
        </div>
      </div>
    </nav>
  </div>
</header>