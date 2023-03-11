<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <body>
        <section class="vh-100 gradient-custom">
          <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">
                      <h2 class="fw-bold mb-2 text-uppercase">ADP_GundjaTech</h2>
                      <p class="text-white-50 mb-5">Ensira Suas Credenciais</p>
                      <form method="post" action="php/logar.php" enctype="multipart/form-data">
                          <div class="form-outline form-white mb-4">
                              <input type="text" id="typeEmailX" class="form-control form-control-lg" name="matricula" />
                              <label class="form-label" for="typeEmailX">matricula</label>
                          </div>

                          <div class="form-outline form-white mb-4">
                              <input type="password" id="typePasswordX" class="form-control form-control-lg" name="senha"/>
                              <label class="form-label" for="typePasswordX">Senha</label>
                          </div>

                          <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"> Esqueceu sua SenhaA ?</a></p>

                          <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
  </body>
</html>