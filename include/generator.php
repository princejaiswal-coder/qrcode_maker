        <div class="container">
            <div class="row mt-3">
                <div class="col-md-8 pt-3 mb-3">
                    <div id="alert_placeholder">
                        <?php
                        if (strlen($_ERROR) > 0) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                </button><?php echo $_ERROR; ?>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div class="row bg-white">
                        <form role="form" id="create" class="needs-validation" novalidate>
                            <input type="submit" class="d-none">
                            <input type="hidden" name="section" id="getsec" value="<?php echo $getsection; ?>">

                            <?php
                            /**
                             * QR CODE DATA
                             */ ?>
                            <div class="col-sm-12 pb-2 bg-light">
                                <div class="form-group">
                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                    <?php 
                                    if ($_CONFIG['link'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#link") echo " active"; ?>" href="#link" role="tab" data-toggle="tab"><i class="fa fa-link"></i> <span class="d-none d-sm-inline-block"><?php echo getString('link'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['location'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#location") echo " active"; ?>" href="#location" role="tab" data-toggle="tab"><i class="fa fa-map-marker"></i> <span class="d-none d-sm-inline-block"><?php echo getString('location'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['email'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#email") echo " active"; ?>" href="#email" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span class="d-none d-sm-inline-block"><?php echo getString('email'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['text'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#text") echo " active"; ?>" href="#text" role="tab" data-toggle="tab"><i class="fa fa-align-left"></i> <span class="d-none d-sm-inline-block"><?php echo getString('text'); ?></span></a>
                                        </li>
                                        <?php
                                    }
                                    if ($_CONFIG['tel'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#tel") echo " active"; ?>" href="#tel" role="tab" data-toggle="tab"><i class="fa fa-phone"></i> <span class="d-none d-sm-inline-block"><?php echo getString('phone'); ?></span></a>
                                        </li>
                                        <?php
                                    }
                                    if ($_CONFIG['sms'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#sms") echo " active"; ?>" href="#sms" role="tab" data-toggle="tab"><i class="fa fa-mobile"></i> <span class="d-none d-sm-inline-block"><?php echo getString('sms'); ?></span></a>
                                        </li>
                                        <?php
                                    }
                                    if ($_CONFIG['whatsapp'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#whatsapp") echo " active"; ?>" href="#whatsapp" role="tab" data-toggle="tab"><i class="fa fa-whatsapp"></i> <span class="d-none d-sm-inline-block">WhatsApp</span></a>
                                        </li>
                                        <?php
                                    }
                                    if ($_CONFIG['skype'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#skype") echo " active"; ?>" href="#skype" role="tab" data-toggle="tab"><i class="fa fa-skype"></i> <span class="d-none d-sm-inline-block">Skype</span></a>
                                        </li>
                                        <?php
                                    }
                                    if ($_CONFIG['wifi'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#wifi") echo " active"; ?>" href="#wifi" role="tab" data-toggle="tab"><i class="fa fa-wifi"></i> <span class="d-none d-sm-inline-block"><?php echo getString('wifi'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['vcard'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#vcard") echo " active"; ?>" href="#vcard" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> <span class="d-none d-sm-inline-block"><?php echo getString('vcard'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['paypal'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#paypal") echo " active"; ?>" href="#paypal" role="tab" data-toggle="tab"><i class="fa fa-paypal"></i> <span class="d-none d-sm-inline-block"><?php echo getString('paypal'); ?></span></a>
                                        </li>
                                        <?php
                                    }  
                                    if ($_CONFIG['bitcoin'] == true) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link<?php if ($getsection == "#bitcoin") echo " active"; ?>" href="#bitcoin" role="tab" data-toggle="tab"><i class="fa fa-bitcoin"></i> <span class="d-none d-sm-inline-block"><?php echo getString('bitcoin'); ?></span></a>
                                        </li>
                                        <?php
                                    } ?>
                                    </ul>
                                    <div class="tab-content mt-3">
                                    <?php
                                    require 'tab-link.php';
                                    require 'tab-location.php';
                                    require 'tab-email.php';
                                    require 'tab-text.php';
                                    require 'tab-tel.php';
                                    require 'tab-sms.php';
                                    require 'tab-whatsapp.php';
                                    require 'tab-skype.php';
                                    require 'tab-wifi.php';
                                    require 'tab-vcard.php';
                                    require 'tab-paypal.php';
                                    require 'tab-bitcoin.php';
                                    ?>
                                    </div> <!-- tab content -->
                                </div> <!-- form group -->
                            </div><!-- col sm12-->

                        <div class="accordion-NO" id="collapseAccordion">
                            <h3>
                                <button class="btn btn-outline-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOptions" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo getString('options'); ?>
                                </button>
                            </h3>
                            <div class="collapse show" id="collapseOptions">
                        <?php
                        /**
                         * MAIN QR CODE CONFIG
                         */
                        ?>  
                            <div class="col-sm-12 mb-2">
                                <div class="row">
                                    <div class="col-6">
                                        <label><?php echo getString('size'); ?></label>
                                        <select name="size" class="custom-select qrcode-size-selector">
                                    <?php
                                    for ($i=8; $i<=32; $i+=4) {
                                        $value = $i*25;
                                        echo '<option value="'.$i.'" '.( $matrixPointSize == $i ? 'selected' : '' ) . '>'.$value.'</option>';
                                    }; ?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label><?php echo getString('error_correction_level'); ?></label>
                                        <select name="level" class="custom-select">
                                            <option value="L" <?php if ($errorCorrectionLevel=="L") echo "selected"; ?>>
                                                <?php echo getString('precision_l'); ?>
                                            </option>
                                            <option value="M" <?php if ($errorCorrectionLevel=="M") echo "selected"; ?>>
                                                <?php echo getString('precision_m'); ?>
                                            </option>
                                            <option value="Q" <?php if ($errorCorrectionLevel=="Q") echo "selected"; ?>>
                                                <?php echo getString('precision_q'); ?>
                                            </option>
                                            <option value="H" <?php if ($errorCorrectionLevel=="H") echo "selected"; ?>>
                                                <?php echo getString('precision_h'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2 custom-background">
                                <div class="row">
                                    <div class="col-6">
                                        <label><?php echo getString('background'); ?></label>
                                        <div class="collapse" id="collapse-background">
                                            <div class="input-group qrcolorpicker colorpickerback">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </div>
                                                <input type="text" class="form-control" data-format="hex" 
                                                value="<?php echo $stringbackcolor; ?>" name="backcolor">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-switch mt-2">
                                  <input type="checkbox" class="custom-control-input" id="trans-bg" name="transparent">
                                  <label class="custom-control-label" for="trans-bg"><?php echo getString('transparent_background'); ?></label>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label><?php echo getString('foreground'); ?></label>
                                        <div class="input-group qrcolorpicker mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex" 
                                            value="<?php echo $stringfrontcolor; ?>" name="frontcolor">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                              <input type="checkbox" class="custom-control-input" id="gradient-bg" name="gradient">
                                              <label class="custom-control-label" for="gradient-bg"><?php echo getString('gradient'); ?></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="collapse" id="collapse-gradient">
                                            <label><?php echo getString('second_color'); ?></label>
                                            <div class="input-group qrcolorpicker mb-2" id="collapse-gradient">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </div>
                                                <input type="text" class="form-control qrcolorpicker_bg" data-format="hex" 
                                                value="#8900D5" name="gradient_color">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                  <input type="checkbox" class="custom-control-input" id="radial-gradient" name="radial">
                                                  <label class="custom-control-label" for="radial-gradient"><?php echo getString('radial'); ?></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="row collapse" id="collapse-markers-bg">
                                    <div class="col-6">
                                        <label><?php echo getString('marker_outline'); ?></label>
                                        <div class="input-group qrcolorpicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex" value="<?php echo $stringfrontcolor; ?>" name="marker_out_color">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label><?php echo getString('marker_center'); ?></label>
                                        <div class="input-group qrcolorpicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-format="hex" 
                                            value="<?php echo $stringfrontcolor; ?>" name="marker_in_color">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <div class="custom-control custom-switch">
                                      <input type="checkbox" class="custom-control-input" id="markers-bg" name="markers_color">
                                      <label class="custom-control-label" for="markers-bg"><?php echo getString('custom_markers_colors'); ?></label>
                                    </div>
                                </div>
                            </div>


                            <?php
                            require dirname(dirname(__FILE__)).'/lib/markers.php';

                            $patterns = $markersIn;
                            unset($patterns['flurry']);
                            unset($patterns['sun']);

                            $styleselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                            foreach ($patterns as $pattern => $style) {
                                $activeattr = ($pattern == 'default') ? 'checked' : '';
                                $styleselecta .= '<label class="btn btn-light p-1">
                                    <input type="radio" name="pattern" value="'.$pattern.'" '.$activeattr.'>
                                    <svg width="10" height="10" viewBox="0 0 7 7" xmlns="http://www.w3.org/2000/svg">'.$style['path'].'</svg>
                                </label>';
                            }
                            $styleselecta .= '</div>';

                            $markerselecta = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                            foreach ($markers as $marker => $values) {
                                $activeattr = ($marker == 'default') ? 'checked' : '';
                                $markerselecta .= '<label class="btn btn-light p-1">
                                    <input type="radio" name="marker" value="'.$marker.'" '.$activeattr.'>
                                    <svg width="32" height="32" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
                                </label>';
                            }

                            $markerselecta .= '</div>';

                            $markerselectaIn = '<div class="btn-group-toggle styleselecta d-inline-block" data-toggle="buttons">';

                            foreach ($markersIn as $marker => $values) {
                                $activeattr = ($marker == 'default') ? 'checked' : '';
                                $markerselectaIn .= '<label class="btn btn-light p-1">
                                    <input type="radio" name="marker_in" value="'.$marker.'" '.$activeattr.'>
                                    <svg width="20" height="20" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
                                </label>';
                            }

                            $markerselectaIn .= '</div>';

                            ?>
                            <div class="col-sm-12">
                                <label><?php echo getString('pattern'); ?></label>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <?php echo $styleselecta; ?>
                            </div>

                            <div class="col-sm-12">
                                <label><?php echo getString('marker_outline'); ?></label>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <?php echo $markerselecta; ?>
                            </div>

                            <div class="col-sm-12">
                                <label><?php echo getString('marker_center'); ?></label>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <?php echo $markerselectaIn; ?>
                            </div>
                        </div>

                        <h3>
                            <button class="btn btn-outline-primary btn-lg btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseWatermark" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo getString('logo'); ?>
                            </button>
                        </h3>
                        <div class="collapse show" id="collapseWatermark">
                    <?php
                    if ($_CONFIG['uploader'] == true) { ?>
                        <div class="col-12 py-2">
                            <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input" aria-describedby="validate-upload" id="upmarker">
                                <div id="validate-upload" class="invalid-feedback">
                                    <?php echo getString('invalid_image'); ?>
                                </div>
                              <label class="custom-file-label" for="file"><?php echo getString('upload_or_select_watermark'); ?></label>
                            </div>
                          </div>
                        <?php
                    }
                    /**
                    * Watermarks
                    */

                    //
                    // Default watermarks
                    //
                    $waterdir = "images/watermarks/";
                    $watermarks = glob($waterdir.'*.{gif,jpg,png}', GLOB_BRACE);
                    $count = count($watermarks);
                    if ($_CONFIG['uploader'] == true || $count > 0) { ?>
                        <div class="col-12 pt-2">
                            <div class="logoselecta form-group">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light p-1" data-toggle="tooltip" data-placement="bottom">
                                        <input type="radio" name="optionlogo" value="none" checked="">
                                        <img class="img-fluid" src="images/x.png">
                                    </label>
                                    <?php 
                                    foreach ($watermarks as $key => $water) {
                                        echo '<label class="btn btn-light p-1';
                                        if ($optionlogo == $water) echo ' active ';
                                        echo '" data-toggle="tooltip" data-placement="bottom">
                                        <input type="radio" name="optionlogo" value="'.$water.'"';
                                        if ($optionlogo == $water) echo ' checked';
                                        echo ' id="optionlogo'.$key.'"><img src="'.$water.'"></label>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                    ?>
                        </div>
                        </div><!-- collapse -->

                        </form>
                    </div> <!-- row -->
                </div><!-- col sm-8 -->

                <div class="col-md-4 sticky-top">
                    <nav class="navbar sticky-top navbar-light bg-light">
                    <?php 
                    //
                    // FINAL QR CODE placeholder
                    //
                    ?>
                    <div class="placeresult">
                        <div class="form-group text-center wrapresult">
                            <div class="resultholder">
                                <img class="img-fluid" id="qrcoded" src="<?php echo $_CONFIG['placeholder']; ?>" />
                                <div class="infopanel"></div>
                            </div>
                        </div>
                        <div class="preloader"><i class="fa fa-cog fa-spin"></i></div>
                        <div class="form-group text-center linksholder"></div>
                        <button class="btn btn-lg btn-block btn-primary ellipsis" id="submitcreate">
                        <i class="fa fa-magic"></i> <?php echo getString('generate_qrcode'); ?></button>
                    </div>
                    <?php
                    if (file_exists(dirname(dirname(__FILE__)).'/template/sidebar.php')) {
                        include dirname(dirname(__FILE__)).'/template/sidebar.php';
                    }
                    ?>
                    </nav>
                </div><!-- col md-4-->
            </div><!-- row -->
        </div><!-- container -->
