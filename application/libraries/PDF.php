<?php defined('BASEPATH') OR exit('No direct script access allowed');

use mikehaertl\wkhtmlto\Pdf as HtmlToPDF;

/**
 * A simple codeigniter library to help setup phpwkhtmltopdf
 * @link https://gist.github.com/DykiSA/
 */

class PDF
{
    private $CI;
    private $error;
    private $options;
    
    /**
     * intialize the class WKPDF
     * @param array $options      override options for phpwkhtmltopdf
     */
    public function __construct($options = [])
    {
        $this->CI =& get_instance();
        
        $this->CI->load->helper('general');
        $arch = getOSArch();

        $this->initialize($options, $arch);
    }

    /**
     * initialize the library
     * @param array $options      override options for phpwkhtmltopdf
     */
    public function initialize($options = [], $arch) {
        // get options
        $this->CI->load->config('phpwkhtmltopdf');
        $this->options = $this->CI->config->item('phpwkhtmltopdf');

        if ($arch == '64') {
            $this->options['binary'] = $this->options['binary']['amd64'];
        } else {
            $this->options['binary'] = $this->options['binary']['i386'];
        }

        if (is_array($options) && !empty($options)) {
            $this->options = array_merge($this->options, $options);
        }
    }
    
    /**
     * generating html
     * @param string $content       content of the pdf file
     * @param string $filename      will be shown as downloaded file
     * @param bool   $is_download   download = true/false
     * @return bool                 true if sucess otherwise false
     */
    public function generate($content, $filename, $is_download)
    {
        // die($content);
        // clear error messgae
        $this->error = null;
        // init phpwkhtmltopdf
        $pdf = new HtmlToPDF($this->options);
        // $pdf = new HtmlToPDF();
        // add content
        $pdf->addPage($content);

        // generate pdf
        $is_success = false;
        if ($is_download) {
            $is_success = $pdf->send($filename);
        } else {
            $is_success = $pdf->send();
        }
        
        if (!$is_success) {
            // update error message
            $this->error = $pdf->getError();
        }
        return $is_success;
    }

    /**
     * get error message from last action
     * @return string       error message
     */
    public function getError()
    {
        return $this->error;
    }
    
}
// use mikehaertl\wkhtmlto\Pdf;

// class Pdf
// {
//     public function __construct() {
//         // $this->_ci = get_instance();
        
//         // $this->load->helper('file');
//     }

//     // public function __get($var) {
//     //     // return get_instance()->controller->$var;
//     // }

//     public function generate($content, $name = 'download.pdf', $output_type = null, $footer = null, $margin_bottom = null, $header = null, $margin_top = null, $orientation = 'P') {

//         $mpdf = new Pdf(array(
//             'binary' => '/bin/wkhtmltopdf',
//             ),
//         );
//          $error = $pdf->getError();
//             echo "$error";
//         echo 'here';
//         $pdf->addPage(base_url().'reports/pdf/profitloss');
//         if (!$pdf->saveAs('/home/omkhan/page.pdf')) {
//             $error = $pdf->getError();
//             echo "$error";
//             // ... handle error here
//         }

//         $pdf->send('name.pdf');
        
//         // // var_dump(($content));
//         // // die();
//         // if (!$output_type) {
//         //     $output_type = 'D';
//         // }
//         // if (!$margin_bottom) {
//         //     $margin_bottom = 10;
//         // }
//         // if (!$margin_top) {
//         //     $margin_top = 20;
//         // }

//         // try {
//         //     // $mpdf = new Mpdf('utf-8', 'A4-' . $orientation, '13', '', 10, 10, $margin_top, $margin_bottom, 9, 9);


//         //     $mpdf->debug = true;
//         //     // $mpdf->autoScriptToLang = true;
//         //     // $mpdf->autoLangToFont = true;
//         //     // $mpdf->setAutoTopMargin = 'stretch';
//         //     // $mpdf->setAutoBottomMargin = 'stretch';
//         //     // if you need to add protection to pdf files, please uncomment the line below or modify as you need.
//         //     // $mpdf->SetProtection(array('print')); // You pass 2nd arg for user password (open) and 3rd for owner password (edit)
//         //     // $mpdf->SetProtection(array('print', 'copy')); // Comment above line and uncomment this to allow copying of content
//         //     // $mpdf->SetTopMargin($margin_top);
//         //     $mpdf->SetTitle($this->_ci->mSettings->sitename);
//         //     $mpdf->SetAuthor($this->_ci->mSettings->sitename);
//         //     $mpdf->SetCreator($this->_ci->mSettings->sitename);
//         //     // $mpdf->SetDisplayMode('fullpage');
//         //     $mpdf->shrink_tables_to_fit = 1;
//         //     // $mpdf->use_kwt = false;
//         //     // $mpdf->SetColumns(2);
//         //     // $stylesheet = file_get_contents(base_url().'assets/dist/css/adminlte.css');
//         //     // $mpdf->WriteHTML($stylesheet,1);
//         //     $stylesheet = file_get_contents(base_url().'assets/dist/css/pdfStyle.css');
//         //     // die($stylesheet);
//         //     $mpdf->WriteHTML($stylesheet,1);
            
