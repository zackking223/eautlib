<head>
  <title><?php echo $headTitle ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/png" href="/public/eaut_logo.png" sizes="16x16" />
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />

  <style>
    .hiddenPrint {display: none;}
    .imagePrint {
      max-width: 300px;
      width: 100%;
    }
    @media screen and (max-width: 1000px) {
      .uk-flex {
        flex-direction: column !important;
        gap: 16px;
      }
    }

    @media print {
      .noPrint {
        display: none;
      }
      .hiddenPrint {
        display: block;
      }
      .imagePrint {
        max-width: 160px;
      }
    }
  </style>
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</head>