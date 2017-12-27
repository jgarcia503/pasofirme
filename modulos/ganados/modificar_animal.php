<?php
if (isset($_POST['id_animal'])) {
  $params=$_POST;
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-pencil-square-o"></i>&nbsp;Modificar animal
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=vanimales"><i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de animales</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-pencil-square-o"></i>&nbsp;Modificar animal</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Generales</a></li>
        <li><a href="#tab_2" data-toggle="tab">Genealog&iacute;a</a></li>
        <li><a href="#tab_3" data-toggle="tab">Fenotipo</a></li>
        <li><a href="#tab_4" data-toggle="tab">Clase</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <b>How to use:</b>

          <p>Exactly like the original bootstrap tabs except you should use
            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
          A wonderful serenity has taken possession of my entire soul,
          like these sweet mornings of spring which I enjoy with my whole heart.
          I am alone, and feel the charm of existence in this spot,
          which was created for the bliss of souls like mine. I am so happy,
          my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
          that I neglect my talents. I should be incapable of drawing a single stroke
          at the present moment; and yet I feel that I never was a greater artist than now.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          The European languages are members of the same family. Their separate existence is a myth.
          For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
          in their grammar, their pronunciation and their most common words. Everyone realizes why a
          new common language would be desirable: one could refuse to pay expensive translators. To
          achieve this, it would be necessary to have uniform grammar, pronunciation and more common
          words. If several languages coalesce, the grammar of the resulting language is more simple
          and regular than that of the individual languages.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          It has survived not only five centuries, but also the leap into electronic typesetting,
          remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
          sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
          like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <b>How to use:</b>

          <p>Exactly like the original bootstrap tabs except you should use
            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
          A wonderful serenity has taken possession of my entire soul,
          like these sweet mornings of spring which I enjoy with my whole heart.
          I am alone, and feel the charm of existence in this spot,
          which was created for the bliss of souls like mine. I am so happy,
          my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
          that I neglect my talents. I should be incapable of drawing a single stroke
          at the present moment; and yet I feel that I never was a greater artist than now.
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
</section>