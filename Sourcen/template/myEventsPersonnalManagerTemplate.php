<!-- Wrapper -->
<div class="container-fluid" id="wrapper">

    <div class="row">

        <form id="projectWeek" method="POST" action="#"></form>

        <!-- Time  period and control -->
        <div class="period-control">
            <?php
            echo '
                <button type="button" onclick="previousWeek('.$controller->getYear().', '.$controller->getWeek().')" class="btn btn-secondary btn-control projectweek-nav"><</button>
                <a class="projectweek-text">'.$controller->getWeekStartDate().' - '.$controller->getWeekEndDate().'</a>
                <button type="button" onclick="nextWeek('.$controller->getYear().', '.$controller->getWeek().')" class="btn btn-secondary btn-control projectweek-nav">></button>
                ';
            ?>
        </div>

        <div class="tab-content row justify-content-center">

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tab-col">

                <table class="table table-striped table-responsive" id="table-table">

                    <thead>
                    <tr style="background-color: #FFF; border-bottom: 3px solid #333;">
                        <th>Von</th>
                        <th>Bis</th>
                        <th>Veranstaltung</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $projectWeekEntries = $controller->getProjectWeekEntriesOfPersonnalManager();

                    foreach($projectWeekEntries as $index => $projectWeekEntry) {

                        echo '
                                <tr style="background-color: '.($index % 2 == 0 ? "#FFF" : "#DFDFDF").';">
                                    
                                    <td>'.PositionMapping::map($projectWeekEntry->getPosition()).'</td>
                                    <td>'.PositionMapping::mapUntil($projectWeekEntry->getPosition(), $projectWeekEntry->getEvent()->length).'</td>
                                    <td>'.$projectWeekEntry->getEvent()->name.'</td>
                                </tr>

                                ';
                    }

                    ?>
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>