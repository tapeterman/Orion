<?php
    require('restrito.php');
    require_once('../db.class.php');
    set_time_limit(0);
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $Almope = $_SESSION['Almope'];
    $Login = $_SESSION['Login'];
    $Nome = $_SESSION['Nome'];
    $nome = $_SESSION['Primeiro_nome'];
    $p = $_SESSION['Permissao'];
    if($_SESSION['Permissao']==3)
        $permissao = 'Adminisrador';
    elseif ($_SESSION['Permissao']==2)
        $permissao = 'Supervisor';
    else
        $permissao = 'Operador';
        $data_atual_sql = date('Y-m-d');
        $data_atual=date('d/m/y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orion | Campanhas</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Relatorios Online</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Campanhas</a></li>
                    <li class="active"><strong>Campanhas Vigentes</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Campanhas Vigentes</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="wrapper wrapper-content animated fadeIn">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content border-sbottom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pdf-toolbar">
                                <div class="btn-group">
                                    <button id="prev" class="btn btn-white"><i class="fa fa-long-arrow-left"></i> 
                                        <span class="hidden-xs">Previous</span>
                                    </button>
                                    <button id="next" class="btn btn-white"><i class="fa fa-long-arrow-right"></i> 
                                        <span class="hidden-xs">Next</span>
                                    </button>
                                    <button id="zoomin" class="btn btn-white"><i class="fa fa-search-plus"></i> 
                                        <span class="hidden-xs">Zoom In</span>
                                    </button>
                                    <button id="zoomout" class="btn btn-white"><i class="fa fa-search-minus"></i> 
                                        <span class="hidden-xs">Zoom Out</span>
                                    </button>
                                    <button id="zoomfit" class="btn btn-white"> 100%
                                    </button>
                                    <span class="btn btn-white hidden-xs">Page: </span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="page_num">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-white" id="page_count">/ 22</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-md">
                                <canvas id="the-canvas" class="pdfcanvas border-left-right border-top-bottom b-r-md"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ;?>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/plugins/pdfjs/pdf.js"></script>
        <script id="script">
            var url = './../campanhas/Cuidar_é_bom_levar_é_melhor.pdf';
            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1.5,
                zoomRange = 0.25,
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');
                        function renderPage(num, scale) {
                pageRendering = true;
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport(scale);
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    var renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {
                        pageRendering = false;
                        if (pageNumPending !== null) {
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });
                document.getElementById('page_num').value = num;
            }
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } 
                else {
                    renderPage(num,scale);
                }
            }
            function onPrevPage() {
                if (pageNum <= 1) {
                    return;
                }
                pageNum--;
                var scale = pdfDoc.scale;
                queueRenderPage(pageNum, scale);
            }
            document.getElementById('prev').addEventListener('click', onPrevPage);
            function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                var scale = pdfDoc.scale;
                queueRenderPage(pageNum, scale);
            }
            document.getElementById('next').addEventListener('click', onNextPage);
            function onZoomIn() {
                if (scale >= pdfDoc.scale) {
                    return;
                }
                scale += zoomRange;
                var num = pageNum;
                renderPage(num, scale)
            }
            document.getElementById('zoomin').addEventListener('click', onZoomIn);
            function onZoomOut() {
                if (scale >= pdfDoc.scale) {
                    return;
                }
                scale -= zoomRange;
                var num = pageNum;
                queueRenderPage(num, scale);
            }
            document.getElementById('zoomout').addEventListener('click', onZoomOut);
            function onZoomFit() {
                if (scale >= pdfDoc.scale) {
                    return;
                }
                scale = 1;
                var num = pageNum;
                queueRenderPage(num, scale);
            }
            document.getElementById('zoomfit').addEventListener('click', onZoomFit);
            PDFJS.getDocument(url).then(function (pdfDoc_) {
                pdfDoc = pdfDoc_;
                var documentPagesNumber = pdfDoc.numPages;
                document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;
                $('#page_num').on('change', function() {
                    var pageNumber = Number($(this).val());
                    if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                        queueRenderPage(pageNumber, scale);
                    }
                });
                renderPage(pageNum, scale);
            });
        </script>
    </body>
</html>
