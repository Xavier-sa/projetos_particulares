export function carregarProjetos() {
    fetch("http://localhost/app/data/projetos.json")
        .then(response => response.json())
        .then(data => {
            let listaProjetos = document.getElementById("lista-projetos");

            data.projetos.forEach(projeto => {
                let li = document.createElement("li");
                let link = document.createElement("a");

                link.href = projeto.link;
                link.textContent = projeto.nome;
                link.target = "_blank";
                link.rel = "noopener noreferrer";

                li.appendChild(link);
                listaProjetos.appendChild(li);
            });

            let listaProjetosAlteracao = document.getElementById("lista-projetos-alteracao");
            data.projetos_em_alteracao.forEach(projeto => {
                let li = document.createElement("li");
                let link = document.createElement("a");

                link.href = projeto.link;
                link.textContent = projeto.nome;
                link.target = "_blank";
                link.rel = "noopener noreferrer";

                li.appendChild(link);
                listaProjetosAlteracao.appendChild(li);
            });
        })
        .catch(error => console.error("Erro ao carregar os projetos:", error));
}
