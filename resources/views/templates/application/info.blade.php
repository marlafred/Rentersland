
    <h3>Additional Information</h3>
    
    <div class="col-sm-4">
        <label>Will you have pets?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_pets))
                <?php $myval = $info->add_pets; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
            
        </p>
    </div>
    <div class="col-sm-4">
        <label>Will you have liquid filled furniture?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_furniture))
                <?php $myval = $info->add_furniture; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
            
        </p>
    </div>
    <div class="col-sm-4">
        <label>Have you ever had bedbugs?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_bugs))
                <?php $myval = $info->add_bugs; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
            
        </p>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-4">
        <label>Have you ever been evicted?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_avicted))
                <?php $myval = $info->add_avicted; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
            
        </p>
    </div>
    
    <div class="col-sm-4">
        <label>Have you ever filed for bankruptcy?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_bank))
                <?php $myval = $info->add_bank; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
            
        </p>
    </div>
 
    <div class="col-sm-4">
        <label>Do you smoke?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_smoke))
                <?php $myval = $info->add_smoke; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
        </p>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label>Have you ever been convicted of selling, distributing or manufacturing illegal drugs?</label>
        <p>
            <?php $myval = ''; ?>
            @if(isset($info->add_drugs))
                <?php $myval = $info->add_drugs; ?>
            @endif
            @if($myval=='yes') <img class="image" src="{{ asset('images/check.png') }}"> @endif
        </p>
    </div>
    
    <div class="clearfix"></div>
