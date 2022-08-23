<?php $CI =& get_instance();?>
<!-- icheck -->
<link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">


<link href="<?php echo base_url();?>/assets/css/themes/theme-pmms.css" rel="stylesheet" />

<!-- Steps Css -->
<link href="<?php echo base_url();?>/assets/css/mstepper.min.css" rel="stylesheet">

<!-- Sweetalert Css -->
<link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>Project Tender/RAP Publishing</h4>
        </div>

        <!-- Alert Message -->
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $this->session->flashdata('danger'); ?>
                    </div>
                <?php } ?>
            </div>        

        </div>
        <!-- End Alert Message -->
        <!-- Steps start -->
        
        <?php
        project_steps($project_id);
        ?>

        <!-- Steps end -->
        

        <?php

        project_info($project_id);

        ?>


        <?php echo form_open_multipart('Project_tender_publishing/manage?project_id='.base64_encode($project_id),array('name'=> 'project_tender_publishing','id'=>'project_tender_publishing_form')); ?>
        
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Tender/RFP Publishing Stage</h2>
                    </div>

                    <div class="body">

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP ID  <span class="col-pink">* </span></b>
                                    
                                </p>
                                <input class="form-control" value="<?php echo !empty($result['tender_ref_no']) ? $result['tender_ref_no'] : $_REQUEST['tender_ref_no']; ?>" name="tender_ref_no" type="text" placeholder="Enter Tender Reference number">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('tender_ref_no'); ?></span>

                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Name <span class="col-pink">* </span></b>

                                </p>
                                <input class="form-control" value="<?php echo !empty($result['tender_name']) ? $result['tender_name'] : $_REQUEST['tender_name']; ?>" name="tender_name" type="text" placeholder="Enter Tender Name">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('tender_name'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Short Name </b>

                                </p>


                                <input class="form-control" value="<?php echo !empty($result['tender_short_name']) ? $result['tender_short_name'] : $_REQUEST['tender_short_name']; ?>" name="tender_short_name" type="text" placeholder="Enter Tender Short Name">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('tender_short_name'); ?></span>
                            </div>
                            

                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Type (Coverage)</b>

                                </p>
                                
                                <select name="tender_type_coverage" class="form-control show-tick">
                                    <option <?php echo ($_REQUEST['tender_type_coverage'] == 'open'|| $result['tender_type_coverage']  == 'open') ? "selected" :''; ?>  value="open">Open Tender</option>
                                    <option <?php echo ($_REQUEST['tender_type_coverage'] == 'closed'|| $result['tender_type_coverage']  == 'closed') ? "selected" :''; ?> value="closed">Limited Tender</option>
                                    <option <?php echo ($_REQUEST['tender_type_coverage'] == 'callnotice'|| $result['tender_type_coverage']  == 'callnotice') ? "selected" :''; ?> value="callnotice">Quotation Call Notice</option>
                                    <option <?php echo ($_REQUEST['tender_type_coverage'] == 'shortcallnotice'|| $result['tender_type_coverage']  == 'shortcallnotice') ? "selected" :''; ?> value="shortcallnotice">Short Quotation Call Notice</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Type (Geography) </b>

                                </p>
                                <select name="tender_type_geography" class="form-control show-tick">
                                    <option <?php echo ($_REQUEST['tender_type_geography'] == 'Local'|| $result['tender_type_geography']  == 'Local') ? "selected" :''; ?>  value="Local">Local</option>
                                    <option <?php echo ($_REQUEST['tender_type_geography'] == 'national'|| $result['tender_type_geography']  == 'national') ? "selected" :''; ?> value="national">National</option>
                                    <option <?php echo ($_REQUEST['tender_type_geography'] == 'both'|| $result['tender_type_geography']  == 'both') ? "selected" :''; ?> value="national">Both</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Type (Procurement) </b>

                                </p> <select name="tender_type_precurement" class="form-control show-tick" id="qcbs-sel">
                                    <option <?php echo ($_REQUEST['tender_type_precurement'] == 'LCBS'|| $result['tender_type_precurement']  == 'LCBS') ? "selected" :''; ?>  value="LCBS">LCBS</option>
                                    <option <?php echo ($_REQUEST['tender_type_precurement'] == 'QCBS'|| $result['tender_type_precurement']  == 'QCBS') ? "selected" :''; ?> value="QCBS">QCBS</option>
                                </select>

                            </div>
                            
                        </div>
                        <div id="on-select-qcbs">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <div class="row">

                                        <div class="col-md-5">
                                            <p>
                                                &nbsp; <!-- <b><span class="col-pink">* </span></b> -->
                                            </p>
                                            <input type="text" class="form-control" id="fname" name="primeval" value="<?php echo $result['prime_value'] ?>">
                                        </div>
                                        <div class="col-md-2 p-0 align-center">
                                            <p>&nbsp;</p>
                                            <p class="text-center">/</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>
                                                &nbsp;
                                                <!-- <b><span class="col-pink">* </span></b> -->
                                            </p>
                                            <input type="text" class="form-control" id="lname" name="autoval"  readonly="" value="<?php echo $result['auto_value'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">

                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Publishing Date<span class="col-pink">* </span></b>

                                </p>

                                <input type="text" name="tender_publishing_date"
                                value="<?php echo !empty($result['tender_publishing_date']) ? $result['tender_publishing_date']  : $_REQUEST['tender_publishing_date']; ?>"
                                class="datepicker form-control" placeholder="Please Choose a Date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('tender_publishing_date'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Tender/RFP Start Date<span class="col-pink">* </span></b>

                                </p>

                                <input type="text" id="" name="tender_start_date"
                                value="<?php echo !empty($result['tender_start_date']) ? $result['tender_start_date']  : $_REQUEST['tender_start_date']; ?>"

                                class="datepicker form-control" placeholder="Please Choose a Date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('tender_start_date'); ?></span>

                            </div>

                            <div class="col-md-4">
                                <p>
                                    <b>Consortium Allowed</b>
                                </p>
                                <select class="form-control" name="dpr_consortium_allowed">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>

                                </select>
                            </div>
                            

                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Bid Submission Date<span class="col-pink">* </span></b>

                                </p>
                                <input type="text" name="bid_submission_date"
                                value="<?php echo !empty($result['bid_submission_date']) ? $result['bid_submission_date']  : $_REQUEST['bid_submission_date']; ?>"
                                id="" class="datepicker form-control" placeholder="Please Choose a Date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('bid_submission_date'); ?></span>

                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Pre-Bid Conference Venue </b>

                                </p>

                                <input type="text" name="pre_bid_conf_venue"
                                value="<?php echo !empty($result['pre_bid_conf_venue']) ? $result['pre_bid_conf_venue']  : $_REQUEST['pre_bid_conf_venue']; ?>"
                                class="form-control" placeholder="Enter pre-bid Conference Venue">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('pre_bid_conf_venue'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Pre-Bid Conference Date</b>

                                </p>

                                <input type="text" id="approve" name="pre_bid_conf_date"
                                value="<?php echo !empty($result['pre_bid_conf_date']) ? $result['pre_bid_conf_date']  : $_REQUEST['pre_bid_conf_date']; ?>"

                                class="datepicker form-control" placeholder="Please Choose a Date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('pre_bid_conf_date'); ?></span>

                            </div>
                            

                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Pre-Bid Conference Time </b>

                                </p>
                                <input type="text" name="pre_bid_conf_time"
                                value="<?php echo !empty($result['pre_bid_conf_time']) ? $result['pre_bid_conf_time']  : $_REQUEST['pre_bid_conf_time']; ?>"
                                class="timepicker form-control" placeholder="Please Choose a Time...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('pre_bid_conf_time'); ?></span>

                            </div>

                            <div class="col-md-4">
                                <p>
                                    <b>DPR Value(₹)</b>
                                </p>

                                <input type="text" name="put_tender_value" value="<?php echo !empty($result['put_tender_value']) ? number_format($result['put_tender_value'],2) : "0.00"; ?>"
                                class="form-control" placeholder="Enter DPR Value">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('put_tender_value'); ?></span>
                            </div>

                            

                        </div>


                    </div>

                    <div class="row clearfix">









                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ++++++++++++++++++++++++ -->
        <div class="row Tender-RFP-Sec clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                <div class="header">
                    <h2>Tender/RFP Publishing Stage - Schedule Of Events</h2>
                </div>
                <div class="body">
                    <div class="">
                        <!-- <div class="row">
                            <div class="col-lg-12"><b></b></div>
                        </div> -->
                        <div class="row desktop">
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="input_lebel">
                                            <b>Date<span class="col-pink">* </span></b> 
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="input_lebel">
                                            <b>Time<span class="col-pink">* </span></b>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="input_lebel">
                                            <b>Venue<span class="col-pink">* </span></b>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>RFP Publication</b>        
                                    </p>

                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                        <div class="col-md-4">


                                            <p class="input_lebel">
                                                <b>Date<span class="col-pink">* </span></b> 
                                            </p>
                                            <input type="hidden" name="event_type[]" value="rap_publication">
                                            <input class="form-control datepicker" value="<?=  ($rap_publication['event_date']!='0000-00-00')?$rap_publication['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                        </div>
                                        <div class="col-md-4">




                                            <p class="input_lebel">
                                                <b>Time<span class="col-pink">* </span></b>

                                            </p>
                                            
                                            <input class="form-control timepicker" value="<?= !empty($rap_publication['event_time'])?$rap_publication['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                        </div>
                                        <div class="col-md-4">




                                            <p class="input_lebel">
                                                <b>Venue<span class="col-pink">* </span></b>

                                            </p>
                                            <input class="form-control" value="<?= !empty($rap_publication['event_venue'])?$rap_publication['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Last Date Of Pre-Bid Query</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                        <p class="input_lebel">
                            <b>Date<span class="col-pink">* </span></b> 
                        </p>
                        <input type="hidden" name="event_type[]" value="last_date_of_pre_bid_query">
                        <input class="form-control datepicker" value="<?= ($last_date_of_pre_bid_query['event_date']!='0000-00-00')?$last_date_of_pre_bid_query['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                        </div>
                        <div class="col-md-4">




                        <p class="input_lebel">
                            <b>Time<span class="col-pink">* </span></b>

                        </p>
                        <input class="form-control timepicker" value="<?= !empty($last_date_of_pre_bid_query['event_time'])?$last_date_of_pre_bid_query['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                        </div>
                        <div class="col-md-4">




                        <p class="input_lebel">
                            <b>Venue<span class="col-pink">* </span></b>

                        </p>
                        <input class="form-control" value="<?= !empty($last_date_of_pre_bid_query['event_venue'])?$last_date_of_pre_bid_query['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                        </div>
                                                            </div>
                                </div>
                            </div>
                        </div>

                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Pre-Bid Meeting</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                             <div class="col-md-4">


                                    <p class="input_lebel">
                                        <b>Date<span class="col-pink">* </span></b> 
                                    </p>
                                    <input type="hidden" name="event_type[]" value="prebid_meeting">
                                    <input class="form-control datepicker" value="<?= ($prebid_meeting['event_date']!='0000-00-00')?$prebid_meeting['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Time<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control timepicker" value="<?= !empty($prebid_meeting['event_time'])?$prebid_meeting['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Venue<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control" value="<?= !empty($prebid_meeting['event_venue'])?$prebid_meeting['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Last Date Of Publishing Corrigendum</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                                        <p class="input_lebel">
                                            <b>Date<span class="col-pink">* </span></b> 
                                        </p>
                                        <input type="hidden" name="event_type[]" value="last_date_of_publishing_corrigendum">
                                        <input class="form-control datepicker" value="<?= ($last_date_of_publishing_corrigendum['event_date']!='0000-00-00')?$last_date_of_publishing_corrigendum['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                        </div>
                                        <div class="col-md-4">




                                        <p class="input_lebel">
                                            <b>Time<span class="col-pink">* </span></b>

                                        </p>
                                        <input class="form-control timepicker" value="<?= !empty($last_date_of_publishing_corrigendum['event_time'])?$last_date_of_publishing_corrigendum['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                        </div>
                                        <div class="col-md-4">




                                        <p class="input_lebel">
                                            <b>Venue<span class="col-pink">* </span></b>

                                        </p>
                                        <input class="form-control" value="<?= !empty($last_date_of_publishing_corrigendum['event_venue'])?$last_date_of_publishing_corrigendum['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                        </div>
                                                                            </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Last Date Of Receipt Of Tender Document</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                                        <p class="input_lebel">
                                            <b>Date<span class="col-pink">* </span></b> 
                                        </p>
                                        <input type="hidden" name="event_type[]" value="last_date_of_receipt_of_tender_document">
                                        <input class="form-control datepicker" value="<?=  ($last_date_of_receipt_of_tender_document['event_date']!='0000-00-00')?$last_date_of_receipt_of_tender_document['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                        </div>
                                        <div class="col-md-4">




                                        <p class="input_lebel">
                                            <b>Time<span class="col-pink">* </span></b>

                                        </p>
                                        <input class="form-control timepicker" value="<?= !empty($last_date_of_receipt_of_tender_document['event_time'])?$last_date_of_receipt_of_tender_document['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                        </div>
                                        <div class="col-md-4">




                                        <p class="input_lebel">
                                            <b>Venue<span class="col-pink">* </span></b>

                                        </p>
                                        <input class="form-control" value="<?= !empty($last_date_of_receipt_of_tender_document['event_venue'])?$last_date_of_receipt_of_tender_document['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                        </div>
                                                                            </div>
                                </div>
                            </div>
                        </div>






                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Opening Of Bid</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="opening_of_general_bid">
                            <input class="form-control datepicker" value="<?= ($opening_of_general_bid['event_date']!='0000-00-00')?$opening_of_general_bid['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($opening_of_general_bid['event_time'])?$opening_of_general_bid['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($opening_of_general_bid['event_venue'])?$opening_of_general_bid['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Publication Of Qualified Bidders Of General Bid.</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                                    <p class="input_lebel">
                                        <b>Date<span class="col-pink">* </span></b> 
                                    </p>
                                    <input type="hidden" name="event_type[]" value="publication_of_qualified_bidders_of_general_bid">
                                    <input class="form-control datepicker" value="<?= ($publication_of_qualified_bidders_of_general_bid['event_date']!='0000-00-00')?$publication_of_qualified_bidders_of_general_bid['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Time<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control timepicker" value="<?= !empty($publication_of_qualified_bidders_of_general_bid['event_time'])?$publication_of_qualified_bidders_of_general_bid['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Venue<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control" value="<?= !empty($publication_of_qualified_bidders_of_general_bid['event_venue'])?$publication_of_qualified_bidders_of_general_bid['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                    </div>
                                                                        </div>
                                </div>
                            </div>
                        </div>





                         <!-- <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Opening/Evaluation Of General Bid</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                                    <p class="input_lebel">
                                        <b>Date<span class="col-pink">* </span></b> 
                                    </p>
                                    <input type="hidden" name="event_type[]" value="evaluation_of_general_bid">
                                    <input class="form-control datepicker" value="<?= ($evaluation_of_general_bid['event_date']!='0000-00-00')?$evaluation_of_general_bid['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Time<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control timepicker" value="<?= !empty($evaluation_of_general_bid['event_time'])?$evaluation_of_general_bid['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                                    </div>
                                    <div class="col-md-4">




                                    <p class="input_lebel">
                                        <b>Venue<span class="col-pink">* </span></b>

                                    </p>
                                    <input class="form-control" value="<?= !empty($evaluation_of_general_bid['event_venue'])?$evaluation_of_general_bid['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->






                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Evaluation Of Technical Bid</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">


                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="evaluation_of_technical_bid">
                            <input class="form-control datepicker" value="<?= ($evaluation_of_technical_bid['event_date']!='0000-00-00')?$evaluation_of_technical_bid['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($evaluation_of_technical_bid['event_time'])?$evaluation_of_technical_bid['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($evaluation_of_technical_bid['event_venue'])?$evaluation_of_technical_bid['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
                                                                </div>
                                </div>
                            </div>
                        </div>





                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Presentation Schedule</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">
      
                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="presentation_schedule">
                            <input class="form-control datepicker" value="<?= ($presentation_schedule['event_date']!='0000-00-00')?$presentation_schedule['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($presentation_schedule['event_time'])?$presentation_schedule['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($presentation_schedule['event_venue'])?$presentation_schedule['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
       
                                    </div>
                                </div>
                            </div>
                        </div>




                         <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Publication Of Technically Qualified Bidders</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">
      
                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="publication_of_technically_qualified_bidders">
                            <input class="form-control datepicker" value="<?= ($publication_of_technically_qualified_bidders['event_date']!='0000-00-00')?$publication_of_technically_qualified_bidders['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($publication_of_technically_qualified_bidders['event_time'])?$publication_of_technically_qualified_bidders['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($publication_of_technically_qualified_bidders['event_venue'])?$publication_of_technically_qualified_bidders['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
       
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Opening Of Financials</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">
     
                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="opening_of_financials">
                            <input class="form-control datepicker" value="<?= ($opening_of_financials['event_date']!='0000-00-00')?$opening_of_financials['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($opening_of_financials['event_time'])?$opening_of_financials['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($opening_of_financials['event_venue'])?$opening_of_financials['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
       
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Evaluation Of Financial Bids</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">
     
                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="evaluation_of_financial_bids">
                            <input class="form-control datepicker" value="<?= ($evaluation_of_financial_bids['event_date']!='0000-00-00')?$evaluation_of_financial_bids['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($evaluation_of_financial_bids['event_time'])?$evaluation_of_financial_bids['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($evaluation_of_financial_bids['event_venue'])?$evaluation_of_financial_bids['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
       
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="s_o_e">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mobile">
                                        <b>Declaration Of Results</b>        
                                    </p>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="row mobile">
                                    <div class="col-md-4">

                            <p class="input_lebel">
                                <b>Date<span class="col-pink">* </span></b> 
                            </p>
                            <input type="hidden" name="event_type[]" value="declaration_of_results">
                            <input class="form-control datepicker" id="approve" value="<?= ($declaration_of_results['event_date']!='0000-00-00')?$declaration_of_results['event_date']:'' ?>" name="event_date[]" type="text" placeholder="Enter Date">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Time<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control timepicker" value="<?= !empty($declaration_of_results['event_time'])?$declaration_of_results['event_time']:'' ?>" name="event_time[]" type="text" placeholder="Enter Time">
                            </div>
                            <div class="col-md-4">




                            <p class="input_lebel">
                                <b>Venue<span class="col-pink">* </span></b>

                            </p>
                            <input class="form-control" value="<?= !empty($declaration_of_results['event_venue'])?$declaration_of_results['event_venue']:'' ?>" name="event_venue[]" type="text" placeholder="Enter Venue Name">
                            </div>
       
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- ++++++++++++++++++++++++ -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Attachment - Tender/RFP Publishing</h2>
                </div>

                <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                                <div class="col-md-4">
                                    <p id="fname_1" class="fname">
                                        <b>File Name</b>

                                    </p>
                                    <input class="form-control" id="file_name" name="file_name" type="text"  placeholder="Enter File Name">

                                    <span id="file_name_err_status" style='color:#ff0000'></span>
                                </div>
                                <div class="col-md-4">
                                    <p id="title_1" class="fname">
                                        <b>Upload file  (Size Limit Maximum 50 MB Each)</b>

                                        (Extension Allowed pdf, docx, xls, xlsx, jpg, jpeg, png)
                                    </p>

                                    <input  type="file" id="fileupload" name="fileupload">
                                    <span id="upload_err_status" style='color:#ff0000'></span>
                                </div>

                                <div class="col-md-1  p-t-25">





                                    <button class="btn bg-blue waves-effect" type="button" onclick="submitFile();"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>


                                </div>

                                <h3 id="status"></h3>
                                <p id="loaded_n_total"></p>
                            </div>
                            <div class="col-md-6 col-md-offset-3"  id="progressBar_new" style="display: none;">

                                <div class="progress">
                                    <div id="progressbar_new_value" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        0%
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                   // print_r($steps_files);

                        ?>
                        <div class="row clearfix">
                            <div class="col-md-6 table-responsive" <?php if(empty($steps_files) && empty($post_steps_files['file_name'])){ ?>style="display: none;" <?php } ?> id="documentsData">
                                <table id="docTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                  <tr>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th></th>
                                </tr>
                                <?php
                                if(!empty($post_steps_files['file_name'])){
                                    foreach ($post_steps_files['file_name'] as $key => $file_name_val) {
                                       $file_link = base_url().'uploads/temp/'.($post_steps_files['file_url'][$key]);
                                       $path = 'uploads/temp/'.($post_steps_files['file_url'][$key]);
                                       $file_size = filesize($path);
                                       $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float p-r-10" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';

                                       $input_data = '<input type="hidden" name="hidden_file_name[]" value="'.$file_name_val.'"><input type="hidden" name="hidden_file_url[]" value="'.$post_steps_files['file_url'][$key].'">';
                                       ?>
                                       <tr>
                                        <?php echo $input_data; ?>
                                        <td><?php echo $file_name_val; ?></td>
                                        <td><?php echo formatSizeUnits($file_size); ?></td>
                                        <td><?php echo $file_d_link; ?></td>
                                    </tr>


                                <?php } }
                                if(!empty($steps_files)){ 
                                    foreach ($steps_files as $files) {
                                        $file_name = $files['file_name'];
                                        $file_path = $files['file_path'];
                                        $file_id = $files['document_id'];
                                        $file_link = base_url().'uploads/attachment/'.$file_path;

                                        $path1 = 'uploads/attachment/'.$file_path;
                                        $file_size1 = filesize($path1);

                                        $file_d_link1 = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                                        $input_data = '<input type="hidden" name="db_hidden_file_id[]" value="'.$file_id.'"><input type="hidden" name="db_hidden_file_name[]" value="'.$file_name.'"><input type="hidden" name="db_hidden_file_url[]" value="'.$file_path.'">';
                                        ?>
                                        <tr>
                                            <?php echo $input_data; ?>
                                            <td><?php echo $file_name; ?></td>
                                            <td><?php echo formatSizeUnits($file_size1); ?> </td>
                                            <td><?php echo $file_d_link1; ?></td>
                                        </tr>

                                    <?php } }  ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="draft_mode" id="draft_mode" value="">
                    <div class="col-md-12 align-center">


                        <?php
                        if($result['draft_mode']  == 'Y' || empty($project_tender_status)){
                            ?>
                            <button class="btn btn-success waves-effect" type="submit" name="draft_btn" id="draft_btn" value="Draft">SAVE DRAFT</button>
                        <?php }else{ ?>
                           <a href="<?php echo base_url().'project_list/pip_tender_publishing' ?>" class="btn btn-warning waves-effect">CANCEL</a>
                       <?php } ?>

                       <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" value="Submit"><?php if($result['draft_mode']  == 'Y' || empty($project_tender_status)){ echo 'SUBMIT'; }else{ echo 'UPDATE'; } ?></button>

                   </div>
                   <div class="clearfix"></div>
               </div>
           </div>
       </div>
   </div>
   <!-- Select -->
</form>
</div>
</section>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">

    var tentype = "<?php echo $result['tender_type_precurement']; ?>";

    if(tentype == 'QCBS') {
        $('#on-select-qcbs').show();
    }
    else {
        $('#on-select-qcbs').hide();
    }

    $("#fname").keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
    });

    $('#qcbs-sel').change(function(){
     if($('#qcbs-sel option:selected').text() == "QCBS"){
        $('#on-select-qcbs').show();
    }
    else{
        $('#on-select-qcbs').hide();
    }
});

    $("#fname").keyup(function(){
     var total = 100;
     var fval = this.value;
     if(fval > 100) {

        alert('Value should less than 100');
        $("#fname").val('0');
        $("#lname").val('0');

    }
    else {
        $("#lname").val(100 - fval);
    }

})
</script>
<script>

    $(function () {
        $("#fname_99,#title_99,#tr_9999999").hide();
        $(document.body).on('click', "[id^='del_']", function () {

            var elementId = $(this).attr('id');
            var id = elementId.split("_");
            var prev_id = $('#amount_brkup_tbl > #tr_'+id[1] ).prev().attr('id');
            var next_id = $('#amount_brkup_tbl > #tr_'+id[1] ).next().attr('id');
            var temp_id = '';
            if( prev_id && !next_id ){
                temp_id = prev_id.split("_");
            }else if( !prev_id && next_id ){
                temp_id = next_id.split("_");
            }
            if(temp_id == '0000'){
                $("#fname_99").show();
                $("#title_99").show();

            }else{
                if( temp_id != '' ){
                    $("#fname_"+temp_id[1]).show();
                    $("#title_"+temp_id[1]).show();
                    $("#fname_99,#title_99").hide();
                }

            }
            $("#tr_"+id[1]).remove();

        });


    });
    
