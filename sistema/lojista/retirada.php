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
                <div>DELIVERY</div>
            </a>
            <a href="#" class="item item-retirada active">
                <div>RETIRADA</div>
            </a>
            <a href="mesa.php" class="item item-mesa">
                <div>MESA</div>
            </a>
            <a href="#" class="item item-sair">
                <div>SAIR</div>
            </a>
        </div>
        <div class="content">
            <div class="banner retirada"></div>
            <div class="search">
                <input type="text" class="searchbar" placeholder="Procure o seu pedido por qualquer campo que desejar.">
                <!-- <input type="text" class="garcom" placeholder="Digite o nome do garçom">
                <input type="text" class="comanda" placeholder="Digite o numero da mesa ou comanda"> -->
            </div>
            <div class="control">
                <div class="cotrol-buttons">
                    <a href="retirada/retirada-todos.php" target="tabela" class="bt-link todos">Todos</a>
                    <a href="retirada/retirada-aberto.php" target="tabela" class="bt-link aberto">Em aberto</a>
                    <a href="retirada/retirada-produzindo.php" target="tabela" class="bt-link produzindo">Produzindo</a>
                    <a href="retirada/retirada-finalizados.php" target="tabela"  class="bt-link finalizados">Finalizados</a>
                    <a href="retirada/retirada-cancelados.php" target="tabela" class="bt-link cancelados">Cancelados</a>
                </div>
                <div class="total">Total de pedidos: 100</div>
            </div>
        
            <iframe src="retirada/retirada-todos.php" frameborder=0  name="tabela">
                <p>Your browser does not support iframes.</p>
            </iframe>
        </div>
    </div>
</body>
</html>