// habilidades, você pode montar uma lista
let habilidadesLista = document.createElement("ul");
perfil.habilidades.forEach(habilidade => {
  let li = document.createElement("li");
  li.textContent = habilidade;
  habilidadesLista.appendChild(li);
});

// Adiciona as habilidades ao DOM (aqui você pode escolher onde exibir)
document.querySelector(".container").appendChild(habilidadesLista);