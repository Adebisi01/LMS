<?php 
    require "../config/dompdf/vendor/autoload.php";
    require "../config/functions/pdf_gen.php";
    
    use Dompdf\Dompdf;
    use Dompdf\Options;
    
    $option = new Options;
    // $option->setChroot(__DIR__ .'/../../');
    // $option->setFontDir(__DIR__ .'/../../');
    // $option->setFontCache(__DIR__ .'/../../');
    $option->setIsRemoteEnabled(true);
    
    $dompdf = new Dompdf($option);
    
    if(isset($_POST['start_date'])){
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $report = $_POST['report'];
   
    if($report == 'book'){
            $html = generate_book_pdf($conn, $start_date, $end_date);
    } else if($report == 'subscription'){
        
            $html = generate_subscription_pdf($conn, $start_date, $end_date);
            
    } else if($report == 'book_circulation'){
        
            $html = generate_book_circulation_pdf($conn, $start_date, $end_date);
            
    } else if($report == 'downloads'){
        
            $html = generate_downloads_pdf($conn, $start_date, $end_date);
    }
   
     // Generating pdf 
            $dompdf->loadHtml($html);
            
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            ob_end_clean();
            $dompdf->stream('document', ['Attachment' => 0]);
    }