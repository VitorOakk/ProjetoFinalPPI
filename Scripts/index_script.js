$(document).ready(function () {
  $(".form-login").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "./Scripts/login.php",
      type: "POST",
      data: {
        email: $("#Email").val(),
        senha: $("#Senha").val(),
      },
    })
      .done(function (data) {
        console.log(data);
        let jData = JSON.parse(data);
        if (jData.success) {
          if (jData.tipo === "USR") {
            window.location.href = "./Html/geral.php";
          } else if (jData.tipo === "ADM") {
            window.location.href = "./Html/administrador.php";
          } else {
            alert("Error!!");
          }
        } else {
          alert("Error!!");
        }
      })
      .fail(function (data) {
        console.log(data);
      });
  });

  $("#form-register").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "./Scripts/register.php",
      type: "POST",
      data: {
        nome: $("#regNome").val(),
        sobrenome: $("#regSobrenome").val(),
        email: $("#regEmail").val(),
        senha: $("#regSenha").val(),
      },
    }).done(function (data) {
      console.log(data);
      let jData = JSON.parse(data);

      if (jData.success) {
        alert(jData.message);
      }
    });
  });
});
