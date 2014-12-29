<?php
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
            <div class="onecolumn">
                <div class="header">
                    <span>Visitor Statistics</span>
                    <div class="switch" style="width:200px">
                    <table width="200px" cellpadding="0" cellspacing="0">
                    <tbody>
                            <tr>
                                    <td>
                                            <input type="button" id="chart_bar" name="chart_bar" class="left_switch active" value="Bar" style="width:50px"/>
                                    </td>

                                    <td>
                                            <input type="button" id="chart_area" name="chart_area" class="middle_switch" value="Area" style="width:50px"/>
                                    </td>
                                    <td>
                                            <input type="button" id="chart_pie" name="chart_pie" class="middle_switch" value="Pie" style="width:50px"/>
                                    </td>
                                    <td>
                                            <input type="button" id="chart_line" name="chart_line" class="right_switch" value="Line" style="width:50px"/>
                                    </td>

                            </tr>
                    </tbody>
                    </table>
                    </div>
		</div>
                <br class="clear"/>
                 <div class="content">
                    <div id="chart_wrapper" class="chart_wrapper"></div>
		      <table id="graph_data" class="data" rel="bar" cellpadding="0" cellspacing="0" width="100%">
        		<caption>Visitor Statistics</caption>
			<thead>
				<tr>
                                        <th>Yearly</th>
                                        <th>Monthly</th>
                                        <th>Weekly</th>
                                        <th>Daily</th>
                                </tr>
			</thead>
                        <tbody>
                                <tr>
                                        <td><?=$total_visit_year;?></td>
                                        <td><?=$total_visit_month;?></td>
                                        <td><?=$total_visit_week;?></td>
                                        <td><?=$total_visit_today;?></td>
                                        
                                </tr>
                              
			  </tbody>
		  </table>
                  <div id="chart_wrapper" class="chart_wrapper"></div>
                 </div>
            </div>
<div style="height:15px; clear:both;"></div>
              

		
		<?
		break;
	case 'insert':
		#html code here.
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
