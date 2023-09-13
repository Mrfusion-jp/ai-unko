<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Basic
Route::get('/', 'BasicExcelExportController@basic_export');
Route::get('/basic-excel-export', 'BasicExcelExportController@basic_excel_export');

//Row Grouping
Route::get('/row-grouping', 'RowGroupingController@row_grouping');
Route::get('/row-grouping-excel', 'RowGroupingController@row_grouping_excel');

//Header (Rows and Columns Merge)
Route::get('/header-rows-columns-merge', 'HeaderRowsColumnsMergeController@header_rows_columns_merge');
Route::get('/header-rows-columns-merge-excel', 'HeaderRowsColumnsMergeController@header_rows_columns_merge_excel');

//Autofilter Range of Cells
Route::get('/autofilter-range-of-cells', 'AutofilterRangeOfCellsController@autofilter_range_of_cells');
Route::get('/autofilter-range-of-cells-excel', 'AutofilterRangeOfCellsController@autofilter_range_of_cells_excel');

//Formula Calculations
Route::get('/formula-calculations', 'FormulaCalculationsController@formula_calculations');
Route::get('/formula-calculations-excel', 'FormulaCalculationsController@formula_calculations_excel');

//Protected and Unprotected on Cells
Route::get('/protected-and-unprotected-on-cells', 'ProtectedUnprotectedController@protected_unprotected');
Route::get('/protected-and-unprotected-on-cells-excel', 'ProtectedUnprotectedController@protected_unprotected_excel');

//Image With Description
Route::get('/image-with-description', 'ImageWithDescriptionController@image_with_description');
Route::get('/image-with-description-excel', 'ImageWithDescriptionController@image_with_description_excel');

