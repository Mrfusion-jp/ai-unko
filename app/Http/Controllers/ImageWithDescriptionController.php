<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\ExcelExport;

//include PhpSpreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;	
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;	
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImageWithDescriptionController extends Controller
{
    public function image_with_description(){
		$data = ExcelExport::all();
		return view('image-with-description', compact('data'));
	}

    public function image_with_description_excel(){
		
		$data = ExcelExport::all();
		
		$spreadsheet = new Spreadsheet();
		
		/*Page Setup
		Page Orientation(ORIENTATION_LANDSCAPE/ORIENTATION_PORTRAIT), 
		Paper Size(PAPERSIZE_A3,PAPERSIZE_A4,PAPERSIZE_A5,PAPERSIZE_LETTER,PAPERSIZE_LEGAL etc)*/
		$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
		
		/*Set Page Margins for a Worksheet*/
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.75);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.70);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.70);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.75);

		/*Center a page horizontally/vertically*/
		$spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
		$spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

		/*Show/hide gridlines(true/false)*/
		$spreadsheet->getActiveSheet()->setShowGridlines(true);
		
		//Activate work sheet
		$spreadsheet->createSheet(0);
		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet(0);
		//work sheet name
		$spreadsheet->getActiveSheet()->setTitle('Image With Description');	
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		$spreadsheet->getActiveSheet()->SetCellValue('A2', 'Image With Description');
		$spreadsheet->getActiveSheet()->getStyle('A2')->getFont();
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:C2');
		
		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('A4', '#')							
					->SetCellValue('B4', 'Image')
					->SetCellValue('C4', 'Item Description');
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');	
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(25);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(60);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:C4') -> applyFromArray($styleThinBlackBorderOutline);
		
		$i=1; 
		$j=5;
		foreach($data as $aRow){
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i);
						/*Draw image*/ 
						$drawing = new Drawing();
						//$drawing->setName('Logo');
						//$drawing->setDescription('This is my logo');
						$drawing->setPath(public_path('images/demo/'.$aRow->image));
						$drawing->setWidth(155);
						$drawing->setHeight(116);
						$drawing->setCoordinates('B'.$j);
						$drawing->setWorksheet($spreadsheet->getActiveSheet());

			$spreadsheet->getActiveSheet()
						->SetCellValue('C'.$j, $aRow->ItemName.' - ('.$aRow->ItemCode.')'."\n".$aRow->Date."\n".$aRow->description);
					
			/*border color set for cells*/	
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
			/*Wrap text*/
			$spreadsheet->getActiveSheet()->getStyle('B' . $j)->getAlignment()->setWrapText(true);
			$spreadsheet->getActiveSheet()->getStyle('C' . $j)->getAlignment()->setWrapText(true);
						
			$i++; $j++;
		}		
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'image-with-description-'.$exportTime. '.xlsx'; //Save file name
		$writer->save('public/media/' . $file);
		$ExportFile = 'public/media/' . $file;

		return response()->download($ExportFile);		
	}	
}