</script>



<script type="text/javascript">

    function _(el) {
      return document.getElementById(el);
  }

  function submitFile() {
      var file = _("fileupload").files[0];
      var file_name = _("file_name").value;
      if(file_name && file){
        if(file.size < 50000000){
           _("file_name_err_status").innerHTML = "";
           _("upload_err_status").innerHTML = "";   
   //alert(file.name+" | "+file.size+" | "+file.type);
   _("submit_btn").disabled = true;
   var formdata = new FormData();
   formdata.append("file1", file);
   formdata.append("file_name", file_name);
   var ajax = new XMLHttpRequest();
   ajax.upload.addEventListener("progress", progressHandler, false);
   ajax.addEventListener("load", completeHandler, false);
   ajax.addEventListener("error", errorHandler, false);
   ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "<?php echo base_url('project/file_upload_data'); ?>"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
  _("file_name").value = "";
  _("fileupload").value = "";
  //document.getElementById("uploadCaptureInputFile").value = "";
}else{
    _("file_name_err_status").innerHTML = "";
    _("upload_err_status").innerHTML = "Max File size allowed 50 MB."; 
}
}else if(file_name == ''){
 _("file_name_err_status").innerHTML = "The File name field is required."; 

}else{
    _("file_name_err_status").innerHTML = "";
    _("upload_err_status").innerHTML = "The File is required.";   
}
}

