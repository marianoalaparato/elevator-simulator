<?php 
class IndexView{
    
    public function __construct(){
        
    }
    
    public function getRenderElevators($building_h, $total_floors, $floors_h, $total_elevators){
        ?>
        <!--Elevators action view-->
        <div id="view" class="row container-fluid" style="height: <?php echo $building_h."px;" ?> overflow:scroll;">
            <?php for($i = 0; $i < $total_elevators; $i++){ ?>
            <div class="col bg-dark">
               <?php for($j = 0; $j < $total_floors; $j++){ ?>
                <div class="col-12 floors" style="height: <?php echo $floors_h."px;" ?>"></div>
               <?php } ?>
                <div id="<?php echo 'elevator'.$i ?>" class="col-12 flex_content_center" style="margin-top: <?php echo "-".$floors_h ?>">
                    <div class="col-6 elevator" style="height: <?php echo $floors_h."px;" ?>"></div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
    }
    
    public function getRenderPrompt(){
        ?>
        <!--Process promp-->
        <div id="prompt" class="row container-fluid p-3 my-3 bg-dark text-white">
            <p id="prompt_txt"></p>
        </div>
        <?php
    }

    public function getRenderControls(){
        ?>
        <!--Actions panel-->
        <div class="row flex_content_center">
            <div class="row">
                <div class="col flex_content_center">
                    <label> Floors:</label>
                    <input id="floors_num" type="text" class="form-control">
                </div>
                <div class="col flex_content_center">
                    <label> Elevators:</label>
                    <input id="elevators_num" type="text" class="form-control">
                </div>
                <div class="col flex_content_center">
                    <button id="change_f_e" type="button" class="btn btn-primary">Change</button>
                </div>
            </div>
            <div class="col-12 flex_content_center generate-btn">
                <button id="generate_report" type="button" class="btn btn-primary">Generate report</button>
            </div>
        </div>
        <?php
    }

}
