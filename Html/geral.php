<?php
  session_start();
  require_once "../Scripts/usuarioEntidade.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
  <script>
        var nomeUsuario = "<?php echo $_SESSION['nome']; ?>";
        var sobrenomeUsuario = "<?php echo $_SESSION['sobrenome']; ?>";
        var idUsuario = "<?php echo $_SESSION['ID']; ?>";
        var bioUsuario = "<?php echo $_SESSION['bio']; ?>";
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Geral | GreenChat</title>
    <link rel="stylesheet" href="../Css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Css/geral-style.css" />
    <script src="../Scripts/bootstrap.min.js"></script>
    <script src="../Scripts/jquery-3.7.1.min.js"></script>
    <script src="../Scripts/generalScript.js"></script>
    <script src="../Scripts/general_requisitions.js"></script>
    
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid col-10">
          <a class="navbar-brand brand" href="#">GreenChat</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0,0,256,256"
                width="40px"
                height="40px"
              >
                <g
                  fill="#ffffff"
                  fill-rule="nonzero"
                  stroke="none"
                  stroke-width="1"
                  stroke-linecap="butt"
                  stroke-linejoin="miter"
                  stroke-miterlimit="10"
                  stroke-dasharray=""
                  stroke-dashoffset="0"
                  font-family="none"
                  font-weight="none"
                  font-size="none"
                  text-anchor="none"
                  style="mix-blend-mode: normal"
                >
                  <g transform="scale(5.12,5.12)">
                    <path
                      d="M3,9c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h44c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587zM3,24c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h44c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587zM3,39c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h44c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587z"
                    ></path>
                  </g>
                </g>
              </svg>
            </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="/Html/geral.html"
                  >Geral</a
                >
              </li>
        
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                  >Meu Perfil</a
                >
              </li>
            </ul>
            <div
              class="modal fade"
              id="exampleModal"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header modal-navbar">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                      Meu Perfil
                    </h1>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="figure modal-body d-flex justify-content-center">
                    <div class="profile">
                      <div class="profile-header">
                        <form action="" enctype="multipart/form-data" class="select-image-form">
                          <label for="select-image" class="select-image-label">
                            <img
                              src="../Images/picture-main.jpg"
                              class="background-profile-picture"
                            />
                            <img
                              src="../Images/picture-main.jpg"
                              width="100px"
                              height="100px"
                              alt=""
                              class="profile-picture"
                            />
                          </label>
                        </form>
                      </div>
                      <div class="profile-body">
                        <h2><?php 
                        echo $_SESSION["nome"]." "; 
                        echo $_SESSION["sobrenome"]; 
                        ?></h2>
                        <label for="bio">
                          <h4>Biografia</h4>
                        </label>
                        <input type="text" class="bio" name="bio">
                        <p class="bio-content">
                          <?php
                          
                            echo $_SESSION["bio"];
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">

                    <form action="" class="modal-footer-form" method="post">
                      <button
                        type="submit"
                        class="btn close-button btn-secondary sair"
                        name="sair"
                        data-bs-dismiss="modal"
                      >
                        Sair
                      </button>
                      <?php
                        if(isset($_POST["sair"])){
                          session_destroy();
                          session_abort();
                          echo  "<script>window.location.replace('../index.php');</script>";
                          exit();
                        }
                      ?>
                      <form class="form-picture" method="post">
                        <input
                          type="file"
                          style="display: none"
                          name="selectImage"
                          id="select-image"
                          class="select-image"
                        />
                        <button type="submit" class="btn button save-button" id="save">
                          Salvar
                        </button>
                      </form>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                id="search-input"
                placeholder="Pesquisar"
                aria-label="Search"
              />
              <button class="button" type="button" id="search-button">
                Pesquisar
              </button>
              <div id="results"></div>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <main class="d-flex flex-column col-12">
      <div class="container">
        <h1 class="px-4 py-4">Chat Geral</h1>
        <div class="container post-container col-12">
          
        </div>

        <div class="container fixed-bottom col-12 h-10 text-area-container">
          <textarea
            type="text"
            class="text-input"
            placeholder="Digite Aqui..."
          ></textarea>
          <button type="button" class="text-button">Enviar</button>
        </div>
      </div>
    </main>
  </body>
</html>
