<style type="text/css">
    /* Google fonts */
    @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700);
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800);
    @import "variables.css";

    /* Global properties (body, common classes, vertical rhythm, structure etc)
/* ========================================================================== */

    body {
        -webkit-backface-visibility: visible !important;
        /* reset animate.css / if hidden parallax buggy */
        background: #ffffff;
        color: #666666;
        /*font-family: 'Open Sans', sans-serif;*/
        font-size: 14px !important;
        line-height: 20px;
        /*overflow-x: hidden;*/
    }

    /* overflow the content area */
    * {
        -ms-word-wrap: break-word;
        word-wrap: break-word;
        /* Prevent Long URL’s From Breaking Out of Container
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    hyphens: auto;
    */
    }

    .barra_superior {
        padding: 1px 0;
        background: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: <?php echo $rs_configuracao['fonte_barra_cabecalho']; ?> !important;
    }

    .barra_superior ul li {
        display: inline;
        margin: 0 15px 0 0;
    }

    .barra_superior .fa-ul {
        margin-bottom: 0;
    }

    .ico {
        position: absolute;
        left: -20px;
        top: 3px;
    }

    @media (min-width: 979px) and (max-width: 1200px) {
        .container {
            padding: 0 20px;
        }

    }

    @media (min-width: 1200px) {
        .container {
            padding: 0 30px;
        }
    }

    @media (max-width: 767px) {
        .container {
            max-width: 620px;
        }
    }

    @media (max-width: 640px) {
        .container {
            max-width: 460px;
        }
    }

    /* Bootstrap Grid Changes */
    /* need more testing before release /

@media (max-width: 991px) {
    [class*="col-md"] + [class*="col-md"] {margin-top: 40px;}
    [class*="col-md"] + [class*="col-md"] {border: solid 1px green;}
}

@media (max-width: 767px) {
    [class*="col-sm"] + [class*="col-sm"] {margin-top: 40px;}
    [class*="col-sm"] + [class*="col-sm"] {border: solid 1px greenyellow;}
}
*/

    /* Layout setting WIDE/BOXED */

    .wide .page-section,
    .boxed .page-section>.container {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .wide .page-section.no-bottom,
    .boxed .page-section.no-bottom>.container {
        padding-bottom: 0;
    }

    .wide .page-section.no-top,
    .boxed .page-section.no-top>.container {
        padding-top: 0;
    }

    .wide .page-section.first,
    .boxed .page-section.first>.container {
        border-top: none;
        padding-top: 0;
    }

    .wide .page-section.last,
    .boxed .page-section.last>.container {
        border-bottom: none;
        padding-bottom: 0;
    }

    .wide .page-section.light,
    .boxed .page-section.light>.container {
        background-color: #f2f4f7;
    }

    .wide .page-section.dark,
    .boxed .page-section.dark>.container {
        background-color: #303739;
        color: #979797;
    }

    .wide .page-section.light-gray,
    .boxed .page-section.light-gray>.container {
        background-color: #F7F7F7;
        border-bottom: 1px solid #eaeaea;
        border-top: 1px solid #eaeaea;
        padding-bottom: 40px;
        padding-top: 40px;
    }

    .wide .page-section.color,
    .boxed .page-section.color>.container {
        background-color: #e5582c;
        color: #f2f4f7;
    }

    .wide .page-section.green,
    .boxed .page-section.green>.container {
        background-color: #22C48A;
        color: #f2f4f7;
    }

    .wide .page-section.green .media-heading,
    .boxed .page-section.green>.container .media-heading {
        color: #ffffff;
    }

    .wide .page-section.green .media-object,
    .boxed .page-section.green>.container .media-object {
        background-color: #ffffff;
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .wide .page-section.green .media:hover .media-object,
    .boxed .page-section.green>.container .media:hover .media-object {
        color: #ffffff;
    }

    /* Full width block */

    .wide .container.full-width {
        width: 100%;
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;

        margin-top: -10px;
        margin-bottom: -40px;

        -webkit-box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 1);
        -moz-box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 1);
        box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 1);
    }

    .boxed .container.full-width {
        padding-left: 0;
        padding-right: 0;

        padding-top: 0;
        padding-bottom: 0;

        margin-top: -40px;
    }


    .wide .container.no-border,
    .boxed .container.no-border {
        border: none;
    }

    .content .widget {}

    .footer .widget {
        position: relative
    }

    .content .widget+.widget,
    .sidebar .widget+.widget,
    .footer .widget+.widget {
        margin-top: 35px;
    }


    /* Owl Slider Team
/* ========================================================================== */
    #owl-team .item {
        border-right: 1px solid #DBDBDB;
        margin: 0;
    }

    #owl-team .owl-item:last-of-type .item {
        border-right: 0px;
    }

    #owl-team .item img {
        display: block;
        width: 100%;
        height: auto;
    }



    /* Flex Slider
/* ========================================================================== */
    .flexslider {
        border: 0;
        border-radius: 0px;
        box-shadow: none;
        margin: 0px;
        max-height: 650px;
    }

    .flex-direction-nav .flex-prev {
        left: 0;
    }

    .flex-direction-nav .flex-next {
        right: 0;
    }

    .flexslider .slides>li {
        max-height: 650px;
    }

    .flexslider .slides>li img {
        max-width: 100%;
    }

    .flex-direction-nav a:before {
        content: none;
        font-size: 0;
    }

    .flex-direction-nav a {
        -webkit-border-radius: 7px;
        border-radius: 7px;
    }

    .flex-direction-nav .flex-prev {
        background: url("<?php echo $siteUrl2; ?>assets/img/large_left.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        font-size: 0;
    }

    .flex-direction-nav .flex-next {
        background: url("<?php echo $siteUrl2; ?>assets/img/large_right.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        font-size: 0;
    }

    /* prettyPhoto
    /* ========================================================================== */

    div.dark_square .pp_left,
    div.dark_square .pp_middle,
    div.dark_square .pp_right,
    div.dark_square .pp_content {
        background: transparent;
    }

    /* Isotope
/* ========================================================================== */

    .isotope .item {
        /* fix isotope/bs3 */
        margin-right: -1px !important;
    }

    @media (max-width: 767px) {
        .isotope-item {
            max-width: 100% !important;
        }
    }

    .no-padding,
    .items.no-padding {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .no-padding .item,
    .items.no-padding .item {
        padding: 0 !important;
        margin: 0 !important;
    }

    .no-padding .item .thumbnail,
    .items.no-padding .item .thumbnail {
        margin: 0 !important;
    }

    /* owl/img-carousel
/* ========================================================================== */

    .img-carousel {}

    .img-carousel .owl-controls {
        margin: 0 auto;
    }

    .img-carousel .owl-pagination {
        position: absolute;
        width: 100%;
        bottom: 0;
    }

    .img-carousel .owl-prev,
    .img-carousel .owl-next {
        position: absolute;
        top: 50%;
        margin-top: -10px !important;
        left: 10px;

        width: 30px;
        height: 30px;
        line-height: 30px;
        text-indent: -9999px;
        white-space: nowrap;
    }

    .img-carousel .owl-next {
        left: auto;
        right: 10px;
    }

    .img-carousel .owl-prev:before,
    .img-carousel .owl-next:before {
        content: "<";
        position: absolute;
        top: 0;
        left: 0;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        text-indent: 0;
    }

    .img-carousel .owl-next:before {
        content: ">";
    }

    /* TYPOGRAPHY
/* ========================================================================== */

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #333333;
        /*font-family: 'Source Sans Pro', sans-serif;*/
        font-weight: 400;
    }


    h1 .fa,
    h2 .fa,
    h3 .fa,
    h4 .fa,
    h5 .fa,
    h6 .fa {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .box1 .fa {
        color: <?php echo $rs_configuracao['cor_titulo_box1']; ?>
    }

    .box2 .fa {
        color: <?php echo $rs_configuracao['cor_titulo_box2']; ?>
    }

    .box3 .fa {
        color: <?php echo $rs_configuracao['cor_titulo_box3']; ?>
    }

    .light h1,
    .light h2,
    .light h3,
    .light h4,
    .light h5,
    .light h6 {}

    .dark h1,
    .dark h2,
    .dark h3,
    .dark h4,
    .dark h5,
    .dark h6 {
        color: #ffffff !important;
    }

    .color h1,
    .color h2,
    .color h3,
    .color h4,
    .color h5,
    .color h6 {
        color: #ffffff !important;
    }

    .section-title {
        position: relative;
        /*text-align: center;*/
        line-height: 1;
        color: <?php echo $rs_configuracao['fonte_navegacao']; ?>;
        margin: 0;
        text-transform: uppercase;
    }

    h1.section-title {
        font-size: 40px;
    }

    h2.section-title {
        font-size: 30px;
    }

    h3.section-title {
        font-size: 30px;
    }

    h4.section-title {
        font-size: 25px;
    }

    h5.section-title {
        font-size: 20px;
    }

    h6.section-title {
        font-size: 15px;
    }

    .section-title div {
        line-height: 0;
    }

    .section-title small {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #FFFFFF;
        display: inline-block;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.1;
        margin-top: 4px;
        padding: 4px 15px;
        text-transform: uppercase;
    }

    .block-title {
        font-size: 12px;
        font-weight: bold;
        line-height: 1;
        margin: 0 0 20px 0;
        padding-bottom: 0px;
        text-transform: uppercase;
    }

    .block-title h4,
    .block-title h3 {
        background-color: transparent;
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
        line-height: 12px;
        margin: 0;
        padding-right: 20px;
        position: relative;
        z-index: 100;
    }

    .block-title h4 {
        font-size: 14px;
        text-transform: uppercase;
    }

    .block-text {
        color: #666666;
        padding: 70px 100px;
        text-align: justify;
    }

    @media (max-width: 1279px) {
        .block-text {
            padding: 35px 50px;
        }
    }

    .block-title small {
        display: block;
        font-weight: 700;
        font-size: 10px;
        line-height: 12px;
        margin: 10px 0;
        text-transform: uppercase;
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .dropcaps {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #FFFFFF;
        display: inline-block;
        float: left;
        font-size: 60px;
        font-weight: 700;
        line-height: 60px;
        margin: 0 20px 10px 0;
        padding: 10px 15px;
    }

    a,
    a:hover,
    a:active,
    a:focus {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
        color: #333333;
    }

    a:hover,
    a:active,
    a:focus {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    ul,
    ol {
        padding-left: 0;
        list-style: none;
    }

    ul ul,
    ol ol,
    ul ol,
    ol ul {
        padding-left: 20px;
    }

    .list-ul {
        padding-left: 0;
    }

    .list-ul li {
        position: relative;
        padding-left: 20px;
    }

    .list-ul .fa {
        position: absolute;
        top: 3px;
        left: 0;
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .list-ul-inline li {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    textarea {
        resize: none;
    }

    a i,
    a:hover i,
    input,
    input:hover,
    input:focus {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    hr {}

    hr.page-divider {
        border-top-color: #dbdbdb;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    @media (min-width: 979px) and (max-width: 1200px) {
        .boxed .page-section hr.page-divider {
            margin-right: -20px;
            margin-left: -20px;
        }
    }

    @media (min-width: 1200px) {
        .boxed .page-section hr.page-divider {
            margin-right: -30px;
            margin-left: -30px;
        }
    }

    hr.page-divider.transparent {
        border-color: transparent;
    }

    hr.page-divider.half {
        border-color: transparent;
        margin-top: 0;
    }

    hr.page-divider.small {
        border-color: transparent;
        margin-top: 0;
        margin-bottom: 20px;
    }

    hr.page-divider.shadowed {
        background: transparent url('<?php echo $siteUrl2; ?>assets/img/article_shadow.png') center top no-repeat;
        border-color: transparent;
        height: 9px;
    }

    .bg-red {
        background-color: #db5959;
    }

    .bg-orange {
        background-color: #eca32f;
    }

    .bg-yellow {
        background-color: #eacb21;
    }

    .bg-green {
        background-color: #1fb981;
    }

    .bg-light-blue {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .bg-blue {
        background-color: #1e77b0;
    }

    .bg-red:hover {
        background-color: #be5151;
    }

    .bg-orange:hover {
        background-color: #d08d2c;
    }

    .bg-yellow:hover {
        background-color: #d1b320;
    }

    .bg-green:hover {
        background-color: #1d9d6d;
    }

    .bg-light-blue:hover {
        background-color: #1f80ab;
    }

    .bg-blue:hover {
        background-color: #1b6699;
    }

    /* Buttons
/* ========================================================================== */

    .btn {
        border-radius: 0px;
    }

    .btn-default {
        color: #ffffff !important;
        background-color: <?php echo $rs_configuracao['cor_botao']; ?> !important;
        border-color: <?php echo $rs_configuracao['cor_botao']; ?> !important;
    }

    .btn-default:hover,
    .btn-default:focus,
    .btn-default:active,
    .btn-default.active,
    .open .dropdown-toggle.btn-default {
        color: #ffffff;
        background-color: <?php echo $rs_configuracao['cor_botao_hover']; ?>;
        border-color: <?php echo $rs_configuracao['cor_botao_hover']; ?>;
    }

    .btn-default:active,
    .btn-default.active,
    .open .dropdown-toggle.btn-default {
        background-image: none;
    }

    .btn-default.disabled,
    .btn-default[disabled],
    fieldset[disabled] .btn-default,
    .btn-default.disabled:hover,
    .btn-default[disabled]:hover,
    fieldset[disabled] .btn-default:hover,
    .btn-default.disabled:focus,
    .btn-default[disabled]:focus,
    fieldset[disabled] .btn-default:focus,
    .btn-default.disabled:active,
    .btn-default[disabled]:active,
    fieldset[disabled] .btn-default:active,
    .btn-default.disabled.active,
    .btn-default[disabled].active,
    fieldset[disabled] .btn-default.active {
        background-color: #d99f56;
        border-color: #d99f56;
        color: #ffffff;
    }

    .btn-default .badge {
        color: #ffffff;
        background-color: #04bf8f;
    }

    .btn-warning {
        border-color: #d58512;
    }

    /* Form / Input / Textarea
/* ========================================================================== */

    .form-control {
        -webkit-border-radius: 0px;
        border-radius: 0px;
        border: 1px solid #dbdbdb;
        font-size: 13px;
        -webkit-appearance: none;
        /* ios */
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .makeorder input[type="text"] {
        border: 2px solid #dbdbdb;
        color: #7d7d7d;
        float: left;
        font-size: 14px;
        margin: 0 0 5px;
        padding: 5px 10px;
        width: 100%;
    }

    .ie8 input.form-control {
        line-height: 32px;
        padding: 0 12px;
    }

    .form-control:focus {
        border-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        -webkit-appearance: none;
        /* ios */
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .input-group-addon {
        border-radius: 0;
        border-color: #e9ecef;
        background-color: #ffffff;
    }

    .error {
        color: #ff0000;
    }

    /* Price table
/* ========================================================================== */

    .price-table {
        background-color: #FFFFFF;
        border: 1px solid #DBDBDB;
        margin: 0 auto 20px;
        max-width: 400px;
        text-align: center;
    }

    .price-table-header {
        margin-bottom: 0px;
    }

    .price-label {
        padding-bottom: 0px;
    }

    .price-label-title {
        background-color: #1F80AB;
        color: #FFFFFF;
        font-size: 16px;
        font-weight: 400;
        margin: 0;
        padding-bottom: 20px;
        padding-top: 20px;
        text-transform: uppercase;
    }

    .price-value {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #ffffff;
        display: inline-block;
        padding: 30px 0;
        position: relative;
        width: 100%;
    }

    .price-number {
        display: inline-block;
        font-size: 50px;
        line-height: 50px;
    }

    .price-unit {
        display: inline-block;
        font-size: 40px;
        line-height: 40px;
    }

    .price-per {
        display: block;
        font-size: 16px;
        font-style: italic;
        line-height: 16px;
        margin-top: 20px;
    }

    .price-description {
        padding-bottom: 30px;
    }

    .price-table-row {
        height: 44px;
        line-height: 44px;
    }

    .price-table-row:nth-child(2n) {}

    /*.price-table-row + .price-table-row {*/
    .price-table-row {
        border-bottom: 1px solid #eaeaea;
    }

    .price-table-row-bottom {
        line-height: 70px;
    }

    .price-table-row-bottom .btn-default {
        border-width: 0px;
    }

    .price-table.table-red .btn,
    .price-table.table-red .price-value {
        background-color: #db5959;
    }

    .price-table.table-red .btn:hover,
    .price-table.table-red .price-label-title {
        background-color: #be5151;

    }

    .price-table.table-orange .btn,
    .price-table.table-orange .price-value {
        background-color: #eca32f;
    }

    .price-table.table-orange .btn:hover,
    .price-table.table-orange .price-label-title {
        background-color: #d08d2c;

    }

    .price-table.table-yellow .btn,
    .price-table.table-yellow .price-value {
        background-color: #eacb21;
    }

    .price-table.table-yellow .btn:hover,
    .price-table.table-yellow .price-label-title {
        background-color: #d1b320;

    }

    .price-table.table-green .btn,
    .price-table.table-green .price-value {
        background-color: #1fb981;
    }

    .price-table.table-green .btn:hover,
    .price-table.table-green .price-label-title {
        background-color: #1d9d6d;
    }

    /* Progress bars
/* ========================================================================== */

    .progress {
        -webkit-border-radius: 0px;
        border-radius: 0px;
        -webkit-box-shadow: none;
        box-shadow: none;
        height: 35px;
        margin-bottom: 10px;
    }

    .progress-bar {
        line-height: 35px;
        text-align: left;
    }

    .progress-bar span {
        display: block;
        float: left;
        padding: 0 10px;
        background-color: #4d595b;
        -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
        -webkit-transition: width .6s ease;
        transition: width .6s ease;
    }

    .charts {
        text-align: center;
    }

    .charts {
        margin-bottom: -40px;
    }

    .charts .chart {
        margin-bottom: 40px;
    }

    .chart {
        position: relative;
        text-align: center;
        width: 100%;
    }

    .chart canvas {
        display: inline-block;
    }

    .percent {
        display: block;
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        z-index: 2;
        font-size: 24px;
        line-height: 24px;
        height: 24px;
        margin-top: -12px;
        font-weight: 700;
        color: #3c4547;
    }

    /* Header
/* ========================================================================== */
    .header {
        /*box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
position: fixed;*/
        width: 100%;
        border-bottom: 2px solid #ccc;
        position: fixed;
        top: 0;
        z-index: 999;
        background: <?php echo $rs_configuracao['fundo_cabecalho']; ?> !important;
    }

    .sticky-wrapper,
    .sticky-wrapper.is-sticky {
        z-index: 1000;
    }

    .sticky-wrapper .header {
        width: 100%;
        z-index: 1000;
    }

    .wide .header,
    .boxed .header>.container {
        background-color: #ffffff;
    }

    .wide .header,
    .boxed .header>.container:first-child {
        /*padding-top: 10px;*/
        /*padding-bottom: 10px;*/
    }

    .logo {
        margin: 3px 0 3px 0;
    }

    @media (max-width: 359px) {
        .logo {
            width: 70%;
        }
    }

    .navigation {}

    @media (max-width: 767px) {
        .navigation {
            display: none;
        }
    }

    #top_shadow {
        background: url("<?php echo $siteUrl2; ?>assets/img/shadow.png") repeat-x scroll center top rgba(0, 0, 0, 0);
        height: 30px;
        left: 0;
        position: absolute;
        right: 0;
        /*top: 160px;*/
        z-index: 9;
    }

    @media (max-width: 1023px) {
        #top_shadow {
            top: 120px;
        }
    }

    @media (max-width: 1023px) {
        #top_shadow {
            top: 98px;
        }
    }

    @media (max-width: 767px) {
        #top_shadow {
            top: 80px;
        }
    }

    /* superfish skin */
    .sf-menu {
        float: none;
        margin-bottom: 0;
        background: <?php echo $rs_configuracao['fundo_menu_top']; ?> !important;
        text-align: right;
    }

    .sf-menu ul {
        box-shadow: 2px 2px 6px rgba(0, 0, 0, .2);
        min-width: 12em;
        /* allow long menu items to determine submenu width */
        *width: 12em;
        /* no auto sub width for IE7, see white-space comment below */
    }

    .sf-menu>li {
        display: inline-block;
        float: none;
        text-align: center;
    }

    .sf-menu>li.logo img {
        margin: 0 15px;
    }

    @media (max-width: 1023px) {
        .sf-menu>li.logo img {
            margin: 0px;
        }
    }

    .sf-menu a {}

    @media (min-width: 768px) and (max-width: 991px) {
        .sf-menu a {
            padding-right: 20px;
        }
    }

    .sf-menu li,
    .sf-menu ul li,
    .sf-menu ul ul li {
        background: #ffffff;
    }

    .sf-menu li:hover,
    .sf-menu li.sfHover {
        background-color: #ffffff;
        color: #000000;
    }

    .sf-menu li:hover>a,
    .sf-menu li.sfHover>a {
        color: #000000;
    }

    .sf-menu>li {
        padding-bottom: 17px;
        padding-top: 17px;

    }

    .sf-menu>li:hover,
    .sf-menu>li.sfHover {}

    .sf-menu>li>a {
        border: 2px solid #ffffff;
        border-radius: 5px;
        color: <?php echo $rs_configuracao['fonte_menu_top']; ?> !important;
        display: block;
        font-size: 12px;
        margin-left: 10px;
        padding: 4px 10px;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
    }

    .sf-menu>li .title {
        bottom: 15px;
        left: 20px;
        position: absolute;
    }

    .sf-menu>li>a .icon {
        display: block;
        position: relative;
        text-align: center;
        top: -10px;
    }

    .sf-menu>li a i {
        box-shadow: 0 0 0 30px rgba(0, 0, 0, 0);
        display: inline-block;
        margin: 0 auto;
        position: relative;
        transform: translate3d(0px, 0px, 0px);
        transition: box-shadow 0.6s ease-in-out 0s;
    }

    .sf-menu>li a .icon i {
        background: none repeat scroll 0 0 rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        font-size: 26px;
        padding: 10px 0;
        width: 46px;
    }

    .sf-menu>li a:hover i {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.2);
        transition: box-shadow 0.4s ease-in-out 0s;
    }

    .sf-menu>li:hover>a,
    .sf-menu>li.sfHover>a,
    .sf-menu>li>a:hover,
    .sf-menu>li.active>a:hover,
    .sf-menu>li.active>a {
        background-color: <?php echo $rs_configuracao['fundo_menu_top']; ?> !important;
        border-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: <?php echo $rs_configuracao['fonte_menu_top_hover']; ?> !important;
        text-transform: uppercase;
    }

    .sf-menu>li.active>a {}

    .sf-menu>li.active>a:focus {
        color: #ffffff;
    }

    .sf-menu li:hover>a:before,
    .sf-menu li.sfHover>a:before {
        background-color: #ffffff;
    }

    .sf-menu li,
    .sf-menu li:hover,
    .sf-menu li.sfHover {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .sub-menu a {
        padding: .1em .1em;
        color: <?php echo $rs_configuracao['fonte_menu_top']; ?> !important;
        border: none;
    }

    .sf-menu .sub-menu {
        background: none repeat scroll 0 0 <?php echo $rs_configuracao['fundo_menu_top']; ?> !important;
        border-radius: 0px;
        border-top: 1px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
        display: none;
        left: 0;
        list-style: none outside none;
        padding: 10px 15px;
        position: absolute;
        text-align: left;
        width: 160px;
        z-index: 20;
    }

    /*.sf-menu .sub-menu:before {
    border-bottom: 5px solid #37404B;
    border-left: 5px solid rgba(0, 0, 0, 0);
    border-right: 5px solid rgba(0, 0, 0, 0);
    content: " ";
    height: 0;
    left: 50%;
    margin-left: -5px;
    position: absolute;
    top: -5px;
    width: 0;
}*/

    .sf-menu .sub-menu li {
        background-color: transparent;
        margin: 0;
        padding: 0px;
    }

    .sub-menu li a {
        border-bottom: 1px solid #ebebeb;
        color: <?php echo $rs_configuracao['fonte_menu_top']; ?> !important;
        display: block;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        margin: 0;
        padding: 8px 0px;
        text-transform: capitalize;
    }

    .sub-menu li:last-child a {
        border-bottom: 0;
    }

    .sub-menu li a:hover,
    .sub-menu li.active a {
        background-color: <?php echo $rs_configuracao['fundo_menu_top']; ?> !important;
        color: <?php echo $rs_configuracao['fonte_menu_top_hover']; ?> !important;
        text-decoration: none;
    }

    .sub-menu li a:before {
        content: none;
    }

    .sub-menu .sub-menu {
        margin-top: -2px;
    }

    .sub-menu .sub-menu:before {
        content: none;
    }

    /* Additional */
    .additional {
        color: #DBDBDB;
        font-size: 11px;
        padding: 5px 10px;
        margin-top: 5px;
        text-transform: uppercase;
        /*background: #333333;*/
    }

    .additional ul {
        display: block;
    }

    .additional ul.ul-top {
        border-bottom: 1px dashed <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        padding-bottom: 10px;
    }

    .additional a {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .additional a:hover {
        color: #eebd30;
    }

    .additional .ul-cart a {
        color: #ffffff;
        font-weight: bold;
    }

    .additional .ul-cart a:hover {
        color: #eebd30;
    }

    .additional .ul-cart a>span {
        padding-left: 12px;
    }

    .additional ul li {
        display: inline-block;
        padding: 0 14px;
        position: relative;
    }

    .additional ul li:first-child {
        padding-left: 0;
    }

    .additional ul li:last-child {
        padding-right: 0;
    }

    .additional ul li:after {
        border-left: 1px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        content: "";
        display: block;
        height: 8px;
        left: 0;
        position: absolute;
        top: 3px;
        width: 1px;
    }

    .additional ul li:first-child:after {
        border-left: 0;
    }

    @media (max-width: 1200px) {
        .sf-menu>li>a {}
    }

    @media (max-width: 1023px) {
        .sf-menu>li>a {}

        .sf-menu>li .title {}

        .logo {}
    }

    @media (max-width: 767px) {
        .logo {}
    }

    /*** arrows (for all except IE7) **/
    .sf-arrows .sf-with-ul {
        padding-right: 20px;
        *padding-right: 2em;
        /* no CSS arrows for IE7 (lack pseudo-elements) */
    }

    /* styling for both css and generated arrows */
    .sf-arrows .sf-with-ul:after {
        border: medium none;
        content: "\f107";
        font-family: "FontAwesome";
        height: 0;
        margin-right: 10px;
        padding-right: 10px;
        position: absolute;
        right: -7px;
        top: 7px;
        width: 0;
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .sf-menu a:before {
            margin-right: 5px;
        }

        .sf-menu a {
            padding: 0 5px;
        }

        .sf-arrows .sf-with-ul {
            padding-right: 5px;
        }

        .sf-arrows .sf-with-ul:after {
            display: none;
        }
    }

    .sf-arrows>li>.sf-with-ul:focus:after,
    .sf-arrows>li:hover>.sf-with-ul:after,
    .sf-arrows>.sfHover>.sf-with-ul:after {
        border-top-color: white;
        /* IE8 fallback colour */
    }

    /* styling for right-facing arrows */
    .sf-arrows ul .sf-with-ul:after {
        margin-top: -5px;
        margin-right: -3px;
        border-color: transparent;
        border-left-color: #979797;
        /* edit this to suit design (no rgba in IE8) */
        border-left-color: rgba(151, 151, 151, 0.50);
    }

    .sf-arrows ul li>.sf-with-ul:focus:after,
    .sf-arrows ul li:hover>.sf-with-ul:after,
    .sf-arrows ul .sfHover>.sf-with-ul:after {
        border-left-color: white;
    }

    /* Mobile menu
/* ========================================================================== */

    #mobile-menu {
        display: none;
        position: relative;
    }

    .mobile-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
        height: 40px;
        /* Required for IE 5, 6, 7 */
        /* ...or something to trigger hasLayout, like zoom: 1; */
        width: 100%;
        /* Theoretically for IE 8 & 9 (more valid) */
        /* ...but not required as filter works too */
        /* should come BEFORE filter */
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        /* This works in IE 8 & 9 too */
        /* ... but also 5, 6, 7 */
        filter: alpha(opacity=0);
        /* Older than Firefox 0.9 */
        -moz-opacity: 0;
        /* Safari 1.x (pre WebKit!) */
        -khtml-opacity: 0;
        /* Modern!
    /* Firefox 0.9+, Safari 2?, Chrome any?
    /* Opera 9+, IE 9+ */
        opacity: 0;
    }

    .mobile-menu-title {
        font-size: 12px;
        line-height: 40px;
        margin-top: 28px;
        text-transform: uppercase;
    }

    @media (max-width: 767px) {
        #mobile-menu {
            display: block;
            float: right;
        }

        .mobile-menu {
            display: block;
            margin-top: 28px;
        }

    }

    @media (max-width: 767px) {
        .mobile-menu {
            margin-top: 22px;
        }

        .mobile-menu-title {
            margin-top: 22px;
        }
    }

    /* Blog / Post
/* ========================================================================== */

    .post-wrap {}

    .post-wrap+.post-wrap {
        margin-top: 45px;
        padding-top: 45px;
    }

    .post-masonry .post-wrap+.post-wrap {
        margin-top: 0;
        border-top: none;
        padding-top: 0;
    }

    .post-masonry .post-wrap {
        margin-bottom: 40px;
    }

    .post-header {
        margin-bottom: 15px;
    }

    .post-meta {
        color: rgba(100, 100, 100, 0.4);
        font-size: 13px;
        line-height: 20px;
        margin-bottom: 12px;
        margin-top: 6px;
    }

    .post-wrap .post-meta {}

    .post-meta a {
        color: #777777;
    }

    .post-meta a:hover {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .post-meta .sep:before {
        content: "\2022";
        color: #ffffff;
        margin: 0 0px;
    }

    .post-date {}

    .post-wrap .post-author,
    .post-wrap .post-comment,
    .post-wrap .post-date {
        color: #777777;
        padding: 1px 5px;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .post-media {
        margin-bottom: 20px;
        position: relative;
    }

    .post-media .thumbnail {
        margin-bottom: 0;
    }

    .post-body {}

    .post-excerpt {
        margin-bottom: 20px;
    }

    .post-details {}

    .post-title {
        font-size: 12px;
        font-weight: 400;
        letter-spacing: -1px;
        /*line-height: 44px;*/
        margin: 5px 0 5px 0;
    }

    .post-footer {
        margin-top: 30px;
    }

    .post-footer .readmore-link {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .post-footer .readmore-link:hover {
        color: #333333;
    }

    .post-footer .socical-line {
        margin-top: 3px;
    }

    .post-categories,
    .post-tags {
        display: block;
        font-size: 14px;
        line-height: 35px;
        margin-bottom: 2px;
    }

    .post-categories .fa,
    .post-tags .fa {
        margin-right: 5px;
    }

    .post-categories a,
    .post-tags a {
        border: 1px solid #DBDBDB;
        color: #888888;
        font-size: 13px;
        margin: 0 8px 8px 0;
        padding: 5px 12px;
    }

    .post-categories a:hover,
    .post-tags a:hover {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #FFFFFF;
    }

    .about-the-author {
        margin-bottom: 5px;
        margin-top: 30px;
        padding-top: 10px;
        padding-left: 10px;
        background: #FFF;
    }

    .about-the-author .media>.pull-left {
        margin-right: 10px;
    }

    .about-the-author .media-heading {
        font-size: 16px;
        font-weight: 400;
    }

    .about-the-author .media-body {
        padding-top: 0;
    }

    .about-the-author .media {
        border: 0;
    }

    /* Video Wrapper */
    .video-wrap {
        position: relative;
        padding-bottom: 56.25%;
        /* 16:9 */
        padding-top: 25px;
        height: 0;
    }

    .video-wrap iframe,
    .video-wrap object,
    .video-wrap embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Comments
/* ========================================================================== */

    .comments {
        margin-top: 45px;
        padding-top: 45px;
    }

    .comments>.comment:last-child .comment-reply {
        border: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .comments .media-body {
        padding-top: 0;
    }

    .comment {
        background-color: #FFFFFF;
        padding: 30px;
    }

    .comment .comment {
        padding: 10px 10px 10px 0px;
    }

    .comment-avatar {}

    @media (max-width: 479px) {
        .comment-avatar img {
            width: 64px;
            height: auto;
        }
    }

    .comment-meta {
        margin-bottom: 5px;
    }

    .comment-author {}

    .comment-date {
        color: #999999;
        font-size: 11px;
        line-height: 20px;
    }

    .comment-text {
        margin-bottom: 20px;
    }

    .comment-reply {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        font-size: 11px;
        line-height: 11px;
        margin-bottom: 20px;
        padding-left: 10px;
    }

    .comment-reply:hover {
        color: #1F80AB;
    }

    .comments-form {
        margin-top: 45px;
        padding-top: 45px;
    }

    .comment-author {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        display: block;
        font: 400 13px/20px "Source Sans Pro";
        margin-top: -5px;
        text-transform: uppercase;
    }

    .comment-author:hover {
        color: #1F80AB;
        display: block;
        font: 400 13px/20px "Source Sans Pro";
        margin-top: -5px;
        text-transform: uppercase;
    }

    /* Sidebar / Content
/* ========================================================================== */

    .sidebar {}

    .sidebar .widget .title {
        color: #999999;
        font-size: 18px;
        font-weight: 400;
        line-height: 20px;
        margin-bottom: 24px;
        margin-top: 0px;
    }

    .sidebar .widget a {
        color: #666666;
    }

    .sidebar .widget a:hover {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .sidebar .btn-search {
        color: #ffffff;
        height: 34px;
        position: absolute;
        right: 15px;
        top: 0;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        width: 34px;
    }

    .sidebar .widget .pages,
    .sidebar .widget .categories {
        padding-left: 0px;
    }

    .sidebar .widget .pages li,
    .sidebar .widget {
        border-bottom: 1px dashed #999;
        padding-left: 0px;
        position: relative;
        padding-bottom: 20px;
    }

    .sidebar .widget .pages li:last-child,
    .sidebar .widget .categories li:last-child {
        border-bottom: 0;
    }

    .sidebar .widget .pages a:hover,
    .sidebar .widget .categories a:hover {}

    .sidebar .widget .pages a:before,
    .sidebar .widget .categories a:before {
        /*color: #cccccc;
    content: "\f105";
    font-family: "FontAwesome";
    font-size: 10px;
    left: 0px;
    position: absolute;
    top: 0px;*/

    }

    .sidebar .widget .pages a:hover:before,
    .sidebar .widget .categories a:hover:before {
        color: #FBBA0E;
    }

    .sidebar .widget .pages a,
    .sidebar .widget .categories a {
        line-height: 30px;
        font-weight: bold;
    }

    .sidebar .widget .pages li:hover a,
    .sidebar .widget .categories li:hover a {
        padding-left: 0px;
    }

    .category,
    .sub-category {
        border: 0;
        padding-left: 5px;
        position: relative;
    }

    .category {
        padding-bottom: 5px;
    }

    .category a,
    .sub-category a {
        display: block;
        width: auto;
        line-height: 25px !important;
    }

    .category>a {
        text-transform: uppercase;
        color: #000 !important;
        cursor: pointer;
    }

    .category a:active,
    .category a:focus {
        text-decoration: none;
    }

    .category>a:after {
        padding-left: 5px;
    }

    .category>a.expandir:after {
        content: "+";
    }

    .category>a.fechar:after {
        content: "-";
    }

    .category a:hover {
        background: <?php echo $rs_configuracao['cor_hover_menu_lateral']; ?> !important;
    }

    .sub-categories {
        padding-left: 0 !important;
        /*max-height: 0;
	display:none;*/
        overflow: hidden;
        -webkit-transition: all 1s;
        -moz-transition: all 1s;
        transition: all 1s;
    }

    .sub-categories2 {
        padding-left: 15px !important;
        /*max-height: 0;*/
        display: none;
        overflow: hidden;
        -webkit-transition: all 1s;
        -moz-transition: all 1s;
        transition: all 1s;
    }

    .sub-categories3 {
        padding-left: 30px !important;
        /*max-height: 0;*/
        display: none;
        overflow: hidden;
        -webkit-transition: all 1s;
        -moz-transition: all 1s;
        transition: all 1s;
    }

    .sub-category a {
        text-transform: capitalize;
    }

    .sub-category1 a {
        text-transform: capitalize;
    }

    .sub-category a:hover {
        cursor: pointer;
    }

    .sub-category1 a:hover {
        cursor: pointer;
    }

    .sub-category a:before {
        content: "-";
        padding-right: 5px;
    }

    .sub-category1 a:before {
        content: "";
    }

    .sub-category3 a:before {
        content: "-";
        padding-right: 5px;
    }

    a.active-category {
        padding-left: 10px !important;
        font-weight: bold;
        color: #FBBA0E !important;
    }


    .category a:hover,
    .sub-category a:hover {
        padding-left: 10px !important;
        background-color: #FBBA0E;
        color: white !important;
        text-decoration: none !important;
    }

    .sub-category a:hover:before {
        color: white !important;
    }

    .sidebar .widget .form-group:last-of-type {
        margin-bottom: 0;
    }

    /* Breadcrumbs
/* ========================================================================== */

    .breadcrumb>.active {
        color: <?php echo $rs_configuracao['fonte_navegacao']; ?> !important;
    }

    .wide .page-section.breadcrumbs,
    .boxed .page-section.breadcrumbs>.container {
        background-color: <?php echo $rs_configuracao['fundo_navegacao']; ?>;
        color: <?php echo $rs_configuracao['fonte_navegacao']; ?>;
        padding: 20px 0;
        position: relative;
    }

    .wide .page-section.breadcrumbs>.container,
    .boxed .page-section.breadcrumbs>.container {
        position: relative;
        z-index: 15;
    }

    .breadcrumbs h2.section-title {
        font-size: 18px;
    }

    .breadcrumbs .breadcrumb {
        background-color: transparent;
        display: block;
        font-size: 14px;
        margin-bottom: 0;
        padding: 00px 0 0 0;
    }

    .breadcrumbs .breadcrumb li {
        margin-bottom: 0px;
    }

    .breadcrumbs .breadcrumb a {
        color: <?php echo $rs_configuracao['fonte_navegacao']; ?>;
    }

    .breadcrumbs .breadcrumb a:hover {
        color: #fff;
    }

    /* Pagination / Pager
/* ========================================================================== */

    .pagination {
        margin: 0;
    }

    .pagination>li>a {
        background-color: #1F80AB;
        background-color: rgba(31, 128, 171, 0.5);
        border: 0;
        color: #ffffff;
        margin-right: 2px;
        padding: 7px 14px;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span,
    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        border-radius: 0;
    }

    .pagination>li>a,
    .pagination>li>span {}

    .pagination>.disabled>span,
    .pagination>.disabled>span:hover,
    .pagination>.disabled>span:focus,
    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        background-color: #1F80AB;
        background-color: rgba(31, 128, 171, 0.5);
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover,
    .pagination>li>a:focus,
    .pagination>li>span:focus {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #ffffff;
    }

    .pagination>.active>a,
    .pagination>.active>span,
    .pagination>.active>a:hover,
    .pagination>.active>span:hover,
    .pagination>.active>a:focus,
    .pagination>.active>span:focus {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        font-weight: 700;
    }

    .pager {
        margin: 0;
    }

    /* Tabs
/* ========================================================================== */

    .nav-tabs {
        border-bottom: 1px solid #DBDBDB;
    }

    .nav-tabs>li>a {
        background-color: transparent;
        border: 1px solid #dbdbdb;
        border-right: 0;
        border-radius: 0;
        margin-right: 0;
    }

    .nav-tabs>li>a:hover {
        background-color: transparent;
        border-top: 1px solid #000000;
        color: #666666 !important;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
        border-top: 1px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-right: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        color: #666666;
    }

    .nav-tabs>li.active:last-child>a,
    .nav-tabs>li:last-child>a {
        border-right: 1px solid #dbdbdb;
    }

    .tab-content {
        padding-top: 15px;
        border: 1px solid #dbdbdb;
        border-top: 0;
        padding: 15px 15px 0;
    }

    .home-title {
        border-bottom: 2px solid #cf4429;
        color: #000;
        margin-bottom: 15px;
        padding-bottom: 15px;
        text-align: left;
        text-transform: uppercase;
    }

    @media (min-width:768px) and (max-width: 1023px) {
        .nav-tabs>li>a {
            padding: 10px 5px;
        }
    }

    /* Message
/* ========================================================================== */

    .page-section.with-sidebar .content .page-section>.container {
        width: 100%;
    }

    .wide .page-section.message,
    .boxed .page-section.message>.container {
        padding: 40px 40px 40px 40px;
        text-transform: uppercase;
        text-align: center;
        background-color: #242424;
        color: #ffffff;
    }

    .page-section.message h1 {
        font-size: 40px;
        line-height: 40px;
        margin-bottom: 20px;
        font-weight: 700;
        color: #ffffff;
    }

    .page-section.message p {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .page-section.message *:last-child {
        margin-bottom: 0;
    }

    .page-section.message .btn {
        padding-left: 30px;
        padding-right: 30px;
        margin-right: 20px;
        margin-bottom: 20px;
    }

    /* Tagcloud
/* ========================================================================== */

    .tagcloud {
        overflow: hidden;
    }

    .tagcloud li {
        float: left;
        margin: 0 8px 8px 0;
    }

    .tagcloud a {
        border: 1px solid #DBDBDB;
        color: #FFFFFF;
        display: block;
        padding: 5px 12px;
    }

    .tagcloud a:hover {
        background-color: transparent;
        color: #000000;
    }

    .sidebar .tagcloud a {
        color: #888888;
    }

    .sidebar .tagcloud a:hover {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #ffffff;
    }

    /* Accordion / Panel group
/* ========================================================================== */

    .panel {
        border: 0;
        border-bottom: 1px solid #eaeaea;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .panel-heading {
        padding: 0;
    }

    .panel-group .panel {
        border-radius: 0;
    }

    .panel-group .panel-heading a:before {
        color: #EAEAEA;
        content: "\f107";
        font-family: "FontAwesome";
        font-size: 22px;
        left: 13px;
        line-height: 10px;
        padding: 0 7px;
        position: absolute;
        top: 36%;
    }

    .panel-group .panel-heading a.collapsed:before {
        content: "\f105";
    }

    .panel-group .panel-heading a {
        background-color: rgba(0, 0, 0, 0);
        border: 0;
        border-radius: 0;
        color: #333333;
        display: block;
        font-size: 15px;
        font-weight: 400;
        padding: 15px 45px;
        position: relative;
    }

    .panel-group .panel-heading a.collapsed {
        background-color: #FFFFFF;
        color: #000000;
    }

    .panel-group .panel-heading a.collapsed:hover {
        background-color: #FFFFFF;
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .panel-group .panel-heading+.panel-collapse .panel-body {
        background-color: #FFFFFF;
    }

    .panel-group .panel+.panel {
        margin-top: 0;
    }

    .panel-default>.panel-heading {
        background-color: #FFFFFF;
        border: 0;
        border-radius: 0px;
    }

    .panel-collapse .panel-body {
        border-top: none !important;
        /*border-bottom: none !important;*/
    }

    .panel-group .panel+.panel {
        margin-top: 0px;
    }

    /* Thumbnails
/* ========================================================================== */

    .thumbnail {
        border: 0;
        border-radius: 0;
        margin-bottom: 30px;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    .item>.img-responsive,
    .thumbnail>.img-responsive {
        width: 100%;
    }

    .thumbnail.hover,
    .thumbnail:hover {
        border: solid 0px <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        /*-webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.3);*/
        /*box-shadow: 0 1px 2px 0 rgba(0,0,0,0.3);*/
    }

    .thumbnail .overflowed {
        margin-bottom: 20px;
        border-bottom: solid 0px #e9ecef;
    }

    .thumbnail .overflowed .img-responsive {
        width: 100%;
    }

    .thumbnail.no-border,
    .thumbnail.no-border.hover,
    .thumbnail.no-border:hover {
        border: none;
    }

    .thumbnail .progress {
        margin-bottom: 5px;
    }

    /* Thumbnail caption */

    .do-hover .caption {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        height: 100%;
        width: 100%;
        text-align: center;
        overflow: hidden;
        padding: 15px;
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        background-color: rgba(33, 158, 203, 0.3);
        color: #ffffff;
        opacity: 0;
    }

    .ie8 .do-hover .caption {
        background: transparent;
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#4Cf26daf,endColorstr=#4Cf26daf)";
        /* IE8 */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#4Cf26daf, endColorstr=#4Cf26daf);
        /* IE6 & 7 */
        zoom: 1;
    }

    .projects .do-hover .caption {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        background-color: rgba(33, 158, 203, 0.5);
    }

    .ie8 .projects .do-hover .caption {
        background: transparent;
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#7Ff26daf,endColorstr=#7Ff26daf)";
        /* IE8 */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#7Ff26daf, endColorstr=#7Ff26daf);
        /* IE6 & 7 */
        zoom: 1;
    }

    .caption-wrapper {
        width: 100%;
    }

    .caption-inner {}

    .do-hover .caption-title {
        font-weight: 700;
        margin-top: 0;
        color: #ffffff;
    }

    .do-hover .caption-buttons a,
    .do-hover .caption-category a {
        color: #ffffff;
    }

    .do-hover .caption-buttons a {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-radius: 100%;
        padding: 9px 12px;
    }

    .do-hover .caption-buttons a:hover {
        background-color: #1F80AB;
    }

    .latest-news .img-wrap .btn {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-radius: 100%;
        padding: 9px 12px;
    }

    .latest-news .img-wrap .btn:hover {
        background-color: #1F80AB;
    }

    /* Thumbnail caption hover animation */

    .do-hover.hover .caption,
    .do-hover:hover .caption {
        opacity: 1;
        /* !!! */
    }

    .do-hover:hover .img-responsive {
        -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
    }

    /* Caption title */

    .do-hover .caption-title {
        -webkit-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        transform: translateY(-100%);
    }

    .do-hover.hover .caption-title,
    .do-hover:hover .caption-title {
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
    }

    /* Caption category */

    .do-hover .caption-category {
        -webkit-transform: translateY(100%);
        -ms-transform: translateY(100%);
        transform: translateY(100%);
    }

    .do-hover.hover .caption-category,
    .do-hover:hover .caption-category {
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
    }

    .do-hover .caption-zoom,
    .do-hover .caption-social,
    .do-hover .caption-link {
        border: solid 0px #ffffff;
        margin-right: 1px;
    }

    .do-hover .caption-zoom .fa,
    .do-hover .caption-social .fa,
    .do-hover .caption-link .fa {
        font-size: 14px;
        line-height: 14px;
        height: 14px;
        width: 14px;
        text-align: center;
    }

    .do-hover .caption-zoom:hover,
    .do-hover .caption-link:hover,
    .do-hover .caption-social:hover {}

    /* Caption zoom */

    .do-hover .caption-zoom {
        -webkit-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        transform: translateX(-100%);
    }

    .do-hover.hover .caption-zoom,
    .do-hover:hover .caption-zoom {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0);
    }

    .do-hover .caption-zoom.theone {
        -webkit-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        transform: translateY(-100%);
    }

    .do-hover.hover .caption-zoom.theone,
    .do-hover:hover .caption-zoom.theone {
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
    }

    /* Caption link */

    .do-hover .caption-link {
        -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
        transform: translateX(100%);
    }

    .do-hover.hover .caption-link,
    .do-hover:hover .caption-link {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0);
    }

    /* Caption social */

    .do-hover .caption-social {
        -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
    }

    .do-hover.hover .caption-social,
    .do-hover:hover .caption-social {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    /* Thumbnail caption transition */

    .do-hover .img-responsive,
    .do-hover.hover .img-responsive,
    .do-hover:hover .img-responsive,
    .do-hover .caption-title,
    .do-hover.hover .caption-title,
    .do-hover:hover .caption-title,
    .do-hover .caption-zoom,
    .do-hover.hover .caption-zoom,
    .do-hover:hover .caption-zoom,
    .do-hover .caption-link,
    .do-hover.hover .caption-link,
    .do-hover:hover .caption-link,
    .do-hover .caption-category,
    .do-hover.hover .caption-category,
    .do-hover:hover .caption-category,
    .do-hover .caption,
    .do-hover.hover .caption,
    .do-hover:hover .caption {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    /* Filter
/* ========================================================================== */

    .filtrable {
        background-color: #f7f7f7;
        display: inline-block;
        margin: 0px;
    }

    .filtrable li {
        /*float: left;*/
        display: inline-block;
        margin-bottom: 0px;
    }

    .filtrable a {
        background-color: #f7f7f7;
        border-bottom: solid 1px #f7f7f7;
        -webkit-border-radius: 0px;
        border-radius: 0px;
        color: #666666;
        display: block;
        padding: 10px 15px;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .filtrable .current a,
    .filtrable .active a,
    .filtrable .current a:hover,
    .filtrable .active a:hover,
    .filtrable a:hover {
        border-bottom-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .filtrable .current {
        position: relative;
    }

    #text_news p {
        font-size: 20px !important;
    }

    /* Main Title
/* ========================================================================== */
    h1.main-title {
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 50px;
        font-family: <?php echo $rs_configuracao['nome_fonte2']; ?> !important;
    }

    .tagline {
        color: #333333;
        font-size: 17px;
        font-weight: 600;
        line-height: 100%;
        margin-top: 10px;
    }

    .tagline:after {
        border-bottom: 1px solid #858585;
        content: "";
        display: block;
        height: 0;
        margin: 40px auto;
        width: 60px;
    }

    h2.main-title {
        color: #444444;
        font-size: 30px;
        font-weight: 400;
        line-height: 46px;
        margin: 0 0 35px 0;
        text-align: center;
        width: 100%;
    }

    h3.main-title {
        color: #999999;
        font-size: 16px;
        font-weight: bold;
        line-height: 20px;
        margin: 0;
        text-align: center;
        text-transform: uppercase;
        width: 100%;
    }

    /* Features
/* ========================================================================== */

    .feature {
        position: relative;
    }

    .feature .media-body *:last-child {
        margin-bottom: 0;
        margin-top: 12px;
    }

    .feature,
    .feature:hover,
    .feature.hover,
    .feature .media-object,
    .feature:hover .media-object,
    .feature.hover .media-object,
    .feature .media-object:after,
    .feature:hover .media-object:after,
    .feature.hover .media-object:after {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .feature .media-object {
        /*display: block;*/
    }

    /* Style 1 */
    .feature.style-1 {
        text-align: center;
        padding-bottom: 40px;
    }

    .feature.style-1.with-border .media {
        border: solid 1px #eeeeee;
        padding: 40px 20px 20px 20px;
    }

    .feature.style-1 .media {
        padding-top: 40px;
    }

    @media (max-width: 767px) {
        .feature.style-1 .media {
            max-width: 350px;
            margin: 0 auto;
        }
    }

    .feature.style-1 .media-object {
        position: relative;
        font-size: 50px;
        line-height: 50px;
        width: 90px;
        height: 90px;
        border-radius: 45px;
        padding: 20px;
        background-color: #000000;
        color: #ffffff;
    }

    .feature.style-1 .media-heading {
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 12px;
        margin-top: 9px;
    }

    .feature.style-1:hover .media-object,
    .feature.style-1.hover .media-object {
        background-color: #A0CE4D;
    }

    .feature.style-1 .media-object:after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        display: block;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 0 0 #000000;
        box-shadow: 0 0 0 0 #000000;
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -ms-transform: scale(0.8);
        -o-transform: scale(0.8);
        transform: scale(0.8);
        opacity: 0;
    }

    .feature.style-1:hover .media-object:after,
    .feature.style-1.hover .media-object:after {
        opacity: 1;
        -webkit-box-shadow: 0 0 0 5px #A0CE4D;
        box-shadow: 0 0 0 5px #A0CE4D;
        -webkit-transform: scale(1.15);
        -moz-transform: scale(1.15);
        -ms-transform: scale(1.15);
        -o-transform: scale(1.15);
        transform: scale(1.15);
    }

    /* Style 2 */
    .feature.style-2 {
        margin-bottom: 0px;
    }

    .feature.style-2 .media {
        background-color: #FFFFFF;
        border: 1px solid #EAEAEA;
        margin: 0;
        overflow: visible;
        padding: 20px;
        position: relative;
    }

    .feature.style-2 .media>.pull-left {
        margin-right: 20px;
    }

    .feature.style-2 .media-body {
        padding-top: 0px;
    }

    .feature.style-2 .media-object {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #FFFFFF;
        font-size: 30px;
        height: 66px;
        line-height: 40px;
        padding: 15px;
        text-align: center;
        width: 66px;
    }

    .feature.style-2 .media:hover .media-object {
        background-color: #1F80AB;
    }

    .feature.style-2 .media-heading {
        color: #242424;
        font-size: 18px;
        font-weight: 500;
    }

    .feature.style-2:hover .media-object,
    .feature.style-2.hover .media-object {}

    .feature.style-2 a {
        color: #999999;
    }

    .feature.style-2 a:hover {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .feature.style-2 a>i {
        margin-left: 10px;
    }

    @media (max-width: 1023px) {
        .feature.style-2 .media {
            margin-bottom: 20px;
        }
    }

    /* Style 3 */
    .feature.style-3 {
        margin-top: 25px;
        margin-bottom: 30px;
        margin-left: auto;
        margin-right: auto;
        max-width: 400px;
    }

    .feature.style-3 .media-heading {
        margin-top: 10px;
    }

    .feature.style-3 .media {
        padding: 15px;
        border: solid 1px #eeeeee;
    }

    .feature.style-3 .media-object {
        position: absolute;
        left: 50%;
        top: -25px;
        height: 50px;
        width: 50px;
        margin-left: -25px;
        line-height: 50px;
        text-align: center;
        border-radius: 25px;
        border: solid 1px #eeeeee;
        background-color: #ffffff;
        color: #3c4547;
    }

    .feature.style-3:hover .media-object,
    .feature.style-3.hover .media-object {
        background-color: #A0CE4D;
        border-color: #A0CE4D;
        color: #ffffff;
    }

    /* Style 4 */
    .feature.style-4 {
        margin-bottom: 30px;
    }

    .row .feature.style-4:last-child {
        margin-bottom: 0;
    }

    .feature.style-4 .media {}

    .feature.style-4 .media-object {
        font-size: 30px;
        line-height: 30px;
        width: 80px;
        height: 80px;
        padding: 25px;
        text-align: center;
        border-radius: 40px;
        background-color: #A0CE4D;
        color: #ffffff;
    }

    .feature.style-4 .media-heading {
        color: #242424;
    }

    .feature.style-4:hover .media-object,
    .feature.style-4.hover .media-object {
        background-color: #6ecf67;
    }

    /* Style 5 */
    .feature.style-5 {
        text-align: center;
        padding-bottom: 40px;
        padding-left: 20px;
        padding-right: 20px;
        background-color: #A0CE4D;
        color: #ffffff;
    }

    .feature.style-5 .media {
        padding-top: 40px;
    }

    .feature.style-5 .media-body *:last-child {
        margin-bottom: 0;
        margin-top: 8px;
    }

    @media (max-width: 767px) {
        .feature.style-5 .media {
            max-width: 350px;
            margin: 0 auto;
        }
    }

    .feature.style-5 .media-object {
        position: relative;
        font-size: 50px;
        line-height: 50px;
        width: 90px;
        height: 90px;
        border-radius: 45px;
        padding: 20px;
        background-color: #ffffff;
        color: #A0CE4D;
    }

    .feature.style-5 .media-heading {
        color: #FFFFFF;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
        margin-top: 9px;
        text-transform: uppercase;
    }

    .feature.style-5:hover .media-object,
    .feature.style-5.hover .media-object {
        background-color: #ffffff;
    }

    .feature.style-5 .media-object:after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        display: block;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 0 0 #ffffff;
        box-shadow: 0 0 0 0 #ffffff;
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -ms-transform: scale(0.8);
        -o-transform: scale(0.8);
        transform: scale(0.8);
        opacity: 0;
    }

    .feature.style-5:hover .media-object:after,
    .feature.style-5.hover .media-object:after {
        opacity: 1;
        -webkit-box-shadow: 0 0 0 5px #ffffff;
        box-shadow: 0 0 0 5px #ffffff;
        -webkit-transform: scale(1.15);
        -moz-transform: scale(1.15);
        -ms-transform: scale(1.15);
        -o-transform: scale(1.15);
        transform: scale(1.15);
    }

    /* Facts */

    .facts {
        color: #8b8b8b;
        margin-bottom: 30px;
        position: relative;
    }

    .facts .title {
        color: #3c4547;
        font-size: 22px;
        font-weight: 500;
        line-height: 30px;
        margin-top: 0;
    }

    .facts .title span {
        display: inline-block;
        font-weight: 600;
        line-height: 20px;
    }

    .facts .facts-icon {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
        border-radius: 50%;
        box-shadow: 0 0 0 2px <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        height: 100px;
        left: 50%;
        margin: 15px 15px 15px -50px;
        position: relative;
        text-align: center;
        width: 100px;
        z-index: 2;
    }

    .facts .facts-icon-overlay {
        -moz-box-sizing: content-box;
        /*background: linear-gradient(to bottom, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 0.95) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);*/
        background: -moz-linear-gradient(top, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 1) 100%);
        /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(33, 158, 203, 0.95)), color-stop(100%, rgba(31, 128, 171, 1)));
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 1) 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 1) 100%);
        /* Opera 11.10+ */
        background: -ms-linear-gradient(top, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 1) 100%);
        /* IE10+ */
        background: linear-gradient(to bottom, rgba(33, 158, 203, 0.95) 0%, rgba(31, 128, 171, 1) 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2f26daf', endColorstr='#1f80ab', GradientType=0);
        /* IE6-9 */
        border-radius: 50%;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        content: "";
        height: 100%;
        left: -2px;
        opacity: 0;
        padding: 2px;
        pointer-events: none;
        position: absolute;
        top: -2px;
        -webkit-transform: scale(1.3);
        -moz-transform: scale(1.3);
        -ms-transform: scale(1.3);
        transform: scale(1.3);
        -webkit-transition: -webkit-transform 0.2s, opacity 0.3s;
        -moz-transition: -moz-transform 0.2s, opacity 0.3s;
        transition: transform 0.2s, opacity 0.3s;
        width: 100%;
        z-index: -1;
    }

    .facts:hover .facts-icon-overlay {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }

    .facts .facts-icon i {
        float: left;
        font-size: 48px;
        line-height: 104px;
        position: relative;
        text-align: center;
        transition-duration: 0.4s;
        width: 100%;
        z-index: 9999;
    }

    .facts:hover .facts-icon i {
        color: #ffffff;
    }

    @media (max-width: 479px) {}

    /* Last Tweet / Twitter
/* ========================================================================== */

    /* Last tweet
/* ========================================================================== */

    .last-tweet {
        overflow: hidden;
        padding: 10px 0 15px 0;
        text-align: center;
    }

    .last-tweet .media {
        border: 0;
    }

    .last-tweet .twitter-icon {
        display: inline-block;
        width: 50px;
        height: 50px;
        border-radius: 25px;
        text-align: center;
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .last-tweet .twitter-icon .fa {
        margin-top: 15px;
        font-size: 20px;
        line-height: 20px;
        color: #ffffff;
    }

    .last-tweet a {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .last-tweet a:hover {
        color: #000000;
    }

    .last-tweet p {
        margin-top: 7px;
        margin-bottom: 0;
    }

    .last-tweet .owl-controls {
        position: relative;
    }

    .last-tweet .owl-controls .prev,
    .last-tweet .owl-controls .next {
        font-size: 30px;
        line-height: 30px;
        width: 30px;
        height: 30px;
        display: inline-block;
        text-align: center;
        position: absolute;
        top: 7px;
        left: 50%;
    }

    .last-tweet .owl-controls .prev {
        margin-left: -60px;
        opacity: 0;
    }

    .last-tweet .owl-controls .next {
        margin-left: 30px;
        opacity: 0;
    }

    .touch .last-tweet .owl-controls .prev,
    .last-tweet:hover .owl-controls .prev {
        margin-left: -90px;
        opacity: 1;
    }

    .touch .last-tweet .owl-controls .next,
    .last-tweet:hover .owl-controls .next {
        margin-left: 60px;
        opacity: 1;
    }


    .recent-tweets small {
        color: rgba(100, 100, 100, 0.7);
        display: block;
        font-size: 12px;
        margin-top: -2px;
    }

    .recent-tweets {
        font-size: 13px;
        line-height: 20px;
    }

    .recent-tweets a {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?> !important;
    }

    .recent-tweets a:hover {
        color: #1f80ab !important;
    }

    /* Error Page
/* ========================================================================== */

    .error-page {
        padding-top: 50px;
        padding-bottom: 100px;
        text-align: center;
        position: relative;
    }

    .error-oops {
        font-size: 150px;
        line-height: 150px;
        color: #242424;
    }

    .error-number {
        display: inline-block;
        background-color: #ffffff;
        clear: right;
        top: -80px;
        position: relative;
        padding: 0 5px;
        border-radius: 2px;
        font-size: 20px;
        font-weight: 600;
        color: #242424;
    }

    .error-message {
        display: inline-block;
        padding: 0 5px;
        border-radius: 2px;
        background-color: #6bcc64;
        color: #ffffff;
    }

    @media (max-width: 479px) {
        .error-oops {
            font-size: 90px;
            line-height: 90px;
        }

        .error-number {
            top: -45px;
        }
    }

    /* Team
/* ========================================================================== */
    .team .thumbnail {
        -webkit-border-radius: 0px;
        border-radius: 0px;
    }

    .team .thumbnail .overflowed {
        border: 1px solid #eaeaea;
        border-bottom: 0;
        margin-bottom: 0px;
    }

    .team .block-text {
        border-bottom: 0px solid #DDDDDD;
        padding: 10px 0px;
    }

    .team .block-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .team .block-title:before {
        background: none;
        content: "";
        height: 0px;
        left: 0;
        margin-top: 0;
        position: absolute;
        top: 0;
        width: 0;
        z-index: 0;
    }

    .team .block-title small:before {
        color: #777777;
        content: "";
        display: inline-block;
        font-size: 14px;
        font-style: italic;
        font-weight: 400;
        padding: 0 5px;
        text-transform: none;
    }

    .team .block-title small {
        color: #333333;
        font-size: 12px;
        font-weight: 600;
        margin: 5px 0;
        text-transform: none;
    }

    .team-social {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border: 1px solid #eaeaea;
        border-top: 0;
        text-align: center;
    }

    .team-social a {
        color: #fff;
    }

    .team-social a:hover {
        color: #000;
    }

    /* Media / Testimonails
/* ========================================================================== */

    #home_gallery .owl-item {
        background-color: white;
    }

    #testimonials,
    #home_gallery {
        margin-bottom: 60px;
    }

    #testimonials .owl-item {
        padding: 10px;
    }

    .testimonial:before {
        border-left: 10px solid #F7F7F7;
        border-right: 10px solid #F7F7F7;
        border-top: 10px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        bottom: -10px;
        content: "";
        left: 50px;
        position: absolute;
        z-index: 33;
    }

    .testimonial:after {
        border-left: 8px solid rgba(0, 0, 0, 0);
        border-right: 8px solid rgba(0, 0, 0, 0);
        border-top: 8px solid #FFFFFF;
        bottom: -8px;
        content: "";
        left: 51px;
        position: absolute;
        z-index: 44;
    }

    .testimonial.media {
        background-color: #ffffff;
        border: 1px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        margin: 17px 0 !important;
        padding: 14px;
        position: relative;
        overflow: visible;
        width: 96% !important;
    }

    .testimonial.media:last-child {
        border-bottom: 1px solid <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .testimonial-title {
        display: inline-block;
        margin: 0 auto 20px;
    }

    .testimonial.media img {
        border: 3px solid #ffffff;
        display: inline-block;
        margin-right: 10px;
        width: 80px;
    }

    .testimonial .media-body {
        padding-right: 15px;
    }

    .testimonial .media-heading {
        display: inline-block;
        font-size: 16px;
        font-weight: 600;
        line-height: 24px;
    }

    .testimonial .media-heading small {
        line-height: 24px;
        margin-left: 10px;
        text-transform: capitalize;
    }

    .testimonial .media-heading small a {
        color: #999999;
        font-size: 14px;
    }

    .testimonial .media-heading small a:hover {
        color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    .testimonial span {
        color: #999999;
        display: block;
        font-size: 14px;
        font-weight: 400;
        line-height: 14px;
    }

    .testimonial .media-body p {
        font-style: italic;
    }

    /* Media / Partners
/* ========================================================================== */

    #partners .owl-wrapper-outer {
        margin-bottom: 25px;
    }

    /* Media / why we are
/* ========================================================================== */
    #whyweare .media img {
        width: 100%;
    }

    .whyweare.media {
        padding-top: 0;
    }

    /* Owl controls
/* ========================================================================== */
    .owl-theme .owl-controls .owl-buttons div,
    .owl-theme .owl-controls .owl-page span {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    }

    /* Media / Latest news ...
/* ========================================================================== */

    .address-ul {
        margin-left: 22px;
    }

    .address-ul strong {
        display: inline-block;
        font-weight: 300;
        line-height: 20px;
        margin-bottom: 5px;
        color: #ffffff;
    }

    .address-ul li {
        color: <?php echo $rs_configuracao['fonte_barra_cabecalho']; ?> !important;
        line-height: 20px;
        margin-bottom: 10px;
    }

    .address-ul .fa {
        color: <?php echo $rs_configuracao['fonte_barra_cabecalho']; ?> !important;
        top: 3px;
    }

    /* Media / Latest news ...
/* ========================================================================== */

    .media {
        margin-bottom: 0px;
        margin-top: 10px;
        padding-top: 10px;
    }

    .media>.pull-left {
        margin-right: 10px;
    }

    .comments .media>.pull-left {
        margin-right: 10px;
    }

    .media .media {
        margin-bottom: 5px;
    }

    .media .media>.pull-left {
        margin-right: 10px;
    }

    .media .media-heading {
        margin-bottom: 0;
    }

    .media .post-date {
        color: #9e9e9e;
        font-size: 11px !important;
    }

    .media .post-date .fa {
        margin-right: 5px;
        color: #9e9e9e;
    }

    .media:last-child {
        border-bottom: none;
    }

    .media img {
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        width: 45px;
    }

    .media img:hover {
        opacity: 0.6;
    }

    .media p {
        margin-bottom: 0;
    }

    .media-body {}

    /*
.sidebar .media > .pull-left {
    margin-right: 10px;
}
.comments .media,
.sidebar .media {
    border: 0;
}
.sidebar .media-heading {
    margin-top: -7px;
}
.sidebar .media-heading a {
    color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
    font-size: 13px;
    font-weight: 500;
    line-height: 24px;
    text-transform: uppercase;
}
.sidebar .media-heading a:hover {
    color: #1F80AB;
}
.sidebar .media .post-date {
    margin-bottom: 7px;
    text-transform: none;
}
.sidebar .media .post-text {
    font-size: 13px;
}
*/

    .media img {
        width: 34px;
    }

    .btn.viewcart,
    .btn.checkout {
        margin-bottom: 5px;
    }
    }

    .media .media img {
        width: 45px;
    }

    .media img:hover {
        opacity: 0.6;
    }

    .media p {
        margin-bottom: 0;
    }

    .media-body {}

    .sidebar .media>.pull-left {
        margin-right: 10px;
    }

    .comments .media,
    .sidebar .media {
        border: 0;
    }

    .sidebar .media-heading {
        margin-top: -5px;
    }

    .sidebar .media-heading a {
        color: #333333;
        font-size: 14px;
        font-weight: 400;
        line-height: 24px;
    }

    .sidebar .media-heading a:hover {
        color: #FBBA0E;
    }

    .sidebar .media .post-date {
        margin-bottom: 7px;
        text-transform: none;
    }

    .sidebar .media .post-text {
        font-size: 13px;
    }

    .sidebar {
        margin-bottom: 20px;
        background-color: <?php echo $rs_configuracao['fundo_menu_lateral']; ?>;
        /*#d0d0d0;*/
        padding-top: 20px;
    }

    .sidebar .widget .title {
        color: #999999;
        font-size: 18px;
        font-weight: 400;
        line-height: 20px;
        margin-bottom: 24px;
        margin-top: 0px;
    }

    .sidebar .widget {
        color: #999999;
    }

    .sidebar .widget a {
        color: #666666;
    }

    .sidebar .widget a:hover {
        color: #FBBA0E;
    }

    .sidebar .btn-search {
        background-color: transparent;
        color: #333333;
        height: 40px;
        position: absolute;
        right: 15px;
        top: 0;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        width: 40px;
    }

    .sidebar .btn-search:hover {}

    .sidebar .widget .pages,
    .sidebar .widget .categories {
        padding-left: 0px;
    }

    .sidebar .widget .pages li,
    .sidebar .widget {
        border-bottom: 1px dashed #999;
        padding-left: 0px;
        position: relative;
        padding-bottom: 20px;
    }

    .sidebar .widget .pages li:last-child,
    .sidebar .widget .categories li:last-child {
        border-bottom: 0;
    }

    .sidebar .widget .pages a:hover,
    .sidebar .widget .categories a:hover {}

    .sidebar .widget .pages a:before,
    .sidebar .widget .categories a:before {
        /*color: #cccccc;
    content: "\f105";
    font-family: "FontAwesome";
    font-size: 10px;
    left: 0px;
    position: absolute;
    top: 0px;*/

    }

    .sidebar .widget .pages a:hover:before,
    .sidebar .widget .categories a:hover:before {
        color: #FBBA0E;
    }

    .sidebar .widget .pages a,
    .sidebar .widget .categories a {
        line-height: 30px;
        font-weight: bold;
    }

    .sidebar .widget .pages li:hover a,
    .sidebar .widget .categories li:hover a {
        padding-left: 0px;
    }

    /* popular categories
/* ========================================================================== */
    .pop-cat {
        background-image: url("../img/parallax-cat0.jpg");
        background-position: center center;
        /*background-attachment: fixed;*/
        background-size: cover;
        border: 1px solid #dbdbdb;
        height: 180px;
        margin: 0 0 0px;
        width: 100%;
    }

    .pop-cat:hover {
        border-color: #cf4529;
        -webkit-transition: all .2s linear;
        -moz-transition: all .2s linear;
        -o-transition: all .2s linear;
        -ms-transition: all .2s linear;
        transition: all .2s linear;
    }

    .pop-cat.cat1 {
        background-image: url("../img/parallax-cat1.jpg");
    }

    .pop-cat.cat2 {
        background-image: url("../img/parallax-cat2.jpg");
    }

    .pop-cat.cat3 {
        background-image: url("../img/parallax-cat3.jpg");
    }

    .pop-cat.cat4 {
        background-image: url("../img/parallax-cat4.jpg");
    }

    .pop-cat a {
        color: #ffffff;
        font: bold 30px/50px "Buenard", sans-serif;
        text-shadow: 0 0 6px #000000;
        margin-top: 50px;
        float: left;
        text-align: center;
        width: 100%;
    }

    .pop-cat a:hover {
        color: #cf4529;

    }

    .pop-cat:hover {
        opacity: 0.3 !important;
    }

    /* Instagram
/* ========================================================================== */

    /* Services
/* ========================================================================== */
    .services {}

    .service-box {
        padding: 5%;
        position: relative;
        text-align: center;
        border: 1px solid #eaeaea !important;

        -webkit-box-shadow: 5px 5px 5px 0px rgba(184, 181, 185, 1);
        -moz-box-shadow: 5px 5px 5px 0px rgba(184, 181, 185, 1);
        box-shadow: 5px 5px 5px 0px rgba(184, 181, 185, 1);
    }

    .service-box:hover,
    .service-box:hover .service-info h3,
    .service-box:hover .service-info p {
        background: <?php echo $rs_configuracao['fundo_box_destaque']; ?>;
        color: #FFFFFF !important;
    }

    .service-box h3 {
        font-weight: 600;
        margin: 0;
    }

    .bg_cartao {
        background: url("<?php echo $siteUrl2; ?>assets/<?php echo $siteUrl2; ?>assets/assets/ico/ico_cartao.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    }

    .bg_calcinha {
        background: url("<?php echo $siteUrl2; ?>assets/<?php echo $siteUrl2; ?>assets/assets/ico/ico_calcinha.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    }

    .bg_relogio {
        background: url("<?php echo $siteUrl2; ?>assets/<?php echo $siteUrl2; ?>assets/assets/ico/ico_relogio.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    }

    .bg_duvida {
        background: url("<?php echo $siteUrl2; ?>assets/<?php echo $siteUrl2; ?>assets/assets/ico/ico_duvida.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    }

    .bg_dinheiro {
        background: url("<?php echo $siteUrl2; ?>assets/<?php echo $siteUrl2; ?>assets/assets/ico/ico_dinheiro.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    }

    .service-img {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        border-radius: 100%;
        color: #FFFFFF;
        float: left;
        font-size: 17px;
        height: 60px;
        left: 0;
        line-height: 60px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 60px;
    }

    .service-info h3 {
        font-size: 24px;
    }

    .service-info p {
        margin-bottom: 30px;
        height: 60px;
        overflow: hidden;
    }

    /* Call Action
/* ========================================================================== */

    .wide .page-section.call-action,
    .boxed .page-section.call-action>.container {
        border: none;
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #ffffff;
    }

    .call-action h1,
    .call-action h2,
    .call-action h3,
    .call-action h4,
    .call-action h5,
    .call-action h6 {
        text-transform: uppercase;
        font-weight: 700;
        color: #ffffff;
    }

    /* Social line
/* ========================================================================== */

    .socical-line {}

    .socical-line li {
        margin-right: 1px;
        margin-bottom: 1px;
        padding: 0;
    }

    .socical-line a {
        color: #ffffff;
        display: block;
        line-height: 24px;
        padding: 6px 0;
        text-align: center;
        width: 40px;
    }

    .socical-line .fa {
        font-size: 14px;
        line-height: 24px;
        color: #ffffff;
    }

    .socical-line a:hover .fa {
        color: #ffffff;
    }

    /* Project
/* ========================================================================== */

    .project-single {}

    .project-media {}

    .project-overview {}

    .project-details {}

    .project-details .dl-horizontal dt {
        text-align: left;
    }

    .project-details .dl-horizontal dt {
        color: #3c4547;
        width: 90px;
    }

    .project-details .dl-horizontal dd {
        position: relative;
        margin-left: 110px;
    }

    @media (max-width: 767px) {
        .project-details .dl-horizontal dt {
            float: left;
        }
    }

    /* af-form
/* ========================================================================== */

    /* Google map
/* ========================================================================== */

    .google-map,
    #map-canvas {
        min-height: 580px;
        max-height: 650px;
    }

    /* Parallax
/* ========================================================================== */

    .parallax,
    .boxed .parallax>.container {
        position: relative;
        z-index: 1;
    }

    .parallax-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        /*background-attachment: fixed !important;*/
        /*background-attachment: scroll !important;*/
        background-repeat: repeat;
        background-image: url("<?php echo $siteUrl2; ?>assets/img/bg/strange_bullseyes.png");
        z-index: 2;
    }

    .parallax-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-position: 50% 0;
        background-repeat: repeat;
        background-image: url("<?php echo $siteUrl2; ?>assets/img/overlay.png");
        z-index: 3;
    }

    .parallax-inner {
        position: relative;
        color: #ffffff;
        z-index: 4;
    }


    .parallax.main {
        height: 500px;
        position: relative;
    }

    .parallax.main .parallax-inner {
        height: 420px;
    }

    .parallax.main .parallax-bg {
        background-image: url("<?php echo $siteUrl2; ?>assets/img/parallax_main.jpg");
        background-position: center center;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
    }

    .parallax.main .headings {
        margin-top: 100px;
    }

    .parallax.main .media-heading {
        color: #ffffff;
        display: inline-block;
        font-weight: 500;
        margin: 0 auto 10px auto;
        padding: 6px 15px;
        text-align: center;
    }

    .parallax.main h5.media-heading {
        background-color: #A0CE4D;
        background-color: rgba(160, 206, 77, 0.7);
        font-size: 26px;
        line-height: 1.5;
    }

    .parallax.main h4.media-heading {
        background-color: #333333;
        background-color: rgba(0, 0, 0, 0.7);
        font-size: 32px;
        line-height: 1.5;
    }

    @media (max-width: 767px) {
        .parallax.main {
            height: 300px;
        }

        .parallax.main .headings {
            margin-top: 0px;
        }

        .parallax.main h5.media-heading {
            font-size: 22px;
        }

        .parallax.main h4.media-heading {
            font-size: 22px;
        }
    }

    /* Footer
/* ========================================================================== */
    .wide .footer,
    .boxed .footer>.container {
        background: <?php echo $rs_configuracao['fundo_rodape']; ?>;
        color: #999999;
        font-size: 13px;
        margin-top: 0;
        padding: 20px 0 0px;
    }

    .footer a,
    .footer a:hover,
    .footer a:active,
    .footer a:focus {
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
    }

    .footer a {
        color: <?php echo $rs_configuracao['cor_botao_rodape']; ?>;
        font-size: 13px;
    }

    .footer .media-heading a {
        font-size: 15px;
    }

    .footer a:hover,
    .footer a:active,
    .footer a:focus {
        color: <?php echo $rs_configuracao['cor_botao_rodape_hover']; ?>;
    }


    .footer .widget {
        margin-bottom: 30px;
    }

    .footer .title {
        color: <?php echo $rs_configuracao['cor_fonte_rodape']; ?>;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
        margin-top: 0;
        padding-top: 17px;
        text-transform: uppercase;
    }

    .footer .form-control {
        border: 1px solid #dbdbdb;
        border-radius: 3px;
    }

    .footer .form-control:focus {
        border: 1px solid #000000;
    }

    .footer .error {
        color: #ff0000;
    }

    .footer .about p {
        text-align: justify;
    }

    .footer-logo {
        margin-bottom: 10px;
        max-width: 240px;
    }

    .footer .latest-news li {
        border-bottom: 1px solid #5a5a5a;
        line-height: 40px;
    }

    .footer .latest-news li:last-child {
        border: 0px;
    }

    .footer .socical-line a {
        -webkit-border-radius: 50%;
        border-radius: 50%;
        width: 38px;
    }

    /* Copyright line */

    .wide .copyrights,
    .boxed .copyrights>.container {
        background: <?php echo $rs_configuracao['barra_rodape']; ?>;
        ;
    }

    .copyrights>.container>.row {}

    .copyrights .socical-line {
        margin-bottom: 0;
        text-align: center;
    }

    .copyrights .socical-line li {
        margin-bottom: 0;
        margin-right: 1px;
    }

    .copyrights .socical-line li a {
        background-color: rgba(0, 0, 0, 0);
        border: 1px solid #FFFFFF;
        border-radius: 50%;
        color: #777777;
        display: block;
        height: 32px;
        line-height: 22px;
        padding: 5px;
        width: 32px;
    }

    .copyrights .socical-line li a:hover i {
        color: #ffffff;
    }

    .copyrights p {
        line-height: 60px;
        margin: 0;
        text-transform: uppercase;
    }

    .copyrights .contact-info {
        text-align: right;
    }

    @media (max-width: 767px) {
        .copyrights {
            text-align: center;
        }

        .copyrights .contact-info {
            margin-top: 10px;
            text-align: center;
        }
    }

    /* to top */
    .totop {
        background-color: rgba(0, 0, 0, 0.5);
        border: 0;
        -webkit-border-radius: 0px;
        border-radius: 0px;
        bottom: -100px;
        color: #ffffff;
        cursor: pointer;
        font-size: 20px;
        line-height: 36px;
        height: 40px;
        overflow: hidden;
        position: fixed;
        right: 25px;
        text-align: center;
        -webkit-transition: all .4s ease-in-out;
        -moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -ms-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
        width: 40px;
        z-index: 9999;
    }

    .totop:hover {
        background-color: <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        color: #ffffff;
    }

    /* Helper Classes
/* ========================================================================== */
    /* ========================================================================== */
    /* ========================================================================== */

    .clear {
        clear: both;
    }

    .overflowed {
        overflow: hidden;
        position: relative;
    }

    /*[data-animation],*/
    .animated,
    .vhidden {
        visibility: hidden;
    }

    .visible {
        visibility: visible;
    }

    .div-table,
    .div-cell {
        height: 100% !important;
        display: table !important;
    }

    .div-cell {
        display: table-cell !important;
        vertical-align: middle !important;
        float: none !important;
    }

    @media (max-width: 767px) {

        [class*="col-"].div-table,
        [class*="col-"].div-cell {
            display: block !important;
        }
    }

    /* Remove firefox dotted line
/* ========================================================================== */

    a,
    a:active,
    a:focus,
    input,
    input:active,
    input:focus,
    button,
    button:active,
    button:focus,
    select,
    select:active,
    select:focus {
        outline: 0 !important;
    }

    /* Remove webkit outline glow
/* ========================================================================== */

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .desloca_esquerda {
        float: left;
    }

    .img_destacada {
        margin: 0 20px 0 0;
    }

    .titulo_secao {
        font-size: 50px;
        margin-bottom: 50px;
        margin-top: 0 !important;
    }

    .subtitulo_secao {
        font-size: 50px;
        margin-top: 40px !important;
    }

    .negrito {
        font-weight: bold;
    }

    /*fixa topo scroll*/
    .f-nav {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 999;
    }

    #btn_news {
        background: url("<?php echo $siteUrl2; ?>assets/img/ico_news.png") no-repeat scroll center center <?php echo $rs_configuracao['barra_cabecalho']; ?>;
        bottom: 15px;
        height: 40px;
        position: fixed;
        right: 25px;
        width: 45px;
        cursor: pointer;
        -webkit-transition: all .4s ease-in-out;
        -moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -ms-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
        z-index: 5000;
    }

    #caixa_news {
        background: none repeat scroll 0 0 #fff;
        border: 1px solid silver;
        bottom: 55px;
        height: 260px;
        padding: 0 15px;
        position: fixed;
        right: 70px;
        width: 270px;
        display: none;
        z-index: 5050;
    }

    #caixa_news input {
        width: 235px;
        border: 1px solid silver;
        margin-bottom: 10px;
        padding: 6px 0 6px 10px;
    }

    .btn-default {
        border-color: <?php echo $rs_configuracao['cor_botao']; ?> !important;
        background: <?php echo $rs_configuracao['cor_botao']; ?> !important;
    }

    .btn-default:hover {
        border-color: <?php echo $rs_configuracao['cor_botao_hover']; ?> !important;
        background: <?php echo $rs_configuracao['cor_botao_hover']; ?> !important;
    }


    /* /Carrinho */
    #erro_box {
        width: 100%;
        float: left;
        height: 100px;
        margin: 80px 20px;
        display: block;
    }

    .erro_titulo {
        font-size: 24px;
        color: #000000;
        display: block;
        margin: 20px 0;
        text-align: center;
    }

    .erro_texto {
        font-size: 20px;
        color: #000000;
        display: block;
        text-align: center;
    }


    p {
        line-height: 150% !important;
        margin: 1% 0 !important;
    }



    ul#banner_meio li {
        width: 100% !important;
        float: left;
    }

    #rotacao {
        width: 60px;
        margin: 20px auto;
        height: auto;
        text-align: center;
    }

    #rotacao a {
        width: 20px;
        height: 20px;
        padding: 2px 2px;
        float: left;
        font-size: 0.1em;
        color: #48A14D;
        text-align: center;
        padding-top: 3px;
        margin: 0px;
        background: url(images/navegador.png) no-repeat center;
        text-decoration: none;
        margin-bottom: 10px;
    }

    #rotacao a.activeSlide {
        background: url(images/navegador2.png) no-repeat center;
        color: #A7D8A9;
        padding-top: 8px;
    }

    #rotacao2 {
        width: 60px;
        margin: 20px auto;
        height: auto;
        text-align: center;
    }

    #rotacao2 a {
        width: 20px;
        height: 20px;
        padding: 2px 2px;
        float: left;
        font-size: 0.1em;
        color: #48A14D;
        text-align: center;
        padding-top: 3px;
        margin: 0px;
        background: url(images/navegador.png) no-repeat center;
        text-decoration: none;
        margin-bottom: 10px;
    }

    #rotacao2 a.activeSlide {
        background: url(images/navegador2.png) no-repeat center;
        color: #A7D8A9;
        padding-top: 8px;
    }

    #rotacao3 {
        width: 60px;
        margin: 20px auto;
        height: auto;
        text-align: center;
    }

    #rotacao3 a {
        width: 20px;
        height: 20px;
        padding: 2px 2px;
        float: left;
        font-size: 0.1em;
        color: #48A14D;
        text-align: center;
        padding-top: 3px;
        margin: 0px;
        background: url(images/navegador.png) no-repeat center;
        text-decoration: none;
        margin-bottom: 10px;
    }

    #rotacao3 a.activeSlide {
        background: url(images/navegador2.png) no-repeat center;
        color: #A7D8A9;
        padding-top: 8px;
    }

    .banner-half {
        padding: 0;
        margin: 5px;
        width: 545px;
        max-width: 100%;
        min-height: 160px;
        float: left;
    }

    .banner_rodape {
        width: 18%;
        float: left;
        margin: 0 1%;
    }

    .banner_rodape img {
        width: 100%;
        float: left;
    }

    .qty-minus {
        cursor: pointer !important;
    }

    .qty-plus {
        cursor: pointer !important;
    }

    .product-quantity .form-control,
    .product-quantity input[type="button"] {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #DCDCDC;
        color: #222222;
        display: block;
        float: left;
        font-size: 18px;
        height: 50px;
        line-height: 50px;
        margin: 0 3px 0 0;
        outline: 0 none;
        text-align: center;
        width: 50px;
    }

    #telaComentario {
        display: none;
    }

    .post-wrap {
        padding: 10px;
        border: 1px solid <?php echo $rs_configuracao['cor_linha_box']; ?>;
        -webkit-transition: all .2s linear;
        -moz-transition: all .2s linear;
        -o-transition: all .2s linear;
        -ms-transition: all .2s linear;
        transition: all .2s linear;
        overflow: hidden;
        background-color: <?php echo $rs_configuracao['cor_box_produto']; ?>;
    }

    .post-wrap:hover {
        border: 1px solid <?php echo $rs_configuracao['cor_linha_box_hover']; ?>;
    }

    .shop .post-wrap {
        margin: 10px;
        /*height: 590px;*/
    }

    .tab-content .post-title {
        line-height: normal !important;
    }

    .tab-content .post-title a {
        font-size: 12px;
        line-height: 20px;
    }

    .tab-content .post-title strong {
        font-size: 12px;
    }

    .btn-dark {
        color: #ffffff;
        background-color: #333333;
        border-color: #333333;
        border-bottom: 2px solid #000000;
        font-size: 16px;
    }

    .btn-dark:hover,
    .btn-dark:focus,
    .btn-dark:active,
    .btn-dark.active {
        color: #ffffff;
        background-color: #e1972f;
        border-color: #e1972f;
        border-bottom-color: #DCA30D;
    }


    /* /cotacao */
    #input-message,
    .quantity {
        border: 1px solid #999;
        padding: 5px;
    }

    /* /Carrinho */
    #erro_box {
        width: 100%;
        float: left;
        height: 100px;
        margin: 20px;
        display: block;
    }

    .erro_titulo {
        font-size: 24px;
        color: #000000;
        display: block;
        margin: 20px 0;
        text-align: center;
    }

    .erro_texto {
        font-size: 20px;
        color: #000000;
        display: block;
        text-align: center;
    }


    /* Peças Avulsas */

    #pecas_avulsas_section textarea {
        width: 100%;
        background-color: #DBDBDB;
        -webkit-border-radius: 0px;
        border-radius: 0px;
        border: 1px solid #dbdbdb;
        font-size: 13px;
        -webkit-box-shadow: none;
        box-shadow: none;
        height: 80px !important;
        padding: 10px 12px;
    }

    #pecas_avulsas_section .quantity {
        background-color: #DBDBDB;
        -webkit-border-radius: 0px;
        border-radius: 0px;
        border: 1px solid #dbdbdb;
        font-size: 13px;
        -webkit-box-shadow: none;
        box-shadow: none;
        height: 40px;
        padding: 10px 12px;
        text-align: right;
    }

    #pecas_avulsas_section .save-item {
        padding: 5px;
        margin: 0;
        background-color: #333;
        border: 1px solid #333;
        color: #FFF;
        font-size: 13px;
        -webkit-box-shadow: none;
        box-shadow: none;
        height: 40px;
    }

    #pecas_avulsas_section table {
        margin-bottom: 30px;
        width: 100%;
        border-width: 0px 1px 1px;
        border-style: solid;
        border-color: #333;
    }

    #pecas_avulsas_section form table {
        border-width: 0px;
    }

    #pecas_avulsas_section table tr {
        border-top: 1px solid #333;
        width: 100%;
    }

    #pecas_avulsas_section form table tr {
        border-top: 0px;
    }


    #pecas_avulsas_section table tr th,
    #pecas_avulsas_section table tr td {
        padding: 15px;
        vertical-align: top;
    }

    #pecas_avulsas_section table tr th {
        background-color: #333;
        color: #FFF;
    }

    #pecas_avulsas_section form table tr th {
        background-color: transparent;
        color: #333;
    }


    #pecas_avulsas_section form table tr th,
    #pecas_avulsas_section form table tr td {
        padding: 5px;
    }

    #pecas_avulsas_section table tr .col-sm-1 {
        text-align: center;
    }

    #pecas_avulsas_section table .delete-iten {
        background-color: transparent;
        border: 0;
        padding: 15px;
    }

    #pecas_avulsas_section table .delete-iten img {
        width: 100%;
    }

    #pecas_avulsas_section .send_request {
        padding: 10px;
        border: 1px solid #333333;
        font-weight: bold;
        text-transform: uppercase;
        background-color: #4A4A4A;
        color: white;
    }

    #pecas_avulsas_section .save-item:hover,
    #pecas_avulsas_section .send_request:hover {
        color: #cf4429;
    }

    /* /Peças Avulsas */

    .old-price {
        text-decoration: line-through;
    }

    .sidebar .widget .pages li,
    .sidebar .widget .categories li a {
        color: <?php echo $rs_configuracao['cor_categoria_sidebar_prod']; ?> !important;
    }

    .sidebar .widget .pages li,
    .sidebar .widget .categories li a:hover {
        color: <?php echo $rs_configuracao['cor_subcategoria_sidebar_prod']; ?> !important;
    }

    .sidebar .widget .pages li,
    .sidebar .widget .categories li ul li a {
        color: <?php echo $rs_configuracao['cor_subcategoria_sidebar_prod']; ?> !important;
    }

    .borda-produtos {
        border: 1px solid <?php echo $rs_configuracao['cor_linha_box']; ?> !important;
    }

    .borda-produtos:hover {
        border: 1px solid <?php echo $rs_configuracao['cor_linha_box_hover']; ?> !important;
    }

    h5 i {
        color: <?php echo $rs_configuracao['cor_icone']; ?> !important;
    }

    .valor-de-para .de {
        color: <?php echo $rs_configuracao['cor_sobconsulta']; ?> !important;
    }

    .valor-de-para .de:hover {
        color: <?php echo $rs_configuracao['cor_sobconsulta_hover']; ?> !important;
    }

    @media (min-width: 200px) {
        .menu_home_barra {
            width: 100%;
            float: left;
            height: 100px;
            margin-bottom: 10%;
            text-align: center;
            color: #FFFFFF;
        }

        .menu_home_meio {
            font-size: 1.5em;
            font-weight: bold;
            width: 100%;
            margin-top: 5%;
            float: left;
            text-align: center;
        }

        .menu_home_icone {
            font-size: 4em;
        }

        h1.main-title {
            font-size: 25px;
        }

        .search_drop {
            width: 10%;
            height: auto;
            float: left;
            display: block;
            margin: 4% 0 0 0;
            color: #288b95;
            cursor: pointer;
        }

        .search_drop input {
            background: #FFFFFF;
            font-size: 0.7em;
            border-radius: 5px;
            border-top: solid 1px #cfcfcf;
            border-right: solid 1px #cfcfcf;
            border-bottom: solid 1px #cfcfcf;
            border-left: solid 1px #cfcfcf;
            box-shadow: 3px 1px 3px 1px #cccccc;
            height: 35px;
            width: 160px !important;
            padding: 1% 2%;
            margin-top: -20%;
            margin-left: -140px;
            display: none;
        }

        .search {
            width: 100%;
            margin: 2% 0;
        }

        .search input {
            background: #FFFFFF;
            font-size: 0.8em;
            border-radius: 5px;
            border-top: solid 1px #cfcfcf;
            border-right: solid 1px #cfcfcf;
            border-bottom: solid 1px #cfcfcf;
            border-left: solid 1px #cfcfcf;
            box-shadow: 3px 1px 3px 1px #cccccc;
            height: 35px;
            width: 100% !important;
            padding: 1% 2%;
            margin-top: -2%;
        }

        .submit-lente {
            position: absolute;
            top: 15%;
            right: 3%;
            z-index: 10;
            border: none;
            background: transparent;
            outline: none;
        }

        .submit-line {
            position: relative;
            width: 100%;
        }

        .submit-line input {
            width: 96%;
        }

        .rede_g {
            display: none;
        }

        .conta_g {
            display: none;
        }

        .rede_p {
            display: block;
            width: 100%;
        }

        .conta_p1 {
            display: block;
            width: 100%;
        }

        .conta_p2 {
            display: block;
            width: 100%;
            font-size: 0.7em;
        }

        .cont_cab_p {
            margin: 0 !important;
            padding: 0 !important;
            width: 98% !important;
            max-width: 1170px;
        }

        .additional {
            display: none;
        }

        .logo {
            width: 90%;
        }

        .mobile-menu {
            width: 9%;
        }

        .catalogo_e {
            max-width: 98% !important;
            margin-left: 1%;
        }

        .rsImg {
            height: 150px;
        }

        .footer-logo {
            display: none;
        }

        .cata_peq {
            margin-top: 10px;
        }

        .sub-menu {
            display: none;
        }

        .sf-menu {
            background: #FF0000 !important;
        }

        .mobile-menu {
            background: #25a8ba;
            width: 300px;
            float: right;
            right: -5px;
            background: #25a8ba;
            color: #ffffff;
            font-size: 1.5em;
        }

        #menumobile {
            display: block;
            float: right;
            margin: 5% 0 0 0;
        }

        #menumobile1 {
            display: block;
            float: right;
            font-size: 2em;
        }

        #menu_mobile {
            display: none;
            background: #25a8ba;
            width: 100%;
            max-width: 300px;
            position: absolute;
            height: auto;
            top: 85px;
            right: 0;
            z-index: 99;
        }

        #menu_mobile ul li {
            width: 100%;
            text-align: center;
            float: left;
            margin: 5% 0;
        }

        #menu_mobile ul li a {
            color: #FFFFFF;
            font-weight: 500;
            font-size: 1.5em;
            text-transform: uppercase;
        }

        #menu_mobile ul li a:hover {
            color: #4373d1;
            text-decoration: none;
        }

        .whats {
            display: none;
        }

        .side_busca {
            display: none;
        }

        .tit_busca {
            font-size: 1.2em !important;
        }

        .busca_sel {
            margin-top: 15px;
        }

        .container {
            max-width: 98% !important;
        }

        .container {
            width: 98% !important;
        }

        .breadcrumbs {
            padding: 1px 0 !important;
        }
    }

    @media (min-width: 319px) {
        .rede_p {
            display: block;
            width: 50%;
        }

        .conta_p1 {
            display: block;
            width: 50%;
        }

        .conta_p2 {
            display: block;
            font-size: 1em;
        }
    }

    @media (min-width: 569px) {
        .menu_home_barra {
            width: 33%;
            float: left;
            height: 100px;
            margin-bottom: 0;
            text-align: center;
            color: #FFFFFF;
        }

        .menu_home_meio {
            font-size: 1.5em;
            font-weight: bold;
            width: 100%;
            margin-top: 5%;
            float: left;
            text-align: center;
        }

        .menu_home_icone {
            font-size: 4em;
        }

        h1.main-title {
            font-size: 50px;
        }

        .rede_g {
            display: block;
        }

        .conta_g {
            display: block;
        }

        .rede_p {
            display: none;
        }

        .conta_p1 {
            display: none;
        }

        .conta_p2 {
            display: none;
        }

        .submit-lente {
            top: -40%;
        }

        .cont_cab_p {
            margin: auto !important;
        }

        .additional {
            width: auto;
            display: block;
        }

        .logo {
            width: 50%;
        }

        .mobile-menu {
            width: 10%;
        }

        .rsImg {
            height: auto;
        }

        .catalogo_e {
            max-width: 74% !important;
            margin-left: 1%;
        }

        .cata_peq {
            margin-top: 0;
        }

        .sub-menu {
            display: block;
        }

        .sf-menu {
            background: <?php echo $rs_configuracao['fundo_menu_top']; ?> !important;
        }

        #menu_mobile {
            display: none;
        }

        #menumobile1 {
            display: none;
        }

        #menumobile {
            display: none;
        }

        .whats {
            display: block;
        }

        .side_busca {
            display: block;
        }

        .corpo_busca {
            max-width: 74%;
        }

        .busca_sel {
            margin-top: 0;
        }

        .container {
            max-width: 94% !important;
        }

        .container {
            width: 94% !important;
        }

        .breadcrumbs {
            padding: 20px 0 !important;
        }
    }

    @media (min-width: 758px) {
        .logo {
            width: 30%;
        }

        .navigation {
            width: 70%;
        }

        .footer-logo {
            display: block;
        }

        .cont_cab_p {}

        @media (min-width: 1025px) {
            .logo {
                width: 20%;
            }

            .navigation {
                width: 60%;
            }

            .tit_busca {
                font-size: 2.5em !important;
            }

            .container {
                max-width: 90% !important;
            }

            .container {
                width: 90% !important;
            }

            .cont_cab_p {
                max-width: 90% !important;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1170px !important;
            }

            .container {
                width: 1170px !important;
            }

            .cont_cab_p {
                max-width: 1170px !important;
                ;
            }
        }

        .textarea-contact {
            height: 200px;
            width: 100%;
            border: solid 1px rgba(0, 0, 0, .1);
            position: relative;
        }

        .textarea-contact textarea {
            height: 100%;
            width: 100%;
            border: 0;
            padding: 20px;
            background-color: transparent;
            float: left;
            z-index: 2;
            font-size: 14px;
            color: #9a9a9a;
            resize: none;
        }

        .textarea-contact>span {
            position: absolute;
            top: 20px;
            left: 20px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-size: 12px;
            text-transform: uppercase;
            color: #cdcdcd;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            z-index: 1;
        }

        .input-contact {
            height: 40px;
            width: 100%;
            border: solid 1px rgba(0, 0, 0, .1);
            position: relative;
            margin-bottom: 30px;
        }

        .input-contact input[type="text"],
        .input-contact input[type="email"] {
            height: 100%;
            width: 100%;
            border: 0;
            padding: 0 20px;
            float: left;
            position: relative;
            background-color: transparent;
            z-index: 2;
            font-size: 14px;
            color: #9a9a9a;
        }

        .input-contact>span {
            position: absolute;
            top: 50%;
            left: 20px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-size: 12px;
            text-transform: uppercase;
            color: #222222;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            z-index: 1;
        }

        .input-contact>span.active,
        .textarea-contact>span.active {
            color: #25a8ba;
            font-size: 10px;
            top: 0px;
            left: 5px;
            background-color: #fff;
            padding: 5px
        }

        input:focus,
        textarea:focus {
            outline: none;
        }
</style>