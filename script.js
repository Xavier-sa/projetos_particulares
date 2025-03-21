document.addEventListener('DOMContentLoaded', function () {
    fetch('clan_data.json')
        .then(response => response.json())
        .then(data => {
            // Exibir líder
            document.getElementById('lider').innerHTML = `
                <img src="${data.lider.imagem}" alt="${data.lider.nome}">
                <p>${data.lider.nome}</p>
            `;

            // Exibir anciãos
            const anciaosContainer = document.getElementById('anciaos');
            data.anciaos.forEach(anciao => {
                anciaosContainer.innerHTML += `
                    <div class="membro">
                        <img src="${anciao.imagem}" alt="${anciao.nome}">
                        <p>${anciao.nome}</p>
                    </div>
                `;
            });

            // Exibir egide sombria
            document.getElementById('egide-sombria').innerHTML = `
                <img src="${data.egide_sombria.imagem}" alt="${data.egide_sombria.nome}">
                <p>${data.egide_sombria.nome}</p>
            `;

            // Exibir membros do clã
            const membrosContainer = document.getElementById('membros');
            data.membros.forEach(membro => {
                membrosContainer.innerHTML += `
                    <div class="membro">
                        <img src="${membro.imagem}" alt="${membro.nome}">
                        <p>${membro.nome}</p>
                    </div>
                `;
            });

            // Exibir novos membros
            const novosMembrosContainer = document.getElementById('novos-membros');
            data.novos_membros.forEach(membro => {
                novosMembrosContainer.innerHTML += `
                    <div class="membro">
                        <img src="${membro.imagem}" alt="${membro.nome}">
                        <p>${membro.nome}</p>
                    </div>
                `;
            });
        })
        .catch(error => console.error('Erro ao carregar o JSON:', error));
});