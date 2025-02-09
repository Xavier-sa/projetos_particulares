const formVenda = document.getElementById('formVenda');
        const tabelaProdutos = document.getElementById('tabelaProdutos').getElementsByTagName('tbody')[0];
        const totalVenda = document.getElementById('totalVenda');
        const dinheiroRecebido = document.getElementById('dinheiroRecebido');
        const troco = document.getElementById('troco');

        function adicionarProduto(id, nome, preco) {
            let quantidade = 1; // Definimos como 1 por padrão ao clicar
            let totalProduto = preco * quantidade;

            let linhaExistente = document.querySelector(`#produto-${id}`);
            if (linhaExistente) {
                let inputQuantidade = linhaExistente.querySelector('.quantidade');
                inputQuantidade.value = parseInt(inputQuantidade.value) + 1;
                atualizarTabela();
                return;
            }

            const row = tabelaProdutos.insertRow();
            row.id = `produto-${id}`;
            row.innerHTML = `
                <td>${nome}</td>
                <td><input type="number" class="quantidade" value="${quantidade}" min="0" onchange="atualizarTabela()"></td>
                <td>R$ ${preco.toFixed(2).replace('.', ',')}</td>
                <td>R$ ${totalProduto.toFixed(2).replace('.', ',')}</td>
            `;

            atualizarTabela();
        }

        function atualizarTabela() {
            let total = 0;
            const quantidades = document.querySelectorAll('.quantidade');
            quantidades.forEach((input) => {
                const quantidade = parseInt(input.value);
                const preco = parseFloat(input.closest('tr').querySelector('td:nth-child(3)').textContent.replace('R$ ', '').replace(',', '.'));

                if (quantidade > 0) {
                    const totalProduto = preco * quantidade;
                    input.closest('tr').querySelector('td:nth-child(4)').textContent = `R$ ${totalProduto.toFixed(2).replace('.', ',')}`;
                    total += totalProduto;
                }
            });

            totalVenda.textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;

            if (dinheiroRecebido.value) {
                const recebido = parseFloat(dinheiroRecebido.value);
                const trocoCalculado = recebido - total;
                troco.textContent = `Troco: R$ ${trocoCalculado.toFixed(2).replace('.', ',')}`;
            } else {
                troco.textContent = 'Troco: R$ 0,00';
            }
        }

        formVenda.addEventListener('input', atualizarTabela);