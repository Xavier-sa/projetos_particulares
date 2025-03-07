import { carregarFormacao } from './formacao.js';
import { carregarProjetos } from './projetos.js';
import { carregarPerfil } from './perfil.js';

document.addEventListener("DOMContentLoaded", function () {
    carregarFormacao();
    carregarProjetos();
    carregarPerfil();

});
