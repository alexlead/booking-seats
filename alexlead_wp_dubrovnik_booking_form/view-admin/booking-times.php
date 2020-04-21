<?php
/*
Class for setting intervals admin page 
*/
if (!defined('ABSPATH')) exit;

global $timeInterval;
?>
<link rel="stylesheet" href="<?php echo $ALWPDBF_vars->cssURL().'admin-styles.css';?>">

<h1><?php echo $timeInterval['admin-intervals-header']; ?></h1>
<p><?php echo $timeInterval['admin-intervals-manual']; ?></p>

       <form id='table' action='' method='post'>
<div>
       <table>
       <thead><tr>
       <th><?php echo $timeInterval['table-delete'];?></th>
       <th><?php echo $timeInterval['table-id'];?></th>
       <th><?php echo $timeInterval['table-IntStart'];?></th>
       <th><?php echo $timeInterval['table-intTitle'];?></th>
       </tr></thead><tbody>
        
        <?php 
           for($i=0; $i<count($res['id']); $i++){ ?>
        <tr>
            <td><input type='checkbox' name='intDel[<?php echo $res['id'][$i];?>]'></td>
            <td><?php echo $res['id'][$i];?></td>
            <td><input type='text' name='intTimeStart[<?php echo $res['id'][$i];?>]' value='<?php echo $res['timeStart'][$i];?>' maxlength='6'></td>
            <td><input type='text' name='intTitle[<?php echo $res['id'][$i];?>]' value='<?php echo $res['title'][$i];?>'></td>
        </tr>
        <?php } ?>
            
        </tbody></table>
    </div>
<div>        <input type='hidden' name='intervalUpdate' value='1'><br/><input type='submit' value='<?php echo $timeInterval['table-submit'];?>'>
</div>
       </form>
        
        
       <h2><?php echo $timeInterval['admin-intervals-addnew-header'];?></h2>
       <div id='addNew'><form id='newInt' action='' method='post'>
       <label for='newIntTime'><?php echo $timeInterval['addnew-time'];?></label>
       <input type='text' name='newIntTime' maxlength='5'><br/>
       <label for='newIntTitle'><?php echo $timeInterval['addnew-title'];?></label>
       <input type='text' name='newIntTitle'><br/>
       <input type='submit' value='<?php echo $timeInterval['addnew-submit'];?>'>
       </form></div>
            
    