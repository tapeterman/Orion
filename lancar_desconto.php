<script type="text/javascript">
    function alteraDiv(){
        if(document.getElementById("VlrReembolso").value!="" && document.getElementById("QMeses").value!=""){
        var ValorTotal = parseFloat(document.getElementById("VlrReembolso").value)*parseFloat(document.getElementById("QMeses").value);
        document.getElementById("TotalReembolso").value = ValorTotal;
        } 
        else{
            document.getElementById("TotalReembolso").value = "";
        }
}
</script>
<script type="text/javascript">
    function limpaDiv(){
        document.getElementById("NumContrato").value="";
        document.getElementById("Cpf_Cnpj").value="";
        document.getElementById("MotivoOcorrencia").value="";
        document.getElementById("LoginOfensor").value="";
        document.getElementById("DataVenda").value="";
        document.getElementById("VlrReembolso").value="";
        document.getElementById("QMeses").value="";
        document.getElementById("TotalReembolso").value ="";
    }
</script>
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Justificar Desconto</h4>
                <small class="font-bold">Necessário preencher todos os campos do formulário</small>
            </div>
            <div class="modal-body">
                <form id="demo-form2" method="post" action="../lancar_desconto_banco.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="wrapper wrapper-content animated fadeInRight ">
                    <div class="row col-sm-offset-1 col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-user"></span> Dados do Cliente
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" for="NumContrato">Nº Contrato</label>
                                        <input type="text" id="NumContrato" name="NumContrato" class="form-control parametro variavel parametro2 variavel2" required="required" title="Número completo do contrato" data-mask="999/999999999" placeholder="000/000000000" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group col-xs-10">
                                        <label class="input-group-addon" for="Cpf_Cnpj">CPF/CNPJ</label>
                                        <input type="text" id="Cpf_Cnpj" name="Cpf_Cnpj" class="form-control parametro variavel parametro2 variavel2" required="required" placeholder="CPF ou CNPJ" maxlenth="18">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-list-alt"></span> Dados da Ocorrência
                            </div>
                            <div class="panel-body">
                                <div class="ibox-content col-sm-12">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" title="Motivo" for="MotivoOcorrencia">Motivo</label>
                                        <select id="MotivoOcorrencia" name="MotivoOcorrencia" required="required" class="select2_demo_3 form-control" onchange="getComboA(this)">
                                            <option></option>
                                            <option>CLIENTE DESCONHECE O PRODUTO CONTRATADO</option>
                                            <option>CORREÇÃO DE CONTRATO</option>
                                            <option>DOAÇÃO DE APARELHO</option>
                                            <option>MUDANÇA DE ENDEREÇO PARA LOCAL NÃO CABEADO</option>
                                            <option>NÃO INFORMADA REGRAS DO PRODUTO</option>
                                            <option>NÃO TEM INFORMAÇÃO</option>
                                            <option>OFERTA INEXISTENTE</option>
                                            <option>OFERTA NÃO CUMPRIDA</option>
                                            <option>OPÇÃO BOLETO AO INVÉS DE DCC</option>
                                            <option>PRODUTO DESCONTINUADO</option>
                                            <option>PRODUTO NÃO SOLICITADO PELO CLIENTE</option>
                                            <option>PRODUTO OFERTADO FORA DO PACOTE VIGENTE</option>
                                            <option>QUEDA DE SINAL</option>
                                            <option>RESGATE DE LIGAÇÃO FORA DO PRAZO</option>
                                            <option>VALOR / PRODUTO/SERVIÇO DIVERGENTE DO SOLICITADO</option>
                                            <option >VALOR DO PRODUTO / OFERTA DIFERENTE DO COMERCIALIZADO</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group col-sm-12">
                                        <label class="input-group-addon" for="LoginOfensor">LoginT</label>
                                        <input type="text" id="LoginOfensor" name="LoginOfensor" required="required" class="form-control parametro variavel" placeholder="Ofensor" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group col-sm-12">
                                        <label class="input-group-addon" title="Data da venda" for="DataVenda">Data Venda</label>
                                        <input type="text" id="DataVenda" name="DataVenda" class="form-control" required="required" data-mask="99/99/9999">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="col-xs-4 text-left" style="padding-top:10px;">
                                        <label>Existe Evidência:</label>
                                    </div>
                                    <div class="col-xs-3 text-left">
                                        <div class="radio">
                                            <label><input type="radio" name="opcoesGravacaoes" id="optNao" name="optNao" class="rbdVariavel variavel parametro2 variavel2" value="não" checked> NÃO </label>
                                        </div>
                                        <div class="radio">
                                            <label> <input type="radio" name="opcoesGravacaoes" id="optSim" name="optSim" class="rbdVariavel variavel parametro2 variavel2" value="sim"> SIM </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-ok"></span> Dados do Reembolso
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" title="Valor do Reembolso/mês" for="VlrReembolso">Valor Reembolso</label>
                                        <input type="text" id="VlrReembolso" name="VlrReembolso" required="required" class="form-control" placeholder="Valor/mês" onchange="alteraDiv()">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" title="Data da venda" for="QMeses">Qtd.(meses) Desconto</label>
                                        <input type="number" id="QMeses" name="QMeses" required="required" class="form-control" maxlength="12" min="1" max="12" onchange="alteraDiv()"> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" for="TotalReembolso">Valor Total</label>
                                        <input type="text" id="TotalReembolso" name="TotalReembolso" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group col-sm-10">
                                        <label class="input-group-addon" title="Canal de solução" for="CanalSolucao">Canal Solução</label>
                                        <select id="CanalSolucao" name="CanalSolucao" required="required" class="form-control variavel">
                                            <option>0800</option>
                                            <option>Pre-Anatel</option>
                                            <option>N2</option>
                                            <option>Staff</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="_Script/ControleFornecedor.js" type="text/javascript"></script>
                    </div>

                </div>                    
                <div class="modal-footer"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal" onclick="limpaDiv()">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </form>
    </div>
</div>