<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Infrastructure </h2>
        </div>  

        <?php
if(!empty($tree_cutting_data)){

       


        $forest_div_data = $CI->get_specific_data_against_value('forest_division_master','id',$tree_cutting_data[0]['forest_division_id'],'division_name');

        ?>
   <div class="table-responsive">
   
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Department Approval *  </td>
                    <td><?php echo $tree_cutting_data[0]['dept_approve']; ?></td>
                    <td  width=310px> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>Department Budget * </td>
                    <td><?php echo $tree_cutting_data[0]['dept_budge']; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Department Go Live Target Date * </td>
                    <td><?php echo $tree_cutting_data[0]['target_date']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Department Stake Holder</td>
                    <td><?php echo $tree_cutting_data[0]['dept_stakehold']; ?></td>
                </tr>
                <!-- <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Relinquishment proposal submitted </td>
                    <td><?php //echo $tree_cutting_data[0]['status_relinquishment_proposal']; ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land alienated so far </td>
                    <td><?php //echo $tree_cutting_data[0]['progress_land_alienated']; ?></td>
                </tr> -->
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
                    <td><?php echo $tree_cutting_data[0]['progress_%']; ?></td>
                     <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Activity Status </td>
                    <td><?php echo $tree_cutting_data[0]['activity_status']; ?></td>
                </tr> 
                <tr>
                    <!-- <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                    <td><?php// echo number_format($tree_cutting_data[0]['progress_amount_utilised'],2); ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                    <td><?php //echo $tree_cutting_data[0]['progress_fund_utilised']; ?></td> -->
                </tr>
                <tr> 
                   <!--  <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
                    <td> <?php //echo $tree_cutting_data[0]['remarks']; ?></td>
                    <td>&nbsp;  </td>
                    <td>&nbsp;  </td> -->
                </tr>

                </tbody>
            </table>
</div>
        <?php 
}else{
echo 'No data availbale!!';
    
}
?>
</div>