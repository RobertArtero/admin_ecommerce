<?php
require_once APPPATH."/third_party/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

class Pdfgenerator {

	public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
	{


		$dompdf = new DOMPDF();
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);
		$dompdf->render();
		if ($stream) {
			$dompdf->stream($filename.".pdf", array("Attachment" => 1));
		}
		else
		{
			return $dompdf->output();
		}



	}

}
