<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca CRUD</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>📚 Sistema Biblioteca CRUD</h1>
        <p>Gerenciamento completo de biblioteca com PHP e MySQL</p>
    </div>
    
    <div class="nav-menu">
        <h2>Menu Principal</h2>
        <div class="nav-grid">
            <a href="views/livros.php" class="nav-item">
                <span>📖</span>
                <span>Gerenciar Livros</span>
            </a>
            <a href="views/autores.php" class="nav-item">
                <span>✍️</span>
                <span>Gerenciar Autores</span>
            </a>
            <a href="views/leitores.php" class="nav-item">
                <span>👥</span>
                <span>Gerenciar Leitores</span>
            </a>
            <a href="views/emprestimos.php" class="nav-item">
                <span>🔄</span>
                <span>Gerenciar Empréstimos</span>
            </a>
        </div>
    </div>

    <div class="content">
        <h2>Bem-vindo ao Sistema de Biblioteca!</h2>
        <p>Este sistema permite gerenciar todos os aspectos de uma biblioteca, incluindo:</p>
        
        <div style="margin-top: 20px;">
            <h3>📋 Funcionalidades Disponíveis:</h3>
            <ul style="list-style-type: none; padding-left: 20px;">
                <li>✅ Cadastro e gestão de livros</li>
                <li>✅ Controle de autores</li>
                <li>✅ Registro de leitores</li>
                <li>✅ Sistema de empréstimos e devoluções</li>
                <li>✅ Filtros e relatórios</li>
                <li>✅ Validações de negócio</li>
            </ul>
        </div>

        <div style="margin-top: 30px; background: #f8f9fa; padding: 20px; border-radius: 8px;">
            <h3>⚙️ Como usar:</h3>
            <ol style="padding-left: 20px;">
                <li>Configure o banco de dados executando o arquivo <strong>database.sql</strong> no phpMyAdmin</li>
                <li>Verifique as configurações de conexão em <strong>conexao.php</strong></li>
                <li>Navegue pelos menus para gerenciar cada entidade</li>
                <li>Use os filtros para encontrar informações específicas</li>
            </ol>
        </div>
    </div>
</body>
</html>
