
document.addEventListener('DOMContentLoaded', function() {
    const senhaInput = document.querySelector('input[name="senha"]') || document.getElementById('senha');
    
    if (!senhaInput) return;
    
    // Criar container de validação se não existir
    let validacaoContainer = document.getElementById('validacao-senha');
    if (!validacaoContainer) {
        validacaoContainer = document.createElement('div');
        validacaoContainer.id = 'validacao-senha';
        validacaoContainer.style.marginTop = '10px';
        validacaoContainer.style.display = 'none';
        senhaInput.parentNode.appendChild(validacaoContainer);
    }
    
    senhaInput.addEventListener('input', function() {
        const senha = this.value;
        
        if (senha.length > 0) {
            validacaoContainer.style.display = 'block';
            validarSenhaTempoReal(senha);
        } else {
            validacaoContainer.style.display = 'none';
        }
    });
    
    function validarSenhaTempoReal(senha) {
        fetch('../backend/validacao.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'validar_senha=1&senha=' + encodeURIComponent(senha)
        })
        .then(response => response.json())
        .then(data => {
            atualizarValidacao(data);
        })
        .catch(error => {
            console.error('Erro na validação:', error);
        });
    }
    
    function atualizarValidacao(dados) {
        let html = '<div style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9;">';
        html += '<small style="font-weight: bold; color: #666;">Critérios da senha:</small>';
        html += '<ul style="margin: 5px 0; padding-left: 20px; list-style: none;">';
        
        for (const [chave, criterio] of Object.entries(dados.criterios)) {
            const icone = criterio.status === 'ok' ? '✅' : '❌';
            const cor = criterio.status === 'ok' ? '#28a745' : '#dc3545';
            
            html += `<li style="margin: 3px 0; color: ${cor}; font-size: 12px;">
                <span>${icone}</span> ${criterio.mensagem}
            </li>`;
        }
        
        html += '</ul>';
        
        if (dados.todos_validos) {
            html += '<div style="margin-top: 8px; padding: 5px; background-color: #d4edda; color: #155724; border-radius: 3px; text-align: center; font-size: 12px; font-weight: bold;">✅ Senha válida!</div>';
        }
        
        html += '</div>';
        
        validacaoContainer.innerHTML = html;
    }
});

