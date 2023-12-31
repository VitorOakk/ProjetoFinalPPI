<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GreenChat | Converse sobre o meio ambiente</title>
    <link rel="stylesheet" href="./Css/index-style.Css" />
    <link rel="stylesheet" href="./Css/bootstrap.min.css" />
    <script src="./Scripts/jquery-3.7.1.min.js"></script>
    <script src="./Scripts/index_script.js"></script>
    
    <!--Google Fonts-->
    <script src="./Scripts/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap"
      rel="stylesheet"
    />

  </head>
  <body>
    <header>
      <nav class="navbar d-flex  h-auto navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid d-flex col-10">
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
            <span class="text-align-center"
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
          <div class="collapse justify-content-between navbar-collapse" id="navbarSupportedContent">
            <a class="nav-a" aria-current="page" href="./Html/sobre.html"
                  >Sobre</a
                >
                
                <form class="d-flex form-login" method="POST" id="form-login">
                  <input class="form-control me-2 email" id="Email" type="email" placeholder="Email" aria-label="Email">
                  <input class="form-control me-2 senha" id="Senha" type="password" placeholder="Senha" aria-label="Password">
                  <input type="submit" value="Login" class="button">
                </form>
        
          </div>      
      </nav>
    </header>
    <main class="d-flex content col-12">
      <div class="justify-content-center align-items-center left-content">
        <div class="title">
          <h1>Converse sobre o meio ambiente com aqueles que se importam</h1>
        </div>
      </div>

      <div
        class="d-flex justify-content-center align-items-center right-content"
      >
        <div class="form col-9">
          <div class="form-content">
            <h1>REGISTRE-SE</h1>
            <form method = "POST" id="form-register">
              <div class="mb-3 d-flex">
                <div class="mb-3 col-6 px-1">
                  <label for="regNome" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="regNome" />
                </div>
                <div class="mb-3 col-6 px-1">
                  <label for="regSobreNome" class="form-label">Sobrenome</label>
                  <input type="text" class="form-control" id="regSobrenome" />
                </div>
              </div>
              <div class="mb-3 px-1">
                <label for="regEmail" class="form-label">Email </label>
                <input
                  type="email"
                  class="form-control"
                  id="regEmail"
                  aria-describedby="emailHelp"
                />
              </div>
              <div class="mb-3 px-1">
                <label for="regSenha" class="form-label"
                  >Senha</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="regSenha"
                />
              </div>
              <div class="mb-3 px-1">
                <input type="checkbox" name="check" id="flexCheckChecked" class="form-check-input" required>
                <label class="form-check-label" for="flexCheckChecked">Li e concordo com os <a href="">Termos de Uso</a></label>
              </div>
              <button
                type="submit"
                class="button register-button register px-1s"
              >
                Registrar
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
