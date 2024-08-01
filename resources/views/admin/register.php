<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="<?= ASSETS ?>/img/logo.png" alt="">
                            <span class="d-none d-lg-block">VidaraWebsites</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Criar uma Conta</h5>
                                <p class="text-center small">Insira seus dados pessoais para criar uma conta</p>
                            </div>

                            <form id="form-register" method="post" action="<?= URL ?>/register">
                                <div class="col-12">
                                    <label for="yourName" class="form-label">Seu Nome</label>
                                    <input type="text" name="name" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">Por favor, insira seu nome!</div>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Seu Email</label>
                                    <input type="email" name="email" class="form-control" id="yourEmail" required>
                                    <div class="invalid-feedback">Por favor, insira um endereço de e-mail válido!</div>
                                </div>

                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nome de Usuário</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="username" class="form-control" id="yourUsername"
                                            required>
                                        <div class="invalid-feedback">Por favor, escolha um nome de usuário.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword"
                                        required>
                                    <div class="invalid-feedback">Por favor, insira sua senha!</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value=""
                                            id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Eu concordo e aceito os <a
                                                href="#">termos e condições</a></label>
                                        <div class="invalid-feedback">Você deve concordar antes de enviar.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Criar Conta</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Já tem uma conta? <a href="pages-login.html">Faça login</a>
                                    </p>
                                </div>
                            </form>


                        </div>
                    </div>



                </div>
            </div>
        </div>

    </section>

</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>