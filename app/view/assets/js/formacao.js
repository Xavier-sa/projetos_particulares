export function carregarFormacao() {
    fetch("http://localhost/app/data/formacao.json")
        .then(response => response.json())
        .then(data => {
            let listaFormacao = document.getElementById("lista-formacao");
            data.formacao.forEach(curso => {
                let li = document.createElement("li");

                if (curso.link) {
                    let link = document.createElement("a");
                    link.href = curso.link;
                    link.textContent = `${curso.curso} - ${curso.instituicao}`;
                    link.target = "_blank";
                    link.rel = "noopener noreferrer";
                    li.appendChild(link);
                } else {
                    li.textContent = `${curso.curso} - ${curso.instituicao}`;
                }

                listaFormacao.appendChild(li);
            });
        })
        .catch(error => console.error("Erro ao carregar a formação acadêmica:", error));
}
