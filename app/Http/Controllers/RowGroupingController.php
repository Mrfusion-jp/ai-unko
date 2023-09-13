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

class RowGroupingController extends Controller
{
    public function row_grouping(){
		$data = ExcelExport::all();
		return view('row-grouping', compact('data'));
	}

    public function row_grouping_excel(){
		
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
		$spreadsheet->getActiveSheet()->setTitle('Row Grouping');	
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		$spreadsheet->getActiveSheet()->SetCellValue('A2', 'Row Grouping');
		$spreadsheet->getActiveSheet()->getStyle('A2')->getFont();
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:E2');
		
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:E3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d1');	
		
		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('A4', '#')							
					->SetCellValue('B4', 'Item Name')
					->SetCellValue('C4', 'Item Code')							
					->SetCellValue('D4', 'Price')							
					->SetCellValue('E4', 'Quantity');
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');	
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'D4');
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E4');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:C4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:E4') -> applyFromArray($styleThinBlackBorderOutline);

		$i=1; 
		$j=5;
		$tempDate = '';
		foreach($data as $aRow){
			
			/*Group*/			
			if ($tempDate!=$aRow->Date) {
				$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
				$spreadsheet->getActiveSheet()->getStyle('A' . $j . ':E' . $j)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('bfbfbf');
				$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
				$spreadsheet -> getActiveSheet() -> mergeCells('A' . $j . ':E' . $j);
				$spreadsheet -> getActiveSheet() -> SetCellValue('A' . $j++, $aRow->Date);
				
				$tempDate=$aRow->Date;
			}	
		
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow->ItemName)	
						->SetCellValue('C'.$j, $aRow->ItemCode)																
						->SetCellValue('D'.$j, $aRow->Price)																
						->SetCellValue('E'.$j, $aRow->Quantity);
					
			/*border color set for cells*/	
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			
			/*Number format Cell D*/
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Number format Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
		
			if ($j % 2 == 0) {
				$spreadsheet->getActiveSheet()->getStyle('A'.$j.':E'.$j)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('f4f8fb');
			}
		
			$i++; $j++;
		}		
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'row-grouping-'.$exportTime. '.xlsx'; //Save file name
		$writer->save('public/media/' . $file);
		$ExportFile = 'public/media/' . $file;

		return response()->download($ExportFile);		
	}
}
