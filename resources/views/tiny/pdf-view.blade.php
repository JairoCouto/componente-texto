<!DOCTYPE html>
<html lang="pt-BR" class="document-ruler-a4">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
  @page {
    size: A4 portrait;
  }

  body {
    margin-top: 25mm;
    margin-bottom: 15mm;
  }

  .margin-a4 {
    justify-content: space-between;
  }
  
  .mce-content-body {
    font-size: 13px;
    font-family: Arial, Helvetica, sans-serif !important;
    font-style: normal;
    letter-spacing: 0;
    color: #262626;
    line-height: 1.25rem;
  }
  
  .document-ruler-a4 {
    padding: 0 !important;
    width: 100%;
    font-size: 13px;
    font-family: Helvetica,Arial,sans-serif !important;
    font-style: normal;
    letter-spacing: 0
  }
  
  .mce-content-body p {
    margin: 0 !important;
  }

  html.document-ruler-a4 .mce-ruler-pagebreak{
    margin-top: 13mm;
    margin-bottom: 13mm;
    margin-left: -13mm;
    width: calc(100% + 26mm);
    border: 0;
    height: 1px;
    background: #5a8ecb;
  }

  .page-break-after {
    page-break-after: always;
  }

  header {
    position: fixed;
    top: -9mm;
    left: 0px;
    right: 0px;
    bottom: 3mm;
    width: 200mm;
    height: 30mm;
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
  }

  .footer {
    position: fixed;
    left: 0;
    bottom: -6mm;
    height: 30mm;
    width: 200mm;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    line-height: 30mm;
  }
  

  img {
    vertical-align: middle;
    border-style: none;
  }

  .img-fluid {
    max-width: 100%;
    height: auto;
  }

  p {
    margin-top: 0;
    margin-bottom: 0;
  }
  
</style>

<body class="mce-content-body">
    <!-- Image Header -->
    <header>
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHV5F3PJZgH04l5x8d935XWWlfY5wI-bP_oKFvx30PU5Hmtt511DZZjGYOCP6zKpPMGJo&usqp=CAU" alt="" class="img-fluid">
    </header>

    <!-- Body -->
    <div class="margin-a4">
      {!!$html!!}
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHV5F3PJZgH04l5x8d935XWWlfY5wI-bP_oKFvx30PU5Hmtt511DZZjGYOCP6zKpPMGJo&usqp=CAU" alt="" class="img-fluid">
    </div>
 
</body>
</html>