//         //     // $mpdf->SetFooter($this->_ci->mSettings->sitename.'||{PAGENO}/{nbpg}', '', TRUE); // For simple text footer

//         //     if (is_array($content)) {
//         //         $mpdf->SetHeader($this->_ci->mSettings->sitename.'||{PAGENO}/{nbpg}', '', TRUE); // For simple text header
//         //         $as = sizeof($content);
//         //         $r = 1;
//         //         foreach ($content as $page) {
//         //             $mpdf->WriteHTML($page['content'],2);

//         //             // @$mpdf->WriteHTML($page['content']);
//         //             if (!empty($page['footer'])) {
//         //                 $mpdf->SetHTMLFooter('<p class="text-center">' . $page['footer'] . '</p>', '', true);
//         //             }
//         //             if ($as != $r) {
//         //                 $mpdf->AddPage();
//         //             }
//         //             $r++;
//         //         }

//         //     } else {
//         //         // $this->strHtml .= $content . "\n";

//         //         $mpdf->WriteHTML($content, 2);
//         //         // $mpdf->WriteHTML('<div class="row"><div class="col-lg-4">4000</div><div class="col-lg-4"><h3>Teste PDF</h3></div><div class="col-lg-4">4000</div></div>');

//         //         // if ($header != '') {
//         //         //     $mpdf->SetHTMLHeader('<p class="text-center">' . $header . '</p>', '', true);
//         //         // }
//         //         // if ($footer != '') {
//         //         //     $mpdf->SetHTMLFooter('<p class="text-center">' . $footer . '</p>', '', true);
//         //         // }
//         //     }


//         //     if ($output_type == 'S') {
//         //         ob_clean();
//         //         $file_content = $mpdf->Output('', 'S');
//         //         write_file('assets/uploads/' . $name, $file_content);
//         //         return 'assets/uploads/' . $name;
//         //     } else {
//         //         // $output_type = 'S';
//         //         ob_clean();

//         //         $html = $mpdf->Output($name, $output_type);
//         //         // var_dump($this->strHtml);
//         //     }
//         // } catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception 
//         //     // name used for catch
//         //     // Process the exception, log, print etc.
//         //     echo $e->getMessage();
//         // }

        
//     }

//     public function merge_PDFs( $files, $output_type ){
//         $pdf = new Mpdf();
//         $pdf->enableImports = true;
//         foreach( $files as $file ){
//             $file = FCPATH. "assets/uploads/pdf/".$file.".pdf";
//             $pdf->SetImportUse();
//             $pagecount = $pdf->SetSourceFile($file);
//             for ($i=1; $i<=($pagecount); $i++) {
//                 $pdf->AddPage();
//                 $import_page = $pdf->ImportPage($i);
//                 $pdf->UseTemplate($import_page);
//             }
//         }

//         $pdf_name = date('Y-m-d_His') . '.pdf';
//         $path = FCPATH . "assets/uploads/pdf/";
//         $pdf_path = $path . $pdf_name;

//         //Make sure path exists
//         if (!file_exists($path)) {
//             mkdir($path, 0777);
//         }

//         if ($output_type == 'F') {
//             ob_clean();
//             $pdf->Output($pdf_path, 'F');
//             unset($pdf);
//             return base_url('assets/uploads/pdf/').$pdf_name;
//         } else {
//             ob_clean();
//             $pdf->Output($pdf_name, 'D');
//         }
//     }
// }

// 

 // defined('BASEPATH') OR exit('No direct script access allowed');

// // require_once APPPATH . "/third_party/MPDF/mpdf.php";

// // require_once FCPATH . "vendor/mpdf/mpdf/src/Mpdf.php";

// // class Pdf extends Mpdf
// // {
// //     public function __construct()
// //     {
// //         parent::__construct();
// //     }
// // }

?>