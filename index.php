<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Números</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <h1 class="mb-3 text-dark">Conversor de Números</h1>

        <div class="row mb-4" id="DivtipoConversao">

            <section class="col col-5">
                <label class="label text-dark" for="tipoConversao">Tipo de Conversão</label>
                <select id="tipoConversao" class="form-control">
                    <option value="dr">Decimal -> Romano</option>
                    <option value="rd">Romano -> Decimal</option>
                </select>
            </section>
        </div>

        <div class="mb-5" id="conversor">
            <section class="col col-5 mb-4">
                <label class="text-dark" id="tituloNumeroEntrada" for="numeroEntrada">Numero em Real</label>
                <input type="text" id="numeroEntrada" class="form-control" placeholder="Digite um número Real">
            </section>

            <section class="col col-5">
                <button class="btn btn-danger" id="btnConverter" type="button">Converter</button>
            </section>

        </div>

        <div class="row" id="footer">
            <span class="text-dark" id="resultado"></span>
        </div>

    </div>
</body>

<script src="js/index.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath   