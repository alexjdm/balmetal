<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'lib/fpdf/fpdf.php';
//require_once 'lib/fpdf/pdf.php';
require_once 'models/AutosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/SellosModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/CertificadosModel.php';

class SellosController {

    public $modelA;
    public $modelC;
    public $modelCer;
    public $modelS;
    public $modelP;

    public function __construct()
    {
        $this-> modelA = new AutosModel();
        $this-> modelC = new ClientesModel();
        $this-> modelS = new SellosModel();
        $this-> modelP = new ProductosModel();
        $this-> modelCer = new CertificadosModel();
    }

    public function sellos(){
        $sellos = $this->modelS->getSellosList();
        $articulos = $this->modelP->getArticulosList();
        $familias = $this->modelP->getFamiliasList();
        $autos = $this->modelA->getAutosList();
        require_once('views/sellos/sellos.php');
    }

    public function selloView() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = $this->modelS->getSello($idSello);
        $articulo = $this->modelP->getArticulo($sello['ID_ARTICULO']);
        $codigoBarra = str_replace(".gif", "_110x20.gif",$articulo['CODIGO_BARRA']);
        require_once('views/sellos/selloView.php');
    }

    public function selloEdit() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = $this->modelS->getSello($idSello);
        $articulos = $this->modelP->getArticulosList();
        require_once('views/sellos/selloEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = isset($_GET['sello']) ? $_GET['sello'] : null;
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $otro = isset($_GET['otro']) ? $_GET['otro'] : null;

        return $this->modelP->editSello($idSello, $sello, $idArticulo, $otro);
    }

    public function deleteSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        return $this->modelP->deleteSello($idSello);
    }

    public function imprimirSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        return $this->modelS->imprimirSello($idSello);
    }

    public function newSello() {
        $familias = $this->modelP->getFamiliasList();
        $articulos = $this->modelP->getArticulosList();
        $autos = $this->modelA->getAutosList();

        $articulosJson = json_encode($articulos);

        require_once('views/sellos/newSello.php');
    }

    public function createSello() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        /*$idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $chasis = isset($_GET['chasis']) ? $_GET['chasis'] : null;
        $patente = isset($_GET['patente']) ? $_GET['patente'] : null;*/
        $cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : null;

        //return $this->modelP->articuloAsignarSello($idArticulo, $idAuto, $chasis, $patente, $cantidad);
        return $this->modelP->articuloAsignarSello($idArticulo, $cantidad);
    }

    public function newCertificado() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = $this->modelS->getSello($idSello);
        $articulo = $this->modelP->getArticulo($sello['ID_ARTICULO']);
        $familia = $this->modelP->getFamilia($articulo['ID_FAMILIA']);
        $autos = $this->modelA->getAutosList();
        $clientes = $this->modelC->getClientesList();

        require_once('views/sellos/newCertificado.php');
    }

    public function createCertificado() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;
        /*$glosa = isset($_GET['glosa']) ? $_GET['glosa'] : null;*/
        $obs = isset($_GET['obs']) ? $_GET['obs'] : null;
        /*$folio = isset($_GET['folio']) ? $_GET['folio'] : null;*/
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $chasis = isset($_GET['chasis']) ? $_GET['chasis'] : null;
        $patente = isset($_GET['patente']) ? $_GET['patente'] : null;

        $sello = $this->modelS->getSello($idSello);
        $articulo = $this->modelP->getArticulo($sello['ID_ARTICULO']);
        $familia = $this->modelP->getFamilia($articulo['ID_FAMILIA']);
        $auto = $this->modelA->getAuto($idAuto);

        $folio = $this->modelCer->getLastFolio();
        if($folio[0] == 0)
            $folio = 35000;
        $folio = $folio[0] + 1;
        //$aleatorio = rand(1111111111111111111, 111111111111111111111);
        //Fields Name position
        $Y_Fields_Name_position = 40;


        //******************************** PRIMER CERTIFICADO ******************************

        // Creación del objeto de la clase heredada
        $pdf = new PDF1();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetY($Y_Fields_Name_position);
        $pdf->SetX(0);
        //Set the interior cell margin to 1cm
        $pdf->cMargin=10;

        $pdf->SetFont('Arial','',18);
        $pdf->Cell(0,10,'CERTIFICADO DE ' . strtoupper($articulo['DESCRIPCION']) . ' ' . $sello['SELLO'], 0, 1, 'C');
        $pdf->SetFont('Arial','',16);

        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'SOLICITANTE : BALMETAL S.A.',0,0);
        $pdf->Cell(150,3,'ORDEN DE TRABAJO : 370097 ',0,1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'ATENCION SR. : PEDRO BALTRA C.',0,0);
        $pdf->Cell(95,3,'FECHA DE EMISION : ' . date("d-m-Y"),0,1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'DIRECCION : JOSE MIGUEL CARRERA SITIO N8 - COLINA - SANTIAGO',0,1);

        $pdf->Ln(3);
        $pdf->SetFont('Arial','',10);
        //Print 2 MultiCells
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        $pdf->MultiCell(190,5,"CESMEC S.A. CERTIFICA QUE EL PRODUCTO ". strtoupper($articulo['DESCRIPCION']) . ", CUMPLE CON ESPECIFICACION TECNICA DE DISENO, FABRICACION Y MONTAJE. ESTA BARRA DEBE ESTAR ETIQUETADA CON EL SELLO DE CESMEC CORRESPONDIENTE AL NUMERO DE GOLPE UBICADA EN UNA DE SUS PLACAS BASES Y QUE COINCIDE CON EL DE ESTE DOCUMENTO.",0,'J',false);
//        $pdf->Ln(10);
//        $pdf->SetFont('Arial','',10);
//        $pdf->Cell(95,3,'CESMEC S.A. CERTIFICA QUE EL PRODUCTO BARRA PROTECTORA CONTRA VUELCO EXTERIOR, CUMPLE CON ESPECIFICACION TECNICA DE DISEÑO, FABRICACIÓN Y MONTAJE. ESTA BARRA DEBE ESTAR ETIQUETADA CON EL SELLO DE CESMEC CORRESPONDIENTE AL NUMERO DE GOLPE UBICADA EN UNA DE SUS PLACAS BASES Y QUE COINCIDE CON EL DE ESTE DOCUMENTO.',0,0);

        $pdf->Ln(2);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'1. ANTECEDENTES',0,1);
        //Print 2 Cells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->MultiCell(90,8,'- Producto :',0,'L',false);
        $pdf->SetXY(70,$y);
        //$pdf->MultiCell(130,8,$glosa,0,'L',false);
        $pdf->MultiCell(130,8,$familia['GLOSA_FAMILIA'],0,'L',false);

        $pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'2. PROCEDIMIENTOS',0,1);
        //Print 2 Cells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'- Inspeccion de fabricacion :',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Efectuada en las instalaciones del fabricante, ubicada en Jose Miguel Carrera sitio N8, Colina, Santiago.',0,'J',false);

        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'- Controles Efectuados :',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Producto terminado.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Visual (Construccion y recubrimiento).',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Control dimensional.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Inspeccion visual de soldadura.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Verificacion documental del acero.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Inspeccion de instalacion y sus materiales.',0,'L',false);

        $pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'3. RESULTADOS',0,1);
        //Print 2 MultiCells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        if($patente != null && $chasis != null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo patente " . $patente . " y chasis " . $chasis . "." ,0,'J',false);
        }
        else if($patente == null && $chasis != null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo chasis " . $chasis . "." ,0,'J',false);
        }
        else if($patente != null && $chasis == null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo patente " . $patente . "." ,0,'J',false);
        }


        $pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'4. CONCLUSION',0,1);
        //Print 2 MultiCells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        $pdf->MultiCell(190,5,"DE ACUERDO CON LOS RESULTADOS OBTENIDOS EN LOS CONTROLES EFECTUADOS SE CONCLUYE QUE EL ITEM INSPECCIONADO CUMPLE CON LO ESPECIFICADO.",0,'J',false);

        $pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'5. El presente certificado se emite para presentar en las faenas que se estimen conveniente.',0,1);

        // Column headings
        $header = array('TIPO DE BARRA', 'N SELLO CESMEC/BUREAU VERITAS');
        $data = array($familia['NOMBRE_FAMILIA'], $sello['SELLO']);
        $pdf->FancyTable($header,$data);

        $pdf->Image('http://www.balmetal.cl/procesadorcodigos/dist/img/firmaCertificado.png',92, $pdf->GetY(), 30, 15);
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,5,'Paola Monsalve C.,',0,2,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,5,'Jefe Dpto. Sello de Calidad',0,2,'C');

        $pdf->Ln(4);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(30,3,'kp/' . $folio,0,0);
        $pdf->Cell(100,3,'ESTE INFORME TIENE UNA VALIDEZ DE CINCO ANOS A CONTAR DE SU FECHA DE EMISION',0,1);

        $filename = 'Certificado-'. $folio . '-1.pdf';
        $urlprimer = 'upload/fpdf/' . $filename;
        $pdf->Output($urlprimer, 'F');

        //******************************** SEGUNDO CERTIFICADO ******************************


        // Creación del objeto de la clase heredada
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetY($Y_Fields_Name_position);
        $pdf->SetX(0);
        //Set the interior cell margin to 1cm
        $pdf->cMargin=10;

        /*$pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,'Razon Social: Eli-Batt SpA',0,2,'R');
        $pdf->Cell(0,5,'RUT: 76.499.558-9',0,2,'R');
        $pdf->Cell(0,5,'Fecha : ' . date("d-m-Y") ,0,2,'R');*/

        $pdf->SetFont('Arial','',18);
        $pdf->Cell(0,10,'CERTIFICADO DE ' . strtoupper($articulo['DESCRIPCION']) . ' ' . $sello['SELLO'], 0, 1, 'C');
        $pdf->SetFont('Arial','',16);

        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'SOLICITANTE : BALMETAL S.A.',0,0);
        $pdf->Cell(150,3,'ORDEN DE TRABAJO : 370097 ',0,1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'ATENCION SR. : PEDRO BALTRA C.',0,0);
        $pdf->Cell(95,3,'FECHA DE EMISION : ' . date("d-m-Y"),0,1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(95,3,'DIRECCION : JOSE MIGUEL CARRERA SITIO N8 - COLINA - SANTIAGO',0,1);

        $pdf->Ln(3);
        $pdf->SetFont('Arial','',10);
        //Print 2 MultiCells
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        $pdf->MultiCell(190,5,"CESMEC S.A. CERTIFICA QUE EL PRODUCTO ". strtoupper($articulo['DESCRIPCION']) . ", CUMPLE CON ESPECIFICACION TECNICA DE DISENO, FABRICACION Y MONTAJE. ESTA BARRA DEBE ESTAR ETIQUETADA CON EL SELLO DE CESMEC CORRESPONDIENTE AL NUMERO DE GOLPE UBICADA EN UNA DE SUS PLACAS BASES Y QUE COINCIDE CON EL DE ESTE DOCUMENTO.",0,'J',false);
//        $pdf->Ln(10);
//        $pdf->SetFont('Arial','',10);
//        $pdf->Cell(95,3,'CESMEC S.A. CERTIFICA QUE EL PRODUCTO BARRA PROTECTORA CONTRA VUELCO EXTERIOR, CUMPLE CON ESPECIFICACION TECNICA DE DISEÑO, FABRICACIÓN Y MONTAJE. ESTA BARRA DEBE ESTAR ETIQUETADA CON EL SELLO DE CESMEC CORRESPONDIENTE AL NUMERO DE GOLPE UBICADA EN UNA DE SUS PLACAS BASES Y QUE COINCIDE CON EL DE ESTE DOCUMENTO.',0,0);

        $pdf->Ln(2);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'1. ANTECEDENTES',0,1);
        //Print 2 Cells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->MultiCell(90,8,'- Producto :',0,'L',false);
        $pdf->SetXY(70,$y);
        //$pdf->MultiCell(130,8,$glosa,0,'L',false);
        $pdf->MultiCell(130,8,$familia['GLOSA_FAMILIA'],0,'L',false);

        //$pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'2. PROCEDIMIENTOS',0,1);
        //Print 2 Cells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'- Inspeccion de fabricacion :',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Efectuada en las instalaciones del fabricante, ubicada en Jose Miguel Carrera sitio N8, Colina, Santiago.',0,'J',false);

        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'- Controles Efectuados :',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Producto terminado.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Visual (Construccion y recubrimiento).',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Control dimensional.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Inspeccion visual de soldadura.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Verificacion documental del acero.',0,'L',false);
        //Print 2 Cells
        $y=$pdf->GetY();
        $pdf->MultiCell(90,5,'',0,'L',false);
        $pdf->SetXY(70,$y);
        $pdf->MultiCell(130,5,'Inspeccion de instalacion y sus materiales.',0,'L',false);

        //$pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'3. RESULTADOS',0,1);
        //Print 2 MultiCells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        if($patente != null && $chasis != null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo patente " . $patente . " y chasis " . $chasis . "." ,0,'J',false);
        }
        else if($patente == null && $chasis != null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo chasis " . $chasis . "." ,0,'J',false);
        }
        else if($patente != null && $chasis == null)
        {
            $pdf->MultiCell(190,5,"La inspeccion de fabricacion de las barras se realiza previamente en negro y posteriormente con su tratamiento de pintura. Las barras no presentan defectos constructivos y de terminacion. La documentacion se ajusta a lo declarado en memoria de calculo, la inspeccion de instalacion verifica el vehiculo patente " . $patente . "." ,0,'J',false);
        }

        //$pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'4. CONCLUSION',0,1);
        //Print 2 MultiCells
        $pdf->SetFont('Arial','',10);
        $y=$pdf->GetY();
        $pdf->SetXY(10,$y);
        $pdf->MultiCell(190,5,"DE ACUERDO CON LOS RESULTADOS OBTENIDOS EN LOS CONTROLES EFECTUADOS SE CONCLUYE QUE EL ITEM INSPECCIONADO CUMPLE CON LO ESPECIFICADO.",0,'J',false);

        $pdf->Ln(1);
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(95,10,'5. El presente certificado se emite para presentar en las faenas que se estimen conveniente.',0,1);

        // Column headings
        $header = array('TIPO DE BARRA', 'N SELLO CESMEC/BUREAU VERITAS');
        $data = array($familia['NOMBRE_FAMILIA'], $sello['SELLO']);
        $pdf->FancyTable($header,$data);

        $pdf->Image('http://www.balmetal.cl/procesadorcodigos/dist/img/firmaCertificado.png',92, $pdf->GetY(), 30, 15);
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,5,'Paola Monsalve C.,',0,2,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,5,'Jefe Dpto. Sello de Calidad',0,2,'C');

        $pdf->Ln(4);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(30,3,'kp/' . $folio,0,0);
        $pdf->Cell(100,3,'ESTE INFORME TIENE UNA VALIDEZ DE CINCO ANOS A CONTAR DE SU FECHA DE EMISION',0,1);

        //$pdf->Output();
        $filename = 'Certificado-'. $folio . '.pdf';
        $url = 'upload/fpdf/' . $filename;
        $pdf->Output($url,'F');

        return $this->modelS->createNewCertificado($idSello, $idCliente, $idAuto, $patente, $chasis, /*$glosa,*/ $obs, $folio, $url, $urlprimer);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        //$this->Image('http://www.balmetal.cl/procesadorcodigos/dist/img/cesmec.png', 160, 8, 33);
        // Arial bold 15
        //$this->SetFont('Arial','B',10);
        // Movernos a la derecha
        //$this->Cell(80);
        // Título
        //$this->Cell(30,5,'Confirmacion de solicitud de reserva',0,0,'C');
        // Salto de línea
        //$this->Ln(10);

        /*$pageWidth = 200;
        $pageHeight = 250;
        $margin = 10;
        $this->Rect( $margin, 35, $pageWidth - $margin , $pageHeight - $margin);*/
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        //$this->Cell(0,5,'ESTE INFORME TIENE UNA VALIDEZ DE CINCO ANOS A CONTAR DE SU FECHA DE EMISION',0,1,'C');
        //$this->Cell(0,5,'SANTIAGO&nbsp;&nbsp;ARICA&nbsp;&nbsp;IQUIQUE&nbsp;&nbsp;ANTOFAGASTA&nbsp;&nbsp;CALAMA&nbsp;&nbsp;COPIAPO TALCAHUANO PTO. MONTT PTA. ARENAS',0,0,'C');
    }

    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak())
        {
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0)
            {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation);
            $this->x=$x;
            if($ws>0)
            {
                $this->ws=$ws;
                $this->_out(sprintf('%.3F Tw',$ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
        if($fill || $border==1)
        {
            if($fill)
                $op=($border==1) ? 'B' : 'f';
            else
                $op='S';
            $s=sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
        }
        if(is_string($border))
        {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border,'L')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'T')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            if(is_int(strpos($border,'R')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'B')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if($txt!='')
        {
            if($align=='R')
                $dx=$w-$this->cMargin-$this->GetStringWidth($txt);
            elseif($align=='C')
                $dx=($w-$this->GetStringWidth($txt))/2;
            elseif($align=='FJ')
            {
                //Set word spacing
                $wmax=($w-2*$this->cMargin);
                $this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt,' ');
                $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                $dx=$this->cMargin;
            }
            else
                $dx=$this->cMargin;
            $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
            if($this->ColorFlag)
                $s.='q '.$this->TextColor.' ';
            $s.=sprintf('BT %.2F %.2F Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt);
            if($this->underline)
                $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
            if($this->ColorFlag)
                $s.=' Q';
            if($link)
            {
                if($align=='FJ')
                    $wlink=$wmax;
                else
                    $wlink=$this->GetStringWidth($txt);
                $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$wlink,$this->FontSize,$link);
            }
        }
        if($s)
            $this->_out($s);
        if($align=='FJ')
        {
            //Remove word spacing
            $this->_out('0 Tw');
            $this->ws=0;
        }
        $this->lasth=$h;
        if($ln>0)
        {
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }

    // Colored table
    function FancyTable($header, $data)
    {
        $this->SetX(45);
        // Colors, line width and bold font
        $this->SetFillColor(224,224,224);
        $this->SetTextColor(0);
        $this->SetDrawColor(224,224,224);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(40, 75);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        $this->SetX(45);
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $i = 0;
        foreach($data as $row)
        {
            $this->Cell($w[$i],6,$row,'LR',0,'C',false);
            $i++;
        }
        $this->Ln();
        // Closing line
        $this->Cell(array_sum($w),0,'','C');
    }

}

class PDF1 extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('http://www.balmetal.cl/procesadorcodigos/dist/img/cesmec.png', 160, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial','B',10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        //$this->Cell(30,5,'Confirmacion de solicitud de reserva',0,0,'C');
        // Salto de línea
        //$this->Ln(10);

        $pageWidth = 200;
        $pageHeight = 250;
        $margin = 10;
        $this->Rect( $margin, 35, $pageWidth - $margin , $pageHeight - $margin);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,5,'SANTIAGO ARICA IQUIQUE ANTOFAGASTA CALAMA COPIAPO TALCAHUANO PTO. MONTT PTA. ARENAS',0,0,'C');
    }

    // Colored table
    function FancyTable($header, $data)
    {
        $this->SetX(45);
        // Colors, line width and bold font
        $this->SetFillColor(224,224,224);
        $this->SetTextColor(0);
        $this->SetDrawColor(224,224,224);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(40, 75);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        $this->SetX(45);
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $i = 0;
        foreach($data as $row)
        {
            $this->Cell($w[$i],6,$row,'LR',0,'C',false);
            $i++;
        }
        $this->Ln();
        // Closing line
        $this->Cell(array_sum($w),0,'','C');
    }

}


?>