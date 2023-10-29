document.addEventListener("DOMContentLoaded", main);

function main() {
  //Evento para criar uma nova publicação
  let textButton = document.querySelector(".text-button");
  textButton.addEventListener("click", createNewPost);

  //Manter a scrollbar sempre no final para o elemento mais atual ficar visível
  let postContainer = document.querySelector(".post-container");

  // Alterar foto de perfil no momento em que o usuário seleciona uma imagem
  let imgInput = document.querySelector('input[name="selectImage"]');
  imgInput.addEventListener("change", previewProfilePicture);

  // Salvar a imagem de perfil e alterar nas postagens
  let formPicture = document.querySelector(".form-picture");
  formPicture.addEventListener("submit", saveProfilePicture);

  //pesquisa
  let searchButton = document.getElementById("search-button");
  searchButton.addEventListener("click", searchPosts);
}

function createNewPost() {
  const profileImageURL = localStorage.getItem("profileImageURL");
  let postContainer = document.querySelector(".post-container");
  let post = document.createElement("div");
  post.classList.add("template-post");
  post.innerHTML = `<div class="post-header d-flex align-items-center">
  <img src="${profileImageURL}" class="post-picture" />
  <h5>Nome Sobrenome</h5>
</div>
<div class="post-body">
  <p>
    ${getTextAreaValue()}
  </p>
</div>
</div>`;
  if (getTextAreaValue() !== "") {
    postContainer.appendChild(post);
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
