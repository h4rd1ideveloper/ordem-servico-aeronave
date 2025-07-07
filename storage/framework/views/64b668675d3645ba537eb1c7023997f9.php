 <!DOCTYPE html>
 <html lang="pt-BR">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php echo e($title ?? 'Documento'); ?></title>
     <style>
         @page {
             margin: 0;
             size: A4;
         }

         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
         }

         body {
             font-family: 'Helvetica', sans-serif;
             line-height: 1.2;
             padding: 0;
             margin: 0;
         }

         .page {
             width: 210mm;
             min-height: 297mm;
             margin: 0;
             padding: 1cm;
             border: 2px solid black;
             box-sizing: border-box;
             page-break-after: always;
             position: relative;
             display: flex;
             flex-direction: column;
         }

         .page:last-child {
             page-break-after: avoid;
         }

         .header-section {
             width: 100%;
             min-height: 60px; /* Altura mínima para o cabeçalho */
             margin-bottom: 10px;
             flex-shrink: 0;
             border-bottom: 1px solid #ccc;
             padding-bottom: 10px;
         }

         .content-section {
             flex: 1;
             width: 100%;
             overflow: hidden;
             display: flex;
             flex-direction: column;
         }

         .footer-section {
             width: 100%;
             min-height: 40px; /* Altura mínima para o rodapé */
             margin-top: 10px;
             flex-shrink: 0;
             border-top: 1px solid #ccc;
             padding-top: 10px;
         }

         /* Quebra de página */
         .page-break-avoid {
             page-break-inside: avoid;
         }

         .page-break-before {
             page-break-before: always;
         }

         .page-break-after {
             page-break-after: always;
         }

         /* Estilos específicos para o conteúdo */
         .content-wrapper {
             flex: 1;
             overflow: hidden;
         }

         /* Estilos para tabelas */
         .service-table {
             width: 100%;
             border-collapse: collapse;
             margin-bottom: 20px;
         }

         .service-table td {
             border: 1px solid black;
             padding: 5px;
             vertical-align: top;
         }

         .service-table .item-number {
             width: 5%;
             text-align: center;
             font-weight: bold;
         }

         .service-table .item-description {
             width: 95%;
         }

         /* Estilos para assinatura */
         .signature-section {
             text-align: center;
             margin-top: 30px;
             page-break-inside: avoid;
         }

         .signature-line {
             border-bottom: 1px solid black;
             width: 200px;
             margin: 0 auto 10px auto;
             height: 20px;
         }

         /* Estilos para declaração */
         .declaration-section {
             margin-top: 30px;
             page-break-inside: avoid;
         }

         .declaration-text {
             font-size: 10px;
             text-align: justify;
             margin-bottom: 5px;
         }

         /* Estilos para header e footer */
         .header-table {
             width: 100%;
             border-collapse: collapse;
         }

         .header-table td {
             vertical-align: top;
             padding: 5px;
         }

         .logo-section {
             width: 20%;
         }

         .title-section {
             width: 60%;
             text-align: center;
         }

         .info-section {
             width: 20%;
             text-align: right;
         }

         .footer-center {
             text-align: center;
             font-size: 10px;
         }
     </style>
 </head>

 <body>
     <div class="page">
         <div class="header-section">
             <?php echo $header_content; ?>

         </div>

         <div class="content-section">
             <div class="content-wrapper">
                 <?php echo $__env->yieldContent('content'); ?>
             </div>
         </div>

         <div class="footer-section">
             <?php echo $footer_content; ?>

         </div>
     </div>
 </body>

 </html>
<?php /**PATH /var/www/html/resources/views/layouts/base_pdf_repeated_header_footer.blade.php ENDPATH**/ ?>