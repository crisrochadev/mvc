$(document).ready(function () {
  // Função para alternar a visibilidade da senha
  function togglePassword() {
    var passwordInput = $("#password");
    var button = $("#toggle-pass");
    if (passwordInput.attr("type") === "password") {
      passwordInput.attr("type", "text");
      button.text("Ocultar");
    } else {
      passwordInput.attr("type", "password");
      button.text("Mostrar");
    }
  }

  // Evento de submissão do formulário de login
  $("#form-login").on("submit", async (e) => {
    e.preventDefault();

    let data = {
      username: $("#username").val(),
      password: $("#password").val(),
      remember: $("#rememberMe").is(":checked"),
    };

    try {
      const res = await $.ajax({
        url: $(e.target).attr("action"), // Altere para a URL correta
        type: "POST",
        data: data,
        dataType: "json",
      });
      if (res.success) {
        window.location.href = res.url +"/dashboard"; // Redirecionar após sucesso
      } else {
        Swal.fire({
          icon: "error",
          title: "Erro",
          text: res.message,
        });
      }
    } catch (error) {
      console.error("Erro ao fazer login", error);
      let errorMessage = error.responseJSON.message ?? "Erro ao fazer login";
      Swal.fire({
        icon: "error",
        title: "Erro",
        text: errorMessage,
      });
    }
  });

  // Evento de submissão do formulário de registro
  $("#form-register").on("submit", async (e) => {
    e.preventDefault();

    let data = {
      name: $("input[name='name']").val(),
      email: $("input[name='email']").val(),
      username: $("input[name='username']").val(),
      password: $("input[name='password']").val(),
      terms: $("input[name='terms']").is(":checked"),
    };

    try {
      const res = await $.ajax({
        url: $(e.target).attr("action"), // Altere para a URL correta
        type: "POST",
        data: data,
        dataType: "json",
      });
      if (res.success) {
        Swal.fire({
          icon: "success",
          title: "Sucesso",
          text: "Registro bem-sucedido. Você pode agora fazer login.",
        }).then(() => {
          window.location.href = "/login"; // Redirecionar após sucesso
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Erro",
          text: res.message,
        });
      }
    } catch (error) {
      console.error("Erro ao registrar", error);
      let errorMessage = error.responseJSON.message ?? "Erro ao registrar";
      Swal.fire({
        icon: "error",
        title: "Erro",
        text: errorMessage,
      });
    }
  });
});
