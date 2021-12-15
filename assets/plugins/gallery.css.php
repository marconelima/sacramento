<style>
@import '../css/grid.css';

@import url(//fonts.googleapis.com/css?family=Open+Sans:400);
@import url(//fonts.googleapis.com/css?family=Open+Sans:700);
@import url(//fonts.googleapis.com/css?family=Open+Sans:300);
@import url(//fonts.googleapis.com/css?family=Open+Sans:300italic);
@import url(//fonts.googleapis.com/css?family=Pathway+Gothic+One);
@import url(//fonts.googleapis.com/css?family=Dosis:400);
@import url(//fonts.googleapis.com/css?family=Dosis:300);

/****Links****/
.btn-gallery {
  text-decoration: none;
  color: inherit;
  outline: none;
  -webkit-transition: 0.5s ease;
  transition: 0.5s ease;
  font: 18px/20px 'Dosis', sans-serif !important;
  color: #bfd9ee;
  border: 1px solid #bfd9ee;
  display: inline-block;
  padding: 0px 25px 5px;
  margin-top: 16px !important;
  width: 95px  !important;
}
.btn-gallery:hover {
  background-color: #ffffff;
  border-color: #eee;
  color: #f26daf;
}

/****Gallery****/
.box {
  position: relative;
  margin-top: 2px;
  margin-bottom: 15px;
  padding-bottom: 68px;
  overflow: hidden;
}
.box .gall_item {
  position: relative;
  display: block;
}
.box .gall_item img {
  width: 100%;
}
.box .gall_item span {
  -webkit-transition: background-position 0.5s ease;
  transition: background-position 0.5s ease;
  position: absolute;
  display: block;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: url(../img/gallery/magnifyer.png) center -100px no-repeat;
}
.box .gall_item:hover span {
  background-position: center center;
}

.box .gall_item2 {
  position: relative;
  display: block;
}
.box .gall_item2 img {
  width: 100%;
}
.box .gall_item2 span {
  -webkit-transition: background-position 0.5s ease;
  transition: background-position 0.5s ease;
  position: absolute;
  display: block;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: url(../img/gallery/magnifyer.png) center -100px no-repeat;
}
.box .gall_item2:hover span {
  background-position: center center;
}

.box .box_bot {
  background-color: <?php echo $rs_configuracao['cor_fundo_box_galeria'];?>;
  color: #ffffff;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  padding: 7px 26px;
  top: 207px;
  -webkit-transition: 0.5s ease;
  transition: 0.5s ease;
}

.box .box_bot .box_bot_title {
  padding-left: 18px;
  font-size: 24px;
  line-height: 35px;
  font-weight: 300;
  letter-spacing: -1px;
  margin-bottom: 19px;
}

.box .box_bot .btn {
  margin-top: 0;
  border-color: #bfd9ee;
  color: #bfd9ee;
}
.box .box_bot .btn:hover {
  color: #f26daf;
  border-color: #ffffff;
}
.box .box_bot:hover {
  top: 0;
}
.box .box_bot:hover .box_bot_title {
  color: #bfd9ee;
}
.blog .btn {
  margin-top: 28px;
  margin-bottom: 31px;
}
.blog table {
  border-color: #000;
  border-top: 1px solid rgba(50, 48, 69, 0.49);
  width: 100%;
  line-height: 40px;
  position: relative;
  top: 2px;
}
.blog table tr {
  border-color: #000;
  border-bottom: 1px solid rgba(50, 48, 69, 0.49);
}
.blog table .fa {
  font-size: 20px;
  color: #323045;
  min-width: 24px;
  margin-right: 20px;
  line-height: 40px;
}
.blog table td + td .fa {
  margin-right: 5px;
}
.blog table td:first-child {
  width: 278px;
}
.blog table td + td + td {
  text-align: right;
}
.blog table td + td + td .fa {
  margin-right: 40px;
}
.blog + .blog {
  margin-top: 91px;
}


/*==================================RESPONSIVE LAYOUTS===============================================*/
@media only screen and (max-width: 1199px) {
  .extra_wrapper {
    overflow: visible;
  }
  .box .box_bot {
    top: 168px;
  }
  .box .box_bot .box_bot_title {
    padding-left: 0;
  }
  .box p {
    display: none;
  }
  .list-1 li {
    font-size: 18px !important;
    letter-spacing: -1px;
  }
  .list-1 li a {
    padding-left: 40px;
  }
}
@media only screen and (max-width: 979px) {
  .shuffle-me img {
    width: 100%;
  }
  .box .box_bot {
    top: 132px;
  }
  .box .box_bot .box_bot_title {
    font-size: 20px;
  }
  .map figure,
  .map figure iframe,
  #form input,
  #form textarea,
  #form .success {
    width: 100% !important;
    float: none !important;
  }
  #form .success {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .map figure {
    height: auto !important;
    margin-bottom: 15px;
  }
  .nowrap {
    white-space: normal;
  }
  .img_inner.fleft {
    margin-bottom: 20px;
  }
}
@media only screen and (max-width: 767px) {
  .address1 + .address1 {
    margin-left: 60px;
  }
  .box .box_bot {
    top: 235px;
  }
  .sep-1:after {
    left: 30px;
    right: 30px;
  }
  .img_inner,
  .img_inner.fleft,
  .img_inner.img_fright {
    width: 100% !important;
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
    margin-bottom: 20px !important;
    margin-top: 30px;
  }
  .img_inner img,
  .img_inner.fleft img,
  .img_inner.img_fright img {
    width: 100%;
  }
/*  header h1 {
    position: static !important;
    margin-bottom: 20px;
    float: none;
    left: 0;
  }
  header h1 a {
    margin: 0 auto;
    width: 100%;
    display: block;
  }
  header h1 a img {
    display: block;
    margin: 0 auto;
  }
  header .header_top {
    font-size: 18px;
    line-height: 22px;
    padding-top: 20px;
    padding-bottom: 20px;
  }
  header .header_top h1 {
    margin-bottom: 0px;
    font-size: 30px;
    line-height: 32px;
  }
  .map figure iframe {
    height: 300px;
  }
  .content .noresize {
    width: auto !important;
    float: left !important;
    margin-right: 20px !important;
    margin-top: 4px !important;
  }
  .none {
    clear: both;
  }
  .footer_mail {
    font-size: 16px !important;
  }
  .block-1 {
    margin-bottom: 40px;
  }
}*/
@media only screen and (max-width: 479px) {
  .box .box_bot {
    top: 151px;
  }
  .footer_mail {
    font-size: 16px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
  }
}

</style>
