<?php
require "inc/cabecalho.php";
require "DataRequest.php";

$DataRequest = new DataRequest();
?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- MENU -->
    <?php require "inc/menu.php" ?>
    <!-- END MENU -->

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Dashboard <small>tudo que você precisa à um click.</small>
                    </h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="pull-right">
                            <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top" data-original-title="Change dashboard date range">
                                <i class="fa fa-calendar"></i>
                                <span>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?= $DataRequest->dadosClientes('c') ?? 0 ?>
                            </div>
                            <div class="desc">
                                Clientes
                            </div>
                        </div>
                        <a class="more" data-model="clientes" href="#">
                            Visualizar <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-group"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?= $DataRequest->dadosUsuarios('c') ?? 0 ?>
                            </div>
                            <div class="desc">
                                Usuários
                            </div>
                        </div>
                        <a class="more" data-model="usuarios" href="#">
                            Visualizar <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?= $DataRequest->dadosFornecedores('c') ?? 0 ?>
                            </div>
                            <div class="desc">
                                Fornecedores
                            </div>
                        </div>
                        <a class="more" data-model="fornecedores" href="#">
                            Visualizar <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS -->
            <div class="clearfix">
            </div>
            <!--Tabela-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                    <div class="portlet box grey">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-folder-open"></i>
                                <span>Tabela Simples</span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableData">
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php require "inc/rodape.php" ?>
<script>
    // função ajax para consultar dados
    async function ajax(action) {
        return $.ajax({
            url: 'ajax.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                action: action
            }),
            dataType: 'json'
        }).fail(function(jqXHR, status, error) {
            console.log('Erro:', status, error);
        });
    }

    // renderiza dados na "tabela simples" de acordo com modelo
    async function renderTableData(ajax, model) {
        if (ajax.success == true) {
            let html = ``;
            const data = ajax.data ?? null;

            if (data != null) {
                // monta cabeçalho da tabela
                const thead = {
                    "clientes": `<?php require "inc/table-helpers/thead-model-clientes.php" ?>`,
                    "usuarios": `<?php require "inc/table-helpers/thead-model-usuarios.php" ?>`,
                    "fornecedores": `<?php require "inc/table-helpers/thead-model-fornecedores.php" ?>`
                }
                html += thead[model];

                // corpo da tabela
                html += `<tbody>`;

                data.map((item, key) => {
                    key++;
                    const tbody = {
                        "clientes": `<?php require "inc/table-helpers/tbody-model-clientes.php" ?>`,
                        "usuarios": `<?php require "inc/table-helpers/tbody-model-usuarios.php" ?>`,
                        "fornecedores": `<?php require "inc/table-helpers/tbody-model-fornecedores.php" ?>`
                    }
                    html += tbody[model];
                })
                html += `</tbody>`;
            }

            $("#tableData").html(html);
        }
    }

    // Alterar cor da "tabela simples" e buscar os dados via Ajax
    async function handleEvent() {
        $('.dashboard-stat .more').on('click', async function(e) {
            const color = $(this).closest(".dashboard-stat").css("background-color"); // obtendo background-colocor da "dashboard-stat"
            const model = $(this).attr("data-model"); // obtem modelo de dados a ser consultado

            // nomeia modelos, para nome legível
            const named = {
                "clientes": "Clientes",
                "usuarios": "Usuários",
                "fornecedores": "Fornecedores"
            }

            // aplicando cor na "tabela simples"
            $(".portlet.box.grey > .portlet-title").css({
                "background-color": color
            })

            // alterando title da "tabela simples"
            $(".portlet-title > .caption > span").text("Dados de " + named[model]);

            // consultando ajax de acordo com modelo de dados configurado
            const json = await ajax(model);
            renderTableData(json, model);
        })
    }

    // carrega dados padrão
    async function loadingDefaultData() {
        $('.dashboard-stat .more')[0].click(); // dispara o click na caixa "Clientes"
    }

    handleEvent();
    loadingDefaultData();
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>