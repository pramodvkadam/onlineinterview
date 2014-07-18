<?php
/**
 * This file will execute by the ajax call and user will recieve the JSON data 
 * which content the list of all teams for selection of respective user.
 * 
 */
require_once dirname(__DIR__).'/include-locations.php';
require_once $include_directory . 'define.php';
require_once dirname(__DIR__)."/include/database.php";
require_once dirname(__DIR__)."/include/utils-helpers.php";
require_once dirname(__DIR__)."/include/utils-teams.php";

global $db;
$response = array();
$response['valid'] = 0;

$teams = getAllTeams(0,10,$search);
?>
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Teams</h4>
</div>
<div class="modal-body">
<!--        <div class="row search-row">
    <div class="search-container">
            <div class="form-group col-sm-6">
                <div class="input-group">
                <input type="text" value="" name="filter" class="form-control filter">
                    <div class="input-group-btn">
                        <button data-action="search" class="btn btn-primary search btn-icon" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>		
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <button data-action="refresh" class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-refresh"></span>&nbsp;Refresh
                </button>
                <div class="btn-group">
                    <button data-action="reset" class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-repeat"></span>&nbsp;Reset
                    </button>
                    <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle add-filter-button" type="button">
                        Add Filter <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right filter-list">
                        <li class="" data-name="name"><a data-name="name" data-action="addFilter" class="add-filter" href="javascript:">Name</a></li>
                    </ul>
                </div>	
            </div>
        </div>
    </div>  -->  

<div class="list-container">
    <div class="list">
        <table class="table">
            <thead>
                <tr>
                    <th width="30%">Name</th>
                </tr>
            </thead>
            <tbody>
<?php
    
    if ($teams !== NULL) {
        foreach ($teams as $team) { ?>
            <tr data-id="<?php echo $team['id']; ?>">
                <td class="cell cell-name">
                    <a title="<?php echo ucfirst(sanitizeString($team['name'])); ?>" data-id="<?php echo $team['id']; ?>" class="link selectteamname" href="javascript:;"><?php echo ucfirst(sanitizeString($team['name'])); ?></a>
                </td>	
            </tr>            
<?php   }
    }
?>
            </tbody>
        </table>
        <?php if (count($team) > MAX_ROWS): ?>
        <div class="show-more hide">
            <a data-action="showMore" class="btn btn-default btn-block" href="javascript:" type="button">Show more</a>
        </div>
        <?php endif; ?>
    </div> 
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>