function progressHandler(event) {
  //_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
  _("file_upload_div").style.display = "none";
  _("progressBar_new").style.display = "block";
  var percent = (event.loaded / event.total) * 100;
  //_("progressBar").value = Math.round(percent);
  _("progressbar_new_value").style.width = Math.round(percent)+"%";
  _("progressbar_new_value").innerHTML = Math.round(percent) + "%";
}

const docTable = document.getElementById('docTable');

function completeHandler(event) {
    _("documentsData").style.display = "block";
    _("progressBar_new").style.display = "none";
    _("file_upload_div").style.display = "block";

    //alert(event.target.responseText);
     //_("upload_err_status").innerHTML = event.target.responseText; 

  //_("status").innerHTML = event.target.responseText;
  if(event.target.responseText != 'No') {
      let content = docTable.innerHTML;
      content += event.target.responseText;
      docTable.innerHTML = content;
  } else {
      _("upload_err_status").innerHTML = "Upload Failed!! Please Try again";  
  }
  _("submit_btn").disabled = false;
  setTimeout(function(){
   _("file_alert").style.display = "none";
}, 3000);
  _("progressBar_new").value = 0; //wil clear progress bar after successful upload
}

function errorHandler(event) {
  _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}

function showCancelMessage() {

}

function deleteRow(r) {

    swal({
        title: "Are you sure you want to delete this file?",
        text: "You can't undo this action",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
          var i = r.parentNode.parentNode.rowIndex;
          document.getElementById("docTable").deleteRow(i);
      }
  });

}
</script>



<!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });
</script>
<!-- ENd Alert Page js for hide alert  -->

<script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
</script>



<script type="text/javascript">
    $('#submit_btn').click(function(e){
        e.preventDefault();
        $("#draft_mode").val('S');
        swal({
            title: "Are you sure you want to save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32CD32",
            confirmButtonText: "Yes!",
            cancelButtonText: "Cancel",
            closeOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {

              $("#project_tender_publishing_form").submit();
          }else{
              return false;
          }
      });
    });

    $('#draft_btn').click(function(e){
        e.preventDefault();
        $("#draft_mode").val('D');

        swal({
            title: "Are you sure you want to save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32CD32",
            confirmButtonText: "Yes!",
            cancelButtonText: "Cancel",
            closeOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {

              $("#project_tender_publishing_form").submit();
          }else{
              return false;
          }
      });
    });


</script>