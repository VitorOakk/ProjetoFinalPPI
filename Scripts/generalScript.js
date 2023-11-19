document.addEventListener("DOMContentLoaded", main);
const websocket = new WebSocket("ws://localhost:8080");
function main() {
  carregarPublicacoes();

  //Evento para criar uma nova publicação
  let textButton = document.querySelector(".text-button");
  textButton.addEventListener("click", createNewPost);

  //Manter a scrollbar sempre no final para o elemento mais atual ficar visível
  let postContainer = document.querySelector(".post-container");

  // Alterar foto de perfil no momento em que o usuário seleciona uma imagem
  let imgInput = document.querySelector('input[name="selectImage"]');
  imgInput.addEventListener("change", previewProfilePicture);

  // Salvar a imagem de perfil e alterar nas postagens
  // let formPicture = document.querySelector(".form-picture");
  //formPicture.addEventListener("submit", saveProfilePicture);

  //pesquisa
  let searchButton = document.getElementById("search-button");
  searchButton.addEventListener("click", searchPosts);
}
function carregarPublicacoes() {
  $.ajax({
    url: "../Scripts/carregarPublicacoes.php",
    type: "POST",
    data: {},
  }).done(function (response) {
    // Tente fazer o parsing da resposta como JSON
    let jData = JSON.parse(response);

    // Certifique-se de que response é um array
    if (Array.isArray(jData)) {
      for (response in jData) {
        addPostToUI(
          jData[response].conteudo,
          jData[response].nome,
          jData[response].sobrenome,
          jData[response].biografia
        );
      }
    } else {
      console.error("A resposta não é um array válido:", response);
    }
  });
}

function createNewPost() {
  const profileImageURL = localStorage.getItem("profileImageURL");
  const textAreaValue = getTextAreaValue();
  const postContainer = document.querySelector(".post-container");

  if (textAreaValue !== "") {
    const message = {
      type: "post",
      content: textAreaValue,
      profileImageURL: profileImageURL,
      nome: nomeUsuario,
      sobrenome: sobrenomeUsuario,
      id: idUsuario,
      bio: bioUsuario,
    };

    //Enviar a mensagem ao banco de dados
    $.ajax({
      url: "../Scripts/salvarPost.php",
      type: "POST",
      data: {
        content: message.content,
        usuarioID: message.id,
      },
    }).done(function (data) {
      console.log("Publicação inserida no BD");
    });
    // Enviar a mensagem para o servidor WebSocket
    websocket.send(JSON.stringify(message));
    console.log(
      "Dados enviados ao servidor: " + message.content,
      message.nome,
      message.sobrenome,
      message.id,
      message.bio
    );
    //addPostToUI(message.content, message.nome, message.sobrenome);
  }

  cleanTextArea();
  scrollToBottom(postContainer);
  saveProfilePicture;
}
function getTextAreaValue() {
  let textArea = document.querySelector(".text-input");
  let textAreaValue = textArea.value.trim();
  return textAreaValue;
}
function cleanTextArea() {
  let textArea = document.querySelector(".text-input");
  textArea.value = "";
}
function scrollToBottom(container) {
  container.scrollTo(0, container.scrollHeight);
}

function previewProfilePicture() {
  let imgInput = document.querySelector('input[name="selectImage"]');
  let file = imgInput.files[0];
  let profileImage = document.querySelector(".profile-picture");
  let backgroundProfilePicture = document.querySelector(
    ".background-profile-picture"
  );

  if (file) {
    var reader = new FileReader();

    reader.onload = function (e) {
      const newProfileImageURL = e.target.result;
      profileImage.src = newProfileImageURL;
      backgroundProfilePicture.src = newProfileImageURL;
    };

    reader.readAsDataURL(file);
  }
}
function saveProfilePicture(e) {
  e.preventDefault();
  let imgInput = document.querySelector('input[name="selectImage"]');
  let file = imgInput.files[0];

  if (file) {
    var reader = new FileReader();

    reader.onload = function (e) {
      const newProfileImageURL = e.target.result;
      localStorage.setItem("profileImageURL", newProfileImageURL);

      // Atualize a imagem de perfil em todas as postagens existentes
      let postPictures = document.querySelectorAll(".post-picture");
      postPictures.forEach((postPicture) => {
        postPicture.src = newProfileImageURL;
      });
    };

    reader.readAsDataURL(file);

    imgInput.value = "";
  }
}

window.onload = function () {
  const storedImageUrl = localStorage.getItem("profileImageURL");
  let profilePicture = document.querySelector(".profile-picture");
  let backgroundProfilePicture = document.querySelector(
    ".background-profile-picture"
  );
  let postPicture = document.querySelector(".post-picture");
  if (storedImageUrl) {
    profilePicture.src = storedImageUrl;
    backgroundProfilePicture.src = storedImageUrl;
    postPicture.src = storedImageUrl;
  }
};
function searchPosts() {
  let searchTerm = document
    .getElementById("search-input")
    .value.trim()
    .toLowerCase();
  let postContainers = document.querySelectorAll(".template-post");

  // Variável para rastrear se alguma postagem corresponde à pesquisa
  let found = false;

  // Cria uma expressão regular a partir do termo de pesquisa
  let regex = new RegExp("\\b" + searchTerm + "\\b", "i");

  // Percorre todas as postagens
  postContainers.forEach((postContainer) => {
    let postContent = postContainer
      .querySelector(".post-content")
      .textContent.toLowerCase();

    // Verifica se a palavra de pesquisa existe no conteúdo da postagem
    if (regex.test(postContent)) {
      postContainer.style.display = "block"; // Exibe a postagem
      found = true;
    } else {
      postContainer.style.display = "none"; // Oculta a postagem que não corresponde
    }
  });

  // Verifica se não há postagens correspondentes e exibe uma mensagem
  let noResults = document.getElementById("no-results-message");
  let resultsContainer = document.getElementById("results");

  if (!found) {
    // Nenhuma postagem corresponde à pesquisa
    noResults.style.display = "block";
    resultsContainer.innerHTML = "";
  } else {
    // Pelo menos uma postagem corresponde à pesquisa
    noResults.style.display = "none";
  }
}

websocket.onmessage = function (event) {
  const data = JSON.parse(event.data);
  console.log("Dados recebidos do servidor:", data);

  if (data.type === "post") {
    addPostToUI(data.content, data.nome, data.sobrenome, data.bio);
  }
};
function addPostToUI(content, nome, sobrenome, bio) {
  const postContainer = document.querySelector(".post-container");
  let post = document.createElement("div");
  post.classList.add("template-post");
  post.innerHTML = `
            
      <div class="post-header d-flex align-items-center">
          <img src="" class="post-picture" />
          <h5>${nome} ${sobrenome}</h5>
      </div>
      <div class="post-body">
          <p>${content}</p>
      </div>
      `;

  postContainer.appendChild(post);
  scrollToBottom(postContainer);
}
