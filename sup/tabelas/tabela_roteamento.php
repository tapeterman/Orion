<?php
  session_start();
  require_once('../../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Almope = $_SESSION['Almope'];
  $Login = $_SESSION['Login'];
  $Nome = $_SESSION['Nome'];
  $permissao = $_SESSION['Permissao'];
?>
<div style="float:left;">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th><center>TURNO</center></th>
        <th><center>DATA</center></th>
        <th><center>QUANTIDADE</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        set_time_limit(0);
        $media=$_GET['media'];
        $total=0;
        $recebido[]=0;
        $recebido[0]=0;
        $recebido[1]=0;
        $x=0;
        if($_GET['data']=='Data')
          $data=date('d/m/Y');
        else
          $data=$_GET['data'];
          $sql = "SELECT IF(hour(STR_TO_DATE(`DH_ABERTURA`,'%d/%m/%Y %T'))<=14,'MANHA','TARDE') AS TURNO, 
                  DATE_FORMAT(STR_TO_DATE(`DH_ABERTURA`,'%d/%m/%Y'),'%d/%m/%Y') AS DATA, 
                  count(*) as QUANTIDADE 
                  FROM `tb_portal_online` 
                  WHERE `EMPRESA`= 'ALMAVIVA' 
                  and `DS_FORMA_CONTATO` not in ('BKO') 
                  and DATE_FORMAT(STR_TO_DATE(`DH_ABERTURA`,'%d/%m/%Y'),'%d/%m/%Y') = '".$data."'
                  group by TURNO, DATA ";
          $resultado = mysqlI_query($link, $sql);
          if(!$resultado)
            echo 'ERRO';
          else{
            $numero_registros = mysqlI_num_rows($resultado);
            while($registro = mysqlI_fetch_array($resultado)){  
      ?> 
              <tr>
                <td scope="row"><center><?php echo $registro['TURNO'];?></center></td>
                <td><center><?php echo $registro['DATA'];?></center></td>
                <td><center><?php echo $registro['QUANTIDADE'];?></center></td>
              </tr>
              <?php $recebido[$x]=$registro['QUANTIDADE'];
                $total=$total + $registro['QUANTIDADE'];
                $x=$x+1; 
              ?>
      <?php } }?> 
      <tr>
        <td colspan="2"><center><strong>TOTAL</strong></center></td>
        <td><center><strong><?php echo $total;?></strong><center></td>
      </tr>   
    </tbody>
  </table>
</div>
<div style="float:left;">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th><center>TURNO</center></th>
        <th><center>ATIVOS N2</center></th>
        <th><center>ATIVOS N2 08:12</center></th>
        <th><center>MÉDIA</center></th>
        <th><center>EXCENDENTE</center></th>
        <th><center>MÉDIA 08:12</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        set_time_limit(0);
        $totaln2=0;
        $total0812=0;
        $sql = "SELECT Turno, 
                SUM(CASE WHEN `Equipe`='NIVEL 2' THEN 1 ELSE 0 END) AS ATIVOS_N2, 
                SUM(CASE WHEN `Equipe`='NIVEL 2 08:12' THEN 1 ELSE 0 END) AS ATIVOS_N2_0812 
                FROM `tb_login_portal` 
                WHERE `Status_roteamento` = 'ATIVO' 
                GROUP BY TURNO ";
        $resultado = mysqlI_query($link, $sql);
        if(!$resultado)
          echo 'ERRO';
        else {
          $numero_registros = mysqlI_num_rows($resultado);
          while($registro = mysqlI_fetch_array($resultado)) {  
            $x=0;
      ?> 
            <tr>
              <td scope="row"><center><?php echo $registro['Turno'];?></center></td>
              <td><center><?php echo $registro['ATIVOS_N2'];?></center></td>
              <td><center><?php echo $registro['ATIVOS_N2_0812'];?></center></td>
              <td><center><?php echo $media;?></center></td>
              <td><center><?php echo ($recebido[$x]-$media*$registro['ATIVOS_N2']);?></center></td>
              <td><center><?php echo round(@(($recebido[$x]-$media*$registro['ATIVOS_N2'])/$registro['ATIVOS_N2_0812']),2) ;?></center></td>
              <?php $totaln2=$totaln2 + $registro['ATIVOS_N2'];$total0812=$total0812 + $registro['ATIVOS_N2_0812']; $x=$x+1;?>
            </tr>
      <?php } }?> 
            <tr>
              <td ><center><strong>TOTAL</strong></center></td>
              <td><center><strong><?php echo $totaln2;?></strong><center></td>
              <td><center><strong><?php echo $total0812;?></strong><center></td>
              <td><center><strong><?php echo $media;?></strong><center></td>
              <td><center><strong><?php echo ($recebido[0]+$recebido[1]-$totaln2*$media);?></strong><center></td>
              <td><center><strong><?php echo round(@((($recebido[0]+$recebido[1])-$totaln2*$media)/$total0812),2);?></strong><center></td>
               <?php $media0812=round(@((($recebido[0]+$recebido[1])-$totaln2*$media)/$total0812),0); ?>   
            </tr>
    </tbody>
  </table>
</div>
<P></P>
<P></P>
<P></P>
<P></P>
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th><center>LOGIN</center></th>
      <th><center>NOME</center></th>
      <th><center>SUPERVISOR</center></th>
      <th><center>STATUS</center></th>
      <th><center>RECEBIDO</center></th>
      <th><center>MÉDIA</center></th>
      <th><center>ENVIAR/RETIRAR</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      set_time_limit(0);
        $sql = "SELECT 
            tb_login_portal.Login as LOGIN,
            `tb_login_portal`.Nome AS NOME,
            `tb_login_portal`.Supervisor AS SUPERVISOR,
            `tb_login_portal`.Status AS STATUS,
            `tb_login_portal`.Equipe AS EQUIPE,
            ifnull(a.qtd, 0) as QTD
            from tb_login_portal
            left join (select usuario, count(usuario) as qtd from `tb_portal_online`
            where DATE_FORMAT(str_to_date(dh_abertura, '%d/%m/%Y'),'%d/%m/%Y') = '".$data."' 
            AND DS_FORMA_CONTATO NOT IN ('BKO')
            group by usuario) as a on a.usuario = tb_login_portal.login
            where `tb_login_portal`.Status_roteamento  = 'ATIVO'
            order by SUPERVISOR, NOME";
        $resultado = mysqlI_query($link, $sql);
        if(!$resultado)
          echo 'ERRO';
        else {
          $numero_registros = mysqlI_num_rows($resultado);
          while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
          <tr>
            <td scope="row"><center><?php echo $registro['LOGIN'];?></center></td>
            <td><center><?php echo $registro['NOME'];?></center></td>
            <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
            <td class=<?php if($registro['STATUS']<>'COMBO MULTI') echo'"text-navy"'; else echo '"text-danger"';?>><center><?php echo $registro['STATUS'];?></center></td>
            <td><center><?php echo $registro['QTD'];?></center></td>
            <td><center><?php if($registro['EQUIPE']=='NIVEL 2')echo $media; else echo $media0812;?></center></td>
            <td><center><?php if($registro['EQUIPE']=='NIVEL 2')echo  $media-$registro['QTD']; else ECHO  $media-$registro['QTD']-$media0812;?></center></td>
          </tr>
    <?php } }?> 
  </tbody>
</table>
                    