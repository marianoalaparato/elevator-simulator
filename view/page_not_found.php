<?php

class PageNotFound {
    
    # Methods
    public function __construct() {
    }
    
    /**
     * Description: Return the not-found-page view
     */
    public function getRenderPageNotFound(){
        ?>
        <div class="container-fluid">
            <h2>Page not found.</h2>
        </div>
        <?php
    }
}
