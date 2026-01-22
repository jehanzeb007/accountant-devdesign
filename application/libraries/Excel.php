<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    public function __construct() {
        $this->_ci = get_instance();
    }

    public function generate_ledgerstatement_xls($data, $type = 'xls')
    {
        extract($data);

        if ($showEntries) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->setTitle(lang('ledgerstatement'));

            $sheet->SetCellValue('A1', $subtitle);
            $sheet->mergeCells('A1:H1');


           $sheet->SetCellValue('A2', lang('ledgers_views_add_label_bank_cash_account'));
            $sheet->mergeCells('A2:B2');
            $sheet->SetCellValue('A3', lang('ledgers_views_add_label_notes'));

            $sheet->SetCellValue('C2', ($ledger_data['type'] == 1) ? lang('yes') : lang('no'));
            $sheet->SetCellValue('C3', $ledger_data['notes']);


            $sheet->SetCellValue('E2', $opening_title);
            $sheet->mergeCells('E2:G2');

            $sheet->SetCellValue('H2', $this->_ci->functionscore->toCurrency($op['dc'], $op['amount']));
            $sheet->SetCellValue('E3', $closing_title);
            $sheet->mergeCells('E3:G3');

            $sheet->SetCellValue('H3', $this->_ci->functionscore->toCurrency($cl['dc'], $cl['amount']));


            $sheet->SetCellValue('A5', lang('date'));
            $sheet->SetCellValue('B5', lang('number'));
            $sheet->SetCellValue('C5', lang('ledger'));
            $sheet->SetCellValue('D5', lang('type'));
            $sheet->SetCellValue('E5', lang('tag') );
            $sheet->SetCellValue('F5', lang('dr_amount') );
            $sheet->SetCellValue('G5', lang('cr_amount') );
            $sheet->SetCellValue('H5', lang('balance') );

            $entry_balance['amount'] = $current_op['amount'];
            $entry_balance['dc'] = $current_op['dc'];

            $sheet->SetCellValue('A6', lang('curr_opening_balance'));
            $sheet->mergeCells('A6:G6');
            $sheet->SetCellValue('H6', $this->_ci->functionscore->toCurrency($current_op['dc'], $current_op['amount']));
            
            $row = 7;
            foreach ($entries as $entry) {
                $ir = $row + 1;
                if ($ir % 2 == 0) {
                    $style_header = array(                  
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => array('rgb'=>'CCCCCC'),
                        ),
                    );
                    $sheet->getStyle("A$row:H$row")->applyFromArray( $style_header );
                }
                /* Calculate current entry balance */
                $entry_balance = $this->_ci->functionscore->calculate_withdc(
                    $entry_balance['amount'], $entry_balance['dc'],
                    $entry['amount'], $entry['dc']
                );

                $et = $this->_ci->DB1->where('id', $entry['entrytype_id'])->get('entrytypes')->row_array();
                $entryTypeName = $et['name'];
                $entryTypeLabel = $et['label'];


                $sheet->SetCellValue('A' . $row, $this->_ci->functionscore->dateFromSql($entry['date']));
                $sheet->SetCellValue('B' . $row, $this->_ci->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id']));
                $sheet->SetCellValue('C' . $row, $this->_ci->functionscore->entryLedgers($entry['id']));
                $sheet->SetCellValue('D' . $row, $entryTypeName);
                $sheet->SetCellValue('E' . $row, $this->_ci->settings_model->getTagNameByID($entry['tag_id']));
                
                if ($entry['dc'] == 'D') {
                    $sheet->SetCellValue('F' . $row, $this->_ci->functionscore->toCurrency('D', $entry['amount']));
                } else if ($entry['dc'] == 'C') {
                    $sheet->SetCellValue('G' . $row, $this->_ci->functionscore->toCurrency('C', $entry['amount']));
                } else {
                    $sheet->SetCellValue('F' . $row, lang('error'));
                    $sheet->SetCellValue('G' . $row, lang('error'));
                }

                $sheet->SetCellValue('H' . $row, $this->_ci->functionscore->toCurrency($entry_balance['dc'], $entry_balance['amount']));
                $row++;
            }
            $style_header = array(                  
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => array('rgb'=>'fdbf2d'),
                ),
            );


            $sheet->getStyle("A$row:H$row")->applyFromArray( $style_header );
            $sheet->getStyle("A6:H6")->applyFromArray( $style_header );


            $sheet->SetCellValue("A$row", lang('curr_closing_balance'));
            $sheet->mergeCells("A$row:G$row");
            $sheet->SetCellValue("H$row", $this->_ci->functionscore->toCurrency($entry_balance['dc'], $entry_balance['amount']));


            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(60);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
           
            $filename = 'ledgerstatement';
            $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

            $header = 'A1:H1';
            $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('94ce58');
            $style = array(
                'font' => array('bold' => true,),
                'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
            );
            $sheet->getStyle($header)->applyFromArray($style);
            
            $titles = 'A5:H5';
            $sheet->getStyle($titles)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('94ce58');
            $style = array(
                'font' => array('bold' => true,),
                'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
            );
            $sheet->getStyle($titles)->applyFromArray($style);
            

            $header = 'A2:H3';
            $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('fdbf2d');
            $style = array(
                'font' => array('bold' => true,),
            );
            $sheet->getStyle($header)->applyFromArray($style);


            if ($type=='pdf') {

                // $name = 'Ledger Statement.pdf';

                // $this->load->view('reports/pdf/ledgerstatement', $this->data);
                
                // $html = $this->load->view('reports/pdf/ledgerstatement', $this->data, TRUE, NULL, NULL, NULL, NULL, 'L');
                // $this->_ci->functionscore->generate_pdf($html, $name);


                // require_once(APPPATH . "third_party" . DIRECTORY_SEPARATOR . "MPDFF" . DIRECTORY_SEPARATOR . "mpdf.php");
                // $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
                // $rendererLibrary = 'MPDFF';
                // $rendererLibraryPath = APPPATH . 'third_party' . DIRECTORY_SEPARATOR . $rendererLibrary;
                // if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                //     die('Please set the $rendererName: ' . $rendererName . ' and $rendererLibraryPath: ' . $rendererLibraryPath . ' values' .
                //         PHP_EOL . ' as appropriate for your directory structure');
                // }

                // header('Content-Type: application/pdf');
                // header('Content-Disposition: attachment;filename="' . $filename . '.pdf"');
                // header('Cache-Control: max-age=0');

                // $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'PDF');
                // $objWriter->save('php://output');
                // exit();
            }
            if ($type=='xls') {
                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                exit();
            }
        }
    }

    public function generate_ledgerentries_xls($data, $type = 'xls')
    {
        extract($data);
        if ($showEntries) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->setTitle(lang('ledgerentries'));

            $sheet->SetCellValue('A1', $subtitle);
            $sheet->mergeCells('A1:H1');


            $sheet->SetCellValue('A2', lang('ledgers_views_add_label_bank_cash_account'));
            $sheet->mergeCells('A2:B2');
            $sheet->SetCellValue('A3', lang('ledgers_views_add_label_notes'));
            $sheet->mergeCells('A3:B3');

            $sheet->SetCellValue('C2', ($ledger_data['type'] == 1) ? lang('yes') : lang('no'));
            $sheet->SetCellValue('C3', $ledger_data['notes']);


            $sheet->SetCellValue('E2', $opening_title);
            $sheet->mergeCells('E2:G2');

            $sheet->SetCellValue('H2', $this->_ci->functionscore->toCurrency($op['dc'], $op['amount']));
            $sheet->SetCellValue('E3', $closing_title);
            $sheet->mergeCells('E3:G3');

            $sheet->SetCellValue('H3', $this->_ci->functionscore->toCurrency($cl['dc'], $cl['amount']));


            $sheet->SetCellValue('A5', lang('date'));
            $sheet->SetCellValue('B5', lang('number'));
            $sheet->SetCellValue('C5', lang('ledger'));
            $sheet->SetCellValue('D5', lang('type'));
            $sheet->SetCellValue('E5', lang('tag') );
            $sheet->SetCellValue('F5', lang('dr_amount') );
            $sheet->SetCellValue('G5', lang('cr_amount') );
            $sheet->SetCellValue('H5', lang('balance') );

            $entry_balance['amount'] = $current_op['amount'];
            $entry_balance['dc'] = $current_op['dc'];

         
            $row = 6;
            foreach ($entries as $entry) {
                $ir = $row + 1;
                if ($ir % 2 == 0) {
                    $style_header = array(                  
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => array('rgb'=>'CCCCCC'),
                        ),
                    );
                    $sheet->getStyle("A$row:H$row")->applyFromArray( $style_header );
                }
                /* Calculate current entry balance */
                $entry_balance = $this->_ci->functionscore->calculate_withdc(
                    $entry_balance['amount'], $entry_balance['dc'],
                    $entry['amount'], $entry['dc']
                );

                $et = $this->_ci->DB1->where('id', $entry['entrytype_id'])->get('entrytypes')->row_array();
                $entryTypeName = $et['name'];
                $entryTypeLabel = $et['label'];


                $sheet->SetCellValue('A' . $row, $this->_ci->functionscore->dateFromSql($entry['date']));
                $sheet->SetCellValue('B' . $row, $this->_ci->functionscore->toEntryNumber($entry['number'], $entry['entrytype_id']));
                $sheet->SetCellValue('C' . $row, $this->_ci->functionscore->entryLedgers($entry['id']));
                $sheet->SetCellValue('D' . $row, $entryTypeName);
                $sheet->SetCellValue('E' . $row, $this->_ci->settings_model->getTagNameByID($entry['tag_id']));
                
                if ($entry['dc'] == 'D') {
                    $sheet->SetCellValue('F' . $row, $this->_ci->functionscore->toCurrency('D', $entry['amount']));
                } else if ($entry['dc'] == 'C') {
                    $sheet->SetCellValue('G' . $row, $this->_ci->functionscore->toCurrency('C', $entry['amount']));
                } else {
                    $sheet->SetCellValue('F' . $row, lang('error'));
                    $sheet->SetCellValue('G' . $row, lang('error'));
                }

                $sheet->SetCellValue('H' . $row, $this->_ci->functionscore->toCurrency($entry_balance['dc'], $entry_balance['amount']));
                $row++;
            }
            $style_header = array(                  
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => array('rgb'=>'fdbf2d'),
                ),
            );


            $sheet->getStyle("A$row:H$row")->applyFromArray( $style_header );
            $sheet->getStyle("A6:H6")->applyFromArray( $style_header );


            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(60);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
           
            $filename = 'ledgerentries';
            $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

            $header = 'A1:H1';
            $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('94ce58');
            $style = array(
                'font' => array('bold' => true,),
                'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
            );
            $sheet->getStyle($header)->applyFromArray($style);
            
            $titles = 'A5:H5';
            $sheet->getStyle($titles)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('94ce58');
            $style = array(
                'font' => array('bold' => true,),
                'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
            );
            $sheet->getStyle($titles)->applyFromArray($style);
            

            $header = 'A2:H3';
            $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('fdbf2d');
            $style = array(
                'font' => array('bold' => true,),
            );
            $sheet->getStyle($header)->applyFromArray($style);


            if ($type=='pdf') {
                // require_once(APPPATH . "third_party" . DIRECTORY_SEPARATOR . "MPDFF" . DIRECTORY_SEPARATOR . "mpdf.php");
                // $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
                // $rendererLibrary = 'MPDFF';
                // $rendererLibraryPath = APPPATH . 'third_party' . DIRECTORY_SEPARATOR . $rendererLibrary;
                // if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                //     die('Please set the $rendererName: ' . $rendererName . ' and $rendererLibraryPath: ' . $rendererLibraryPath . ' values' .
                //         PHP_EOL . ' as appropriate for your directory structure');
                // }

                // header('Content-Type: application/pdf');
                // header('Content-Disposition: attachment;filename="' . $filename . '.pdf"');
                // header('Cache-Control: max-age=0');

                // $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'PDF');
                // $objWriter->save('php://output');
                // exit();
            }
            if ($type=='xls') {
                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                exit();
            }
        }
    }
    

    public function generate_entries_xls($data, $type = 'xls')
    {        
        $entry = $data['entry'];
        $entrytypeLabel = $data['entrytypeLabel'];
        $curEntryitems = $data['curEntryitems'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($this->_ci->mSettings->drcr_toby == 'toby') {
            $drcr_toby = lang('entries_views_views_th_to_by');
        } else {
            $drcr_toby = lang('entries_views_views_th_dr_cr');
        }
        $sheet->setTitle(ucfirst($entrytypeLabel).lang('entry_title')."  #".$entry['number']);

        $sheet->SetCellValue('A1', ucfirst($entrytypeLabel).lang('entry_title')."  #".$entry['number']);
        $sheet->mergeCells('A1:E1');

        $sheet->SetCellValue('A2', lang('date').": ".$entry['date']);
        $sheet->mergeCells('A2:E2');


        $sheet->SetCellValue('A3', $drcr_toby);
        $sheet->SetCellValue('B3', lang('entries_views_views_th_ledger'));
        $sheet->SetCellValue('C3', lang('entries_views_views_th_dr_amount'));
        $sheet->SetCellValue('D3', lang('entries_views_views_th_cr_amount'));
        $sheet->SetCellValue('E3', lang('entries_views_views_th_narration') );

        $row = 4;
        $ttotal = 0;
        $ttotal_tax = 0;
        $tgrand_total = 0;
        foreach ($curEntryitems as $entryitem) {
            $ir = $row + 1;
            if ($ir % 2 == 0) {
                $style_header = array(                  
                    'fill' => array(
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => array('rgb'=>'CCCCCC'),
                    ),
                );
                $sheet->getStyle("A$row:E$row")->applyFromArray( $style_header );
            }

            if ($this->_ci->mSettings->drcr_toby == 'toby') {
                if ($entryitem['dc'] == 'D') {
                    $dr_cr_rows = lang('entries_views_views_toby_D');
                } else {
                    $dr_cr_rows = lang('entries_views_views_toby_C');
                }
            } else {
                if ($entryitem['dc'] == 'D') {
                    $dr_cr_rows = lang('entries_views_views_drcr_D');
                } else {
                    $dr_cr_rows = lang('entries_views_views_drcr_C');
                }
            }


        
            $sheet->SetCellValue('A' . $row, $dr_cr_rows);
            $sheet->SetCellValue('B' . $row, $entryitem['ledger_name']);
            $sheet->SetCellValue('C' . $row, $entryitem['dc'] == 'D' ? $entryitem['dr_amount'] : '');
            $sheet->SetCellValue('D' . $row, $entryitem['dc'] == 'C' ? $entryitem['cr_amount'] : '');
            $sheet->SetCellValue('E' . $row, $entryitem['narration']);
            $row++;
        }
        $style_header = array(                  
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => array('rgb'=>'fdbf2d'),
            ),
        );


        $sheet->getStyle("A$row:E$row")->applyFromArray( $style_header );

        $sheet->SetCellValue("A$row", lang('entries_views_views_td_total'));
        $sheet->mergeCells("A$row:B$row");
        $sheet->SetCellValue("C$row", $this->_ci->functionscore->toCurrency('D', $entry['dr_total']));
        $sheet->SetCellValue("D$row", $this->_ci->functionscore->toCurrency('C', $entry['cr_total']));


        if ($this->_ci->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '==')) {
            /* Do nothing */
        } else {
            if ($this->_ci->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '>')) {
                $sheet->SetCellValue("A$row", lang('entries_views_views_td_diff'));
                $sheet->mergeCells("A$row:B$row");
                $sheet->SetCellValue("C$row",  $this->_ci->functionscore->toCurrency('D', $this->_ci->functionscore->calculate($entry['dr_total'], $entry['cr_total'], '-')));
            } else {
                $sheet->SetCellValue("A$row", lang('entries_views_views_td_diff'));
                $sheet->mergeCells("A$row:C$row");
                $sheet->SetCellValue("D$row", $this->_ci->functionscore->toCurrency('C', $this->_ci->functionscore->calculate($entry['cr_total'], $entry['dr_total'], '-')));
            }
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(60);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(60);
       
        $filename = 'entry_print';
        $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    
        $sheet->getStyle('C2:C' . ($row))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->getStyle('D2:D' . ($row))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $header = 'A1:E1';
        $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('94ce58');
        $style = array(
            'font' => array('bold' => true,),
            'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER),
        );
        $sheet->getStyle($header)->applyFromArray($style);
        
        $header = 'A2:E2';
        $sheet->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('fdbf2d');
        $style = array(
            'font' => array('bold' => true,),
            'alignment' => array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
        );
        $sheet->getStyle($header)->applyFromArray($style);

        if ($type=='pdf') {
            // require_once(APPPATH . "third_party" . DIRECTORY_SEPARATOR . "MPDFF" . DIRECTORY_SEPARATOR . "mpdf.php");
            // $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
            // $rendererLibrary = 'MPDFF';
            // $rendererLibraryPath = APPPATH . 'third_party' . DIRECTORY_SEPARATOR . $rendererLibrary;
            // if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
            //     die('Please set the $rendererName: ' . $rendererName . ' and $rendererLibraryPath: ' . $rendererLibraryPath . ' values' .
            //         PHP_EOL . ' as appropriate for your directory structure');
            // }

            // header('Content-Type: application/pdf');
            // header('Content-Disposition: attachment;filename="' . $filename . '.pdf"');
            // header('Cache-Control: max-age=0');

            // $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'PDF');
            // $objWriter->save('php://output');
            // exit();
        }
        
        if ($type=='xls') {
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }
}
