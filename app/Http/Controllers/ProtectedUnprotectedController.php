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

class ProtectedUnprotectedController extends Controller
{
    public function protected_unprotected(){
		$data = ExcelExport::all();
		return view('protected-and-unprotected-on-cells', compact('data'));
	}
	
    public function protected_unprotected_excel(){
		
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
		$spreadsheet->getActiveSheet()->setTitle('Protected Unprotected');	
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		$spreadsheet->getActiveSheet()->SetCellValue('A2', 'Protected and Unprotected on Cells');
		$spreadsheet->getActiveSheet()->getStyle('A2')->getFont();
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:H2');
		
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:H3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:H5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d1');	
		
		/*Start of Column Merge*/
		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('A4', 'Protected Cell')	
					->SetCellValue('C4', 'Unprotected Cell')									
					->SetCellValue('E4', 'Protected Cell');	
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E4');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(40);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(40);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(40);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:H4') -> applyFromArray($styleThinBlackBorderOutline);	
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A4:B4');
		$spreadsheet -> getActiveSheet() -> mergeCells('C4:D4');
		$spreadsheet -> getActiveSheet() -> mergeCells('E4:H4');
		/*end of Column Merge*/
		
		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()				
					->SetCellValue('A5', '#')							
					->SetCellValue('B5', 'Cell1')
					->SetCellValue('C5', 'Cell2')							
					->SetCellValue('D5', 'Cell3')							
					->SetCellValue('E5', '(Cell2*Cell3)')							
					->SetCellValue('F5', '(Cell2+Cell3)')														
					->SetCellValue('G5', '(Cell2-Cell3)')
					->SetCellValue('H5', '(Cell2/Cell3)');
						
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A5');	
		$spreadsheet -> getActiveSheet()->getStyle('B5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B5');
		$spreadsheet -> getActiveSheet()->getStyle('C5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C5');
		$spreadsheet -> getActiveSheet()->getStyle('D5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'D5');
		$spreadsheet -> getActiveSheet()->getStyle('E5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E5');
		$spreadsheet -> getActiveSheet()->getStyle('F5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F5');
		$spreadsheet -> getActiveSheet()->getStyle('G5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'G5');
		$spreadsheet -> getActiveSheet()->getStyle('H5') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'H5');

		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('D5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('E5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('F5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('G5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('H5') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('G5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('H5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('G') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('H') -> setWidth(20);	
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A5:A5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B5:B5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C5:C5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D5:D5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E5:E5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F5:F5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('G5:G5') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('H5:H5') -> applyFromArray($styleThinBlackBorderOutline);	
		
		$i=1; 
		$j=6;
		foreach($data as $aRow){
			
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow->ItemName)	
						->SetCellValue('C'.$j, $aRow->Price)																
						->SetCellValue('D'.$j, $aRow->Quantity)																
						->SetCellValue('E'.$j, '')															
						->SetCellValue('F'.$j, '')																
						->SetCellValue('G'.$j, '')
						->SetCellValue('H'.$j, '');
					
			/*border color set for cells*/	
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('G' . $j . ':G' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('H' . $j . ':H' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('F' . $j . ':F' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('G' . $j . ':G' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('H' . $j . ':H' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('G' . $j . ':G' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('H' . $j . ':H' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
					
			/* Data Validation for Column C */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('C' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');
			
			/* Data Validation for Column D */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('D' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');  		
			
			/* Calculated Multiplication */
			$spreadsheet->getActiveSheet()->setCellValue('E'.$j, "=C$j*D$j");
			
			/* Calculated Addition */
			$spreadsheet->getActiveSheet()->setCellValue('F'.$j, "=C$j+D$j");
			
			/* Calculated Subtraction */
			$spreadsheet->getActiveSheet()->setCellValue('G'.$j, "=C$j-D$j");
			
			/* Calculated Division */
			$spreadsheet->getActiveSheet()->setCellValue('H'.$j, "=C$j/D$j");		
			
			/*Number format Cell C*/
			$spreadsheet->getActiveSheet()->getStyle('C'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('C'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
				
			/*Number format Cell D*/
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Number format Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Number format Cell F*/
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Number format Cell G*/
			$spreadsheet->getActiveSheet()->getStyle('G'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('G'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Number format Cell H*/
			$spreadsheet->getActiveSheet()->getStyle('H'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('H'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Protected the Cell Range*/
			$spreadsheet->getActiveSheet()->protectCells('A1:H5', 'PHP');			
			$spreadsheet->getActiveSheet()->protectCells('A'.$j.':B'.$j, 'PHP');
			$spreadsheet->getActiveSheet()->protectCells('E'.$j.':H'.$j, 'PHP'); 
			
			/*Unprotected the Cell Range*/
			$spreadsheet->getActiveSheet()->getStyle('C'.$j.':D'.$j)->getProtection()	
				->setLocked(Protection::PROTECTION_UNPROTECTED); 	
			
			if ($j % 2 == 0) {
				$spreadsheet->getActiveSheet()->getStyle('A'.$j.':H'.$j)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('f4f8fb');
			}
			
			$i++; $j++;
		}
		
		/*Protection the Worksheet*/
		$spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
		$spreadsheet->getSecurity()->setLockWindows(true);
		$spreadsheet->getSecurity()->setLockStructure(true);
		$spreadsheet->getSecurity()->setLockRevision(true);
		$spreadsheet->getSecurity()->setWorkbookPassword('123');
		$spreadsheet->getSecurity()->setRevisionsPassword('123');
		$spreadsheet->getActiveSheet()->getProtection()->setSort(true);
		$spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
		$spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'protected-and-unprotected-on-cells-'.$exportTime. '.xlsx'; //Save file name
		$writer->save('public/media/' . $file);
		$ExportFile = 'public/media/' . $file;

		return response()->download($ExportFile);		
	}	
}
