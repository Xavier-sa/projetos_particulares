export function carregarPerfil() {
    fetch("../../../data/perfil.json")  // Supondo que o arquivo JSON esteja em /data
      .then(response => response.json())
      .then(data => {
        let perfil = data.perfil;
  
        // Preenche o nome e descrição
        document.querySelector(".profile-img").src = perfil.imagem;  // Atualiza a imagem de perfil
        document.querySelector("h2").textContent = "Sobre Mim";  // Título da seção
        document.querySelector("p").textContent = perfil.descricao;  // Descrição sobre você
  
        
      })
      .catch(error => console.error("Erro ao carregar o perfil:", error));
  }
  