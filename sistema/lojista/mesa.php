<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Lojista</title><link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="menu">
            <a href="index.php" class="item item-delivery">
                <div class="notification">5</div>
                <div class="subtitle-menu">DELIVERY</div>
            </a>
            <a href="retirada.php" class="item item-retirada">
                <div class="notification">5</div>
                <div class="subtitle-menu">RETIRADA</div>
            </a>
            <a href="#" class="item item-mesa active">
                <div class="notification">5</div>
                <div class="subtitle-menu">MESA</div>
            </a>
            <a href="#" class="item item-sair">
                <div class="subtitle-menu">SAIR</div>
            </a>
        </div>
        <div class="content">
            <div class="banner mesa"></div>
            <div class="search">
                <input type="text" class="searchbar" placeholder="Procure o seu pedido por qualquer campo que desejar.">
                <input type="text" class="garcom" placeholder="Digite o nome do garçom">
                <input type="text" class="comanda" placeholder="Digite o numero da mesa ou comanda">
            </div>
            <div class="control">
                <div class="cotrol-buttons">
                    <a href="mesa/mesa-todos.php" target="tabela" class="bt-link todos">Todos</a>
                    <a href="mesa/mesa-aberto.php" target="tabela" class="bt-link aberto">Em aberto</a>
                    <a href="mesa/mesa-produzindo.php" target="tabela" class="bt-link produzindo">Produzindo</a>
                    <a href="mesa/mesa-namesa.php" style="color:white;" target="tabela" class="bt-link entrega">Na mesa</a>
                    <a href="mesa/mesa-finalizados.php" target="tabela"  class="bt-link finalizados">Finalizados</a>
                    <a href="mesa/mesa-cancelados.php" style="color:white;" target="tabela" class="bt-link cancelados">Cancelados</a>
                </div>
                <div class="total">Total de pedidos: 100</div>
            </div>
        
            <iframe src="mesa/mesa-todos.php" frameborder=0  name="tabela">
                <p>Your browser does not support iframes.</p>
            </iframe>
        </div>
    </div>
</body>
</html>