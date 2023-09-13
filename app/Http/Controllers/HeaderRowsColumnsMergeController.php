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

class HeaderRowsColumnsMergeController extends Controller
{
    public function header_rows_columns_merge(){
		$data = ExcelExport::all();
		return view('header-rows-columns-merge', compact('data'));
	}
	
    public function header_rows_columns_merge_excel(){
		
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
		$spreadsheet->getActiveSheet()->setTitle('Header Rows and Columns Merge');	
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		$spreadsheet->getActiveSheet()->SetCellValue('A2', 'Header (Rows and Columns Merge)');
		$spreadsheet->getActiveSheet()->getStyle('A2')->getFont();
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:F2');
		
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:F3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:F5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d1');	
		
		/*Start of Column Merge*/
		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('A4', '#')	
					->SetCellValue('B4', 'Row Merge')	
					->SetCellValue('C4', 'Column Merge 1')									
					->SetCellValue('E4', 'Column Merge 2');
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');	
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E4');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(40);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(40);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:F4') -> applyFromArray($styleThinBlackBorderOutline);

		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A4:A5');
		$spreadsheet -> getActiveSheet() -> mergeCells('B4:B5');
		$spreadsheet -> getActiveSheet() -> mergeCells('C4:D4');
		$spreadsheet -> getActiveSheet() -> mergeCells('E4:F4');
		/*end of Column Merge*/	

		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('C5', 'Column 2')							
					->SetCellValue('D5', 'Column 3')							
					->SetCellValue('E5', 'Column 4')							
					->SetCellValue('F5', 'Column 5');
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('C5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C5');	
		$spreadsheet -> getActiveSheet()->getStyle('D5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'D5');
		$spreadsheet -> getActiveSheet()->getStyle('E5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E5');
		$spreadsheet -> getActiveSheet()->getStyle('F5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F5');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('C5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('E5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('F5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('C5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('C5:C5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D5:D5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E5:E5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F5:F5') -> applyFromArray($styleThinBlackBorderOutline);	

		$i=1; 
		$j=6;
		foreach($data as $aRow){
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow->ItemName)	
						->SetCellValue('C'.$j, $aRow->ItemCode)																
						->SetCellValue('D'.$j, $aRow->Date)																
						->SetCellValue('E'.$j, $aRow->Price)																
						->SetCellValue('F'.$j, $aRow->Quantity);
					
			/*border color set for cells*/	
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('F' . $j . ':F' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			
			/*DateTime format Cell D*/
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
			//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	

			/*Number format Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Number format Cell F*/
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			if ($j % 2 == 0) {
				$spreadsheet->getActiveSheet()->getStyle('A'.$j.':F'.$j)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('f4f8fb');
			}
			
			$i++; $j++;
		}
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'header-rows-and-columns-merge-'.$exportTime. '.xlsx'; //Save file name
		$writer->save('public/media/' . $file);
		$ExportFile = 'public/media/' . $file;

		return response()->download($ExportFile);		
	}	
}
