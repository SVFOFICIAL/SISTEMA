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
            <a href="#" class="item item-delivery active">
                <div class="notification">5</div>
                <div class="subtitle-menu">DELIVERY</div>
            </a>
            <a href="retirada.php" class="item item-retirada">
                <div class="notification">5</div>
                <div class="subtitle-menu">RETIRADA</div>
            </a>
            <a href="mesa.php" class="item item-mesa">
                <div class="notification">5</div>
                <div class="subtitle-menu">MESA</div>
            </a>
            <a href="#" class="item item-sair">
                <div class="subtitle-menu">SAIR</div>
            </a>
        </div>
        <div class="content">
            <div class="banner"></div>
            <div class="search">
                <input type="text" class="searchbar" placeholder="Procure o seu pedido por qualquer campo que desejar.">
                <!-- <input type="text" class="garcom" placeholder="Digite o nome do garçom">
                <input type="text" class="comanda" placeholder="Digite o numero da mesa ou comanda"> -->
            </div>
            <div class="control">
                <div class="cotrol-buttons">
                    <a href="delivery/delivery-todos.php" target="tabela" class="bt-link todos">Todos</a>
                    <a href="delivery/delivery-aberto.php" target="tabela" class="bt-link aberto">Em aberto</a>
                    <a href="delivery/delivery-produzindo.php" target="tabela" class="bt-link produzindo">Produzindo</a>
                    <a href="delivery/delivery-entrega.php" style="color:white;" target="tabela" class="bt-link entrega">Saiu para entrega</a>
                    <a href="delivery/delivery-finalizados.php" target="tabela"  class="bt-link finalizados">Finalizados</a>
                    <a href="delivery/delivery-cancelados.php" style="color:white;" target="tabela" class="bt-link cancelados">Cancelados</a>
                </div>
                <div class="total">Total de pedidos: 100</div>
            </div>
        
            <iframe src="delivery/delivery-todos.php" frameborder=0  name="tabela">
                <p>Your browser does not support iframes.</p>
            </iframe>
        </div>
    </div>
</body>
</html>