// Função para capturar clique nos links de portfólio
const portfolioLinks = document.querySelectorAll('a');

portfolioLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        // Alerta simples quando clicar em qualquer link de portfólio
        alert('Você está saindo para um projeto externo!');
    });
});
