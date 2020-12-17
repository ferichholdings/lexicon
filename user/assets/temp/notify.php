<style>

ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}

</style>
<?php  $memId = $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']; ?>
<div class="row p-4">
		<div class="col-md-12 card">
			<h4 class ="p-4">My Notifications <span class ="badge badge-info float-right"> <?php  $noty->getTotalNotification($memId);?></span></h4>
			<ul class="timeline" style ="height:750px; overflow-y:scroll;">
                <?php    $noty->getMyNotifications($memId); ?>
			</ul>
		</div>
	</div>
</div>