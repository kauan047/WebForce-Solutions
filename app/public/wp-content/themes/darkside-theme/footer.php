<?php
/**
 * Footer WebForce Solutions - Alinhamento horizontal corrigido
 */
?>
<style>
    /* --- [ESTILOS PRINCIPAIS] --- */
    .site-footer {
        background-color: #0a0a0a;
        color: #fff;
        padding: 40px 0;
        font-family: 'Arial', sans-serif;
        border-top: 2px solid #00ffcc;
    }
    
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 4 colunas de largura igual */
        gap: 30px;
        padding: 0 20px;
        align-items: start; /* Alinha todas as colunas no topo */
    }
    
    /* --- [CORREÇÃO PARA ALINHAMENTO HORIZONTAL] --- */
    .footer-section {
        margin-bottom: 0; /* Remove margem inferior */
    }
    
    .footer-section h3 {
        color: #00ffcc;
        margin-bottom: 15px;
        font-size: 18px;
    }
    
    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-section ul li {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        line-height: 1.5;
        margin-bottom: 8px;
    }
    
    /* Marcador para contato */
    .footer-section.contato ul li::before {
        content: "•";
        color: #00ffcc;
        margin-right: 10px;
    }
    
    /* --- [RESPONSIVIDADE] --- */
    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: repeat(2, 1fr); /* 2 colunas em telas menores */
        }
    }
    
    @media (max-width: 480px) {
        .footer-container {
            grid-template-columns: 1fr; /* 1 coluna em mobile */
        }
    }
</style>

<footer id="colophon" class="site-footer">
    <div class="footer-container">
        <!-- Seção Sobre -->
        <div class="footer-section">
            <h3>WebForce Solutions</h3>
            <p>Tecnologia e inovação para o seu negócio.</p>
        </div>
        
        <!-- Seção Links Rápidos -->
        <div class="footer-section">
            <h3>Links Rápidos</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/servicos')); ?>">Serviços</a></li>
                <li><a href="<?php echo esc_url(home_url('/contato')); ?>">Contato</a></li>
            </ul>
        </div>
        
        <!-- Seção Contato -->
        <div class="footer-section contato">
            <h3>Contato</h3>
            <ul>
                <li>contato@webforcesolutions.com.br</li>
                <li>(11) 99999-9999</li>
            </ul>
        </div>
        
        <!-- Seção Redes Sociais -->
        <div class="footer-section">
            <h3>Redes Sociais</h3>
            <ul>
                <li><a href="#" target="_blank">LinkedIn</a></li>
                <li><a href="#" target="_blank">Instagram</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Copyright (centralizado) -->
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> WebForce Solutions. Todos os direitos reservados.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>