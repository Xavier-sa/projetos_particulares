document.getElementById('form-criar').addEventListener('submit', function(event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const raça = document.getElementById('raça').value;
    const força = document.getElementById('força').value;
    const velocidade = document.getElementById('velocidade').value;
    const energia = document.getElementById('energia').value;

    fetch('http://localhost:5000/criar_personagem', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            nome: nome,
            raça: raça,
            força: força,
            velocidade: velocidade,
            energia: energia
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        carregarPersonagens();
    });
});

function carregarPersonagens() {
    fetch('http://localhost:5000/personagens')
    .then(response => response.json())
    .then(personagens => {
        const divPersonagens = document.getElementById('personagens');
        divPersonagens.innerHTML = '';
        personagens.forEach(p => {
            divPersonagens.innerHTML += `<p>${p.nome} - ${p.raça} (Força: ${p.força}, Velocidade: ${p.velocidade}, Energia: ${p.energia})</p>`;
        });
    });
}

carregarPersonagens